<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Helpers\SchemaHelper;

class SearchEngineController extends Controller
{
    /**
     * Memproses pencarian cerdas (Natural Language Search) layaknya Search Engine.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $kategori = $request->input('kategori');
        $tahun = $request->input('tahun');
        $penulis = $request->input('penulis');

        $smartYear = null;
        $smartCategory = null;
        $smartAuthor = null;
        $cleanQ = $q;
        
        $sortField = 'created_at';
        $sortDirection = 'desc';

        if ($q) {
            // -- 1. Deteksi Tahun (misal: "terbit tahun 2020", "2023") --
            if (preg_match('/\b(19|20)\d{2}\b/', $q, $matches)) {
                $smartYear = $matches[0];
                $cleanQ = str_replace($smartYear, '', $cleanQ);
            }

            // -- 2. Deteksi Urutan / Intent --
            if (preg_match('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', $q)) {
                $sortField = 'created_at';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', $q)) {
                $sortField = 'favored_by_users_count';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(terlama|lama|jadul|klasik|lawas|antik|vintage|retro)\b/i', $q)) {
                $sortField = 'created_at';
                $sortDirection = 'asc';
                $cleanQ = preg_replace('/\b(terlama|lama|jadul|klasik|lawas|antik|vintage|retro)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(abjad|alfabet|alfabetis|a[-\s]?z|dari\s*a|urut\s*judul|urut\s*nama|title)\b/i', $q)) {
                $sortField = 'judul';
                $sortDirection = 'asc';
                $cleanQ = preg_replace('/\b(abjad|alfabet|alfabetis|a[-\s]?z|dari\s*a|urut\s*judul|urut\s*nama|title)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(z[-\s]?a|terbalik)\b/i', $q)) {
                $sortField = 'judul';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(z[-\s]?a|terbalik)\b/i', '', $cleanQ);
            }

            // -- 3. Deteksi Kategori / Subjek (misal: "buku sejarah", "buku matematika") --
            $allCategories = Category::where('is_active', true)->get();
            foreach ($allCategories as $category) {
                if (stripos($q, $category->nama) !== false) {
                    $smartCategory = $category->id;
                    $cleanQ = preg_replace('/\b' . preg_quote($category->nama, '/') . '\b/i', '', $cleanQ);
                    break;
                }
            }

            // -- 4. Deteksi Penulis Spesifik (contoh: "penulis tere liye", "karya andrea hirata") --
            if (preg_match('/\b(karya|penulis|karangan|oleh|buatan)\s+([a-zA-Z\s]+)/i', $cleanQ, $matches)) {
                // Ambil string nama, buang kata-kata tidak perlu
                $potentialAuthor = trim($matches[2]);
                // Batasi hanya mengambil maksimal 3 kata pertama sebagai nama
                $authorWords = explode(' ', $potentialAuthor);
                $smartAuthor = implode(' ', array_slice($authorWords, 0, 3));
                // Hilangkan dari query pencarian umum
                $cleanQ = preg_replace('/\b(karya|penulis|karangan|oleh|buatan)\b/i', '', $cleanQ);
                $cleanQ = str_ireplace($smartAuthor, '', $cleanQ);
            }

            // -- 5. Menghapus Stop Words (NLP Ekstensi Kata-kata Gaul/Sehari-hari) --
            $stopWords = [
                // Kata umum entitas
                'buku', 'novel', 'komik', 'majalah', 'jurnal', 'makalah', 'skripsi', 'artikel', 'karya', 'bacaan', 'literatur',
                // Kata kerja / minat
                'saya', 'suka', 'baca', 'membaca', 'mencari', 'minta', 'tolong', 'cari', 'carikan', 'butuh', 'recommend', 'rekomendasi',
                'lihat', 'menampilkan', 'tampilkan', 'menemukan', 'temukan', 'pengen', 'ingin', 'inginkan', 'mau', 'dapat', 'dapatkan',
                'pilih', 'berikan', 'kasih', 'bantu', 'coba',
                // Kata ganti / konjungsi / preposisi
                'yang', 'pada', 'tentang', 'kategori', 'penulis', 'judul', 'tema', 'genre', 'topik', 'bidang', 'jenis', 'tipe', 'seri',
                'di', 'dan', 'atau', 'ke', 'dari', 'untuk', 'adalah', 'ini', 'itu', 'buat', 'seputar', 'mengenai', 'terkait',
                // Kata tanya / percakapan
                'ada', 'tidak', 'berjudul', 'oleh', 'karangan', 'penerbit', 'terbitan', 'tahun', 'terbit', 'edisi', 'volume', 'jilid', 
                'hal', 'halaman', 'bab', 'nomor', 'apakah', 'siapa', 'apa', 'saja', 'daftar', 'koleksi', 'info', 'bagaimana', 'mana', 
                'dimana', 'kapan', 'punya', 'gak', 'dong', 'sih', 'ya', 'no', 'dong', 'deh'
            ];
            
            foreach ($stopWords as $word) {
                // Gunakan preg_replace dengan boundary agar tidak menghapus bagian kata ('sejarah' tidak jadi 'sejrh')
                $cleanQ = preg_replace('/\b' . $word . '\b/i', '', $cleanQ);
            }

            // Bersihkan spasi ganda tersisa
            $cleanQ = trim(preg_replace('/\s+/', ' ', $cleanQ));
        }

        // Terapkan Filter Hasil Deteksi Engine ATAU Filter dari Sidebar UI
        $finalCategory = $kategori ?: $smartCategory;
        $finalYear = $tahun ?: $smartYear;
        // Prioritaskan parameter dropdown penulis, lalu hasil NLP author extraction
        $finalAuthor = $penulis ?: $smartAuthor;

        $booksQuery = Book::with('category')->withCount('favoredByUsers');

        // Text Search
        if (!empty($cleanQ)) {
            $booksQuery->where(function ($query) use ($cleanQ) {
                $query->where('judul', 'like', "%$cleanQ%")
                      ->orWhere('penulis', 'like', "%$cleanQ%")
                      ->orWhere('deskripsi', 'like', "%$cleanQ%")
                      ->orWhere('penerbit', 'like', "%$cleanQ%")
                      ->orWhere('isbn', 'like', "%$cleanQ%")
                      ->orWhere('subjek', 'like', "%$cleanQ%");
            });
        }

        // Sidebar / Smart Filter
        if ($finalCategory) {
            $booksQuery->where('category_id', $finalCategory);
        }
        if ($finalYear) {
            $booksQuery->where('tahun_terbit', $finalYear);
        }
        if ($finalAuthor) {
            // Jika hasil dari NLP smartAuthor (misal: "tere liye"), kita gunakan LIKE agar lebih fleksibel dibanding strict equals.
            if ($smartAuthor && empty($penulis)) {
                $booksQuery->where('penulis', 'like', '%' . $finalAuthor . '%');
            } else {
                $booksQuery->where('penulis', $finalAuthor); // Dari sidebar biasanya exact match
            }
        }

        // Sorting Logic
        if ($sortField === 'favored_by_users_count') {
            $booksQuery->orderBy('favored_by_users_count', 'desc');
        } else {
            $booksQuery->orderBy($sortField, $sortDirection);
        }

        $books = $booksQuery->paginate(12)->withQueryString();

        // Data array untuk sidebar (select dropdown)
        $categories = Category::where('is_active', true)->get();
        $years = Book::selectRaw('DISTINCT tahun_terbit')->orderBy('tahun_terbit', 'desc')->pluck('tahun_terbit');
        $authors = Book::selectRaw('DISTINCT penulis')->orderBy('penulis', 'asc')->pluck('penulis');

        $schema = SchemaHelper::getLibrarySchema($books->getCollection());

        // Kita bisa me-reuse view katalog dengan engine pencarian ini
        return view('user.catalog.index', compact('books', 'categories', 'years', 'authors', 'schema', 'finalCategory', 'finalYear', 'finalAuthor'));
    }
}
