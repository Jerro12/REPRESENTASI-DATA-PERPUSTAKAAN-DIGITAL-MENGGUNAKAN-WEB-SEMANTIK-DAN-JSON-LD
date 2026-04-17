<?php
$queries = [
    "Tolong tampilkan buku sistem informasi yang terbit tahun 2020",
    "Info dong buku pemrograman web bestseller"
];

foreach ($queries as $q) {
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

    if (preg_match('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|terbit|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', $q, $mat)) {
        $cleanQ = preg_replace('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|terbit|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', '', $cleanQ);
    } elseif (preg_match('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', $q, $mat)) {
        $cleanQ = preg_replace('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', '', $cleanQ);
    }

    $allCategories = ['Sistem Informasi', 'Pemrograman Web'];
    foreach ($allCategories as $cat) {
        if (stripos($q, $cat) !== false) {
            $smartCategory = $cat;
            $cleanQ = preg_replace('/\b' . preg_quote($cat, '/') . '\b/i', '', $cleanQ);
            break;
        }
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
    
    echo "Query: $q\n";
    echo "Year: $smartYear\n";
    echo "Category: $smartCategory\n";
    echo "Clean: '$cleanQ'\n";
    echo "=========================\n";
}
