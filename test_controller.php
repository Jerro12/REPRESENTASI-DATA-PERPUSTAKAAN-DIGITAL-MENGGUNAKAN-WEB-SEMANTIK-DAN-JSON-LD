<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function testQuery($q) {
    $smartYear = null;
    $smartCategory = null;
    $smartAuthor = null;
    $cleanQ = $q;
    $sortField = 'created_at';
    $sortDirection = 'desc';

    if (preg_match('/\b(19|20)\d{2}\b/', $q, $matches)) {
        $smartYear = $matches[0];
        $cleanQ = str_replace($smartYear, '', $cleanQ);
    }
    if (preg_match('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|terbit|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', $q)) {
        $sortField = 'created_at';
        $sortDirection = 'desc';
        $cleanQ = preg_replace('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|terbit|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', '', $cleanQ);
    } elseif (preg_match('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', $q)) {
        $sortField = 'favored_by_users_count';
        $sortDirection = 'desc';
        $cleanQ = preg_replace('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', '', $cleanQ);
    }
    $allCategories = \App\Models\Category::where('is_active', true)->get();
    foreach ($allCategories as $category) {
        if (stripos($q, $category->nama) !== false) {
            $smartCategory = $category->id;
            $cleanQ = preg_replace('/\b' . preg_quote($category->nama, '/') . '\b/i', '', $cleanQ);
            break;
        }
    }
    if (preg_match('/\b(karya|penulis|karangan|oleh|buatan)\s+([a-zA-Z\s]+)/i', $cleanQ, $matches)) {
        $potentialAuthor = trim($matches[2]);
        $authorWords = explode(' ', $potentialAuthor);
        $smartAuthor = implode(' ', array_slice($authorWords, 0, 3));
        $cleanQ = preg_replace('/\b(karya|penulis|karangan|oleh|buatan)\b/i', '', $cleanQ);
        $cleanQ = str_ireplace($smartAuthor, '', $cleanQ);
    }
    $stopWords = [
        'buku', 'novel', 'komik', 'majalah', 'jurnal', 'makalah', 'skripsi', 'artikel', 'karya', 'bacaan', 'literatur',
        'saya', 'suka', 'baca', 'membaca', 'mencari', 'minta', 'tolong', 'cari', 'carikan', 'butuh', 'recommend', 'rekomendasi',
        'lihat', 'menampilkan', 'tampilkan', 'menemukan', 'temukan', 'pengen', 'ingin', 'inginkan', 'mau', 'dapat', 'dapatkan',
        'pilih', 'berikan', 'kasih', 'bantu', 'coba',
        'yang', 'pada', 'tentang', 'kategori', 'penulis', 'judul', 'tema', 'genre', 'topik', 'bidang', 'jenis', 'tipe', 'seri',
        'di', 'dan', 'atau', 'ke', 'dari', 'untuk', 'adalah', 'ini', 'itu', 'buat', 'seputar', 'mengenai', 'terkait',
        'ada', 'tidak', 'berjudul', 'oleh', 'karangan', 'penerbit', 'terbitan', 'tahun', 'terbit', 'edisi', 'volume', 'jilid', 
        'hal', 'halaman', 'bab', 'nomor', 'apakah', 'siapa', 'apa', 'saja', 'daftar', 'koleksi', 'info', 'bagaimana', 'mana', 
        'dimana', 'kapan', 'punya', 'gak', 'dong', 'sih', 'ya', 'no', 'deh'
    ];
    foreach ($stopWords as $word) {
        $cleanQ = preg_replace('/\b' . $word . '\b/i', '', $cleanQ);
    }
    $cleanQ = trim(preg_replace('/\s+/', ' ', $cleanQ));

    $booksQuery = \App\Models\Book::with('category')->withCount('favoredByUsers');
    if (!empty($cleanQ)) {
        $booksQuery->where(function ($query) use ($cleanQ) {
            $query->where('judul', 'like', "%$cleanQ%")
                  ->orWhere('penulis', 'like', "%$cleanQ%");
        });
    }
    if ($smartCategory) { $booksQuery->where('category_id', $smartCategory); }
    if ($smartYear) { $booksQuery->where('tahun_terbit', $smartYear); }
    if ($smartAuthor) { $booksQuery->where('penulis', 'like', '%' . $smartAuthor . '%'); }
    
    echo "Query: $q\nCleanQ: \"$cleanQ\"\nCat: $smartCategory, Year: $smartYear, Author: $smartAuthor\n";
    $books = $booksQuery->get();
    echo "Results count: " . $books->count() . "\n";
    foreach ($books as $b) {
        echo " - " . $b->judul . " (Cat=" . $b->category_id . ", Yr=" . $b->tahun_terbit . ")\n";
    }
    echo "=====================================\n";
}

testQuery("Tolong tampilkan buku sistem informasi yang terbit tahun 2020");
testQuery("Info dong buku pemrograman web bestseller");
testQuery("Saya butuh buku vintage karya Budi Rahardjo");
