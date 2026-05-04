<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Helpers\SchemaHelper;
use Sastrawi\Stemmer\StemmerFactory;

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
        $smartPublisher = null;
        $cleanQ = $q;
        
        $sortField = 'created_at';
        $sortDirection = 'desc';

        if ($q) {
            // -- PRE-PROCESSING: Bersihkan Tanda Baca & Tangani Pertanyaan Terbalik --
            // Hapus tanda baca seperti "?" agar tidak ikut tertangkap oleh regex
            $cleanQ = preg_replace('/[^\w\s\-]/', ' ', $cleanQ);
            $cleanQ = trim(preg_replace('/\s+/', ' ', $cleanQ));
            
            // Hapus frasa tanya yang menjebak (agar tidak masuk ke filter spesifik)
            // Contoh: "siapa penulis laskar pelangi" -> user mencari judul, bukan mencari penulis bernama "laskar pelangi"
            $cleanQ = preg_replace('/\b(siapa\s+penulis|siapa\s+pengarang|siapa\s+penerbit|apa\s+judul|buku\s+apa)\b/i', '', $cleanQ);

            // -- 1. Deteksi Tahun (misal: "terbit tahun 2020", "2023") --
            if (preg_match('/\b(19|20)\d{2}\b/', $cleanQ, $matches)) {
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

            $boundary = '\b(?:dari|untuk|di|yang|tahun|penerbit|karya|penulis|karangan|oleh|terbitan|cetakan|produksi|judul|kategori|tentang|seputar|membahas|isinya|aja|diterbitkan|dikarang|dibuat|dicetak)\b';

            // -- 4. Deteksi Penulis Spesifik (contoh: "penulis tere liye", "karya andrea hirata") --
            if (preg_match('/\b(karya|penulis|karangan|oleh)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?(.*?)(?=' . $boundary . '|$)/i', $cleanQ, $matches)) {
                $smartAuthor = trim($matches[2]);
                $cleanQ = preg_replace('/\b(karya|penulis|karangan|oleh)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?' . preg_quote($smartAuthor, '/') . '/i', '', $cleanQ);
            }

            // -- 5. Deteksi Penerbit Spesifik (contoh: "penerbit itb", "cetakan gramedia") --
            if (preg_match('/\b(penerbit|produksi|cetakan|terbitan)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?(.*?)(?=' . $boundary . '|$)/i', $cleanQ, $matches)) {
                $smartPublisher = trim($matches[2]);
                $cleanQ = preg_replace('/\b(penerbit|produksi|cetakan|terbitan)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?' . preg_quote($smartPublisher, '/') . '/i', '', $cleanQ);
            }

            // -- 6. Menghapus Stop Words (NLP Ekstensi Kata-kata Gaul/Sehari-hari) --
            $stopWords = [
                'buku', 'novel', 'komik', 'majalah', 'jurnal', 'makalah', 'skripsi', 'artikel', 'karya', 'bacaan', 'literatur',
                'saya', 'suka', 'baca', 'membaca', 'mencari', 'minta', 'tolong', 'cari', 'carikan', 'butuh', 'recommend', 'rekomendasi',
                'lihat', 'menampilkan', 'tampilkan', 'menemukan', 'temukan', 'pengen', 'ingin', 'inginkan', 'mau', 'dapat', 'dapatkan',
                'pilih', 'berikan', 'kasih', 'bantu', 'coba',
                'yang', 'pada', 'tentang', 'kategori', 'penulis', 'judul', 'tema', 'genre', 'topik', 'bidang', 'jenis', 'tipe', 'seri',
                'di', 'dan', 'atau', 'ke', 'dari', 'untuk', 'adalah', 'ini', 'itu', 'buat', 'seputar', 'mengenai', 'terkait',
                'ada', 'tidak', 'berjudul', 'oleh', 'karangan', 'penerbit', 'terbitan', 'tahun', 'terbit', 'edisi', 'volume', 'jilid', 
                'hal', 'halaman', 'bab', 'nomor', 'apakah', 'siapa', 'apa', 'saja', 'daftar', 'koleksi', 'info', 'bagaimana', 'mana', 
                'dimana', 'kapan', 'punya', 'gak', 'dong', 'sih', 'ya', 'no', 'dong', 'deh',
                'ditulis', 'dibuat', 'dikarang', 'diterbitkan', 'dicetak', 'kenapa', 'mengapa', 'gimana', 'gmn',
                'min', 'halo', 'hai', 'isinya', 'membahas', 'aja', 'kak', 'bang', 'pak', 'bu', 'judulnya', 'penulisnya', 'penerbitnya',
                'nggak', 'ngga', 'caranya', 'bahas', 'bahasnya', 'paling', 'sangat', 'amat', 'ter'
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

        // -- SEARCH LOGIC WITH SCOUT & SASTRAWI --
        if (!empty($cleanQ)) {
            // Inisialisasi Sastrawi Stemmer
            $stemmerFactory = new StemmerFactory();
            $stemmer = $stemmerFactory->createStemmer();
            $stemmedQ = $stemmer->stem($cleanQ);

            // Gunakan Scout untuk pencarian (TNTSearch)
            $booksQuery = Book::search($stemmedQ);
        } else {
            // Pencarian tanpa kata kunci (tampilkan semua dengan filter)
            $booksQuery = Book::query();
        }

        // Apply filters to Scout Builder or Eloquent Query
        if ($finalCategory) {
            $booksQuery->where('category_id', $finalCategory);
        }
        if ($finalYear) {
            $booksQuery->where('tahun_terbit', $finalYear);
        }
        if ($finalAuthor) {
            $booksQuery->where('penulis', $finalAuthor);
        }

        // Sorting & Eager Loading
        if ($booksQuery instanceof \Laravel\Scout\Builder) {
            // Terapkan Eager Loading
            $booksQuery->query(function ($query) {
                $query->with('category')->withCount('favoredByUsers');
            });

            // TERAPKAN SORTING LANGSUNG PADA SCOUT BUILDER
            if ($sortField === 'favored_by_users_count') {
                // Untuk virtual column, kita tetap di dalam query callback
                $booksQuery->query(function($q) { $q->orderBy('favored_by_users_count', 'desc'); });
            } elseif (!empty($cleanQ) && $sortField === 'created_at' && $sortDirection === 'desc') {
                // Biarkan Relevansi
            } else {
                $booksQuery->orderBy($sortField, $sortDirection);
            }
        } else {



            $booksQuery->with('category')->withCount('favoredByUsers');
            if ($sortField === 'favored_by_users_count') {
                $booksQuery->orderBy('favored_by_users_count', 'desc');
            } else {
                $booksQuery->orderBy($sortField, $sortDirection);
            }
        }


        $books = $booksQuery->paginate(12)->withQueryString();

        // Data array untuk sidebar (select dropdown)
        $categories = Category::where('is_active', true)->get();
        $years = Book::selectRaw('DISTINCT tahun_terbit')->orderBy('tahun_terbit', 'desc')->pluck('tahun_terbit');
        $authors = Book::selectRaw('DISTINCT penulis')->orderBy('penulis', 'asc')->pluck('penulis');

        $schema = SchemaHelper::getSearchResultsSchema($books->items(), $cleanQ);

        // Kirim $cleanQ sebagai 'q' agar highlight hanya pada kata kunci inti
        return view('user.catalog.index', [
            'books' => $books,
            'categories' => $categories,
            'years' => $years,
            'authors' => $authors,
            'schema' => $schema,
            'finalCategory' => $finalCategory,
            'finalYear' => $finalYear,
            'finalAuthor' => $finalAuthor,
            'q' => $cleanQ // Ini yang akan dipakai oleh x-book-card
        ]);
    }
}


