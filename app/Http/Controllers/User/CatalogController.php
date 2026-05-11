<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Helpers\SchemaHelper;

class CatalogController extends Controller
{
    /**
     * Tampilkan halaman katalog buku
     */
    public function index(Request $request)
    {
        // 1. Tangkap input search & filter
        $q = $request->input('q');
        $kategori = $request->input('kategori');
        $tahun = $request->input('tahun');
        $penulis = $request->input('penulis');

        // 2. Inisialisasi Variable Smart Search
        $smartYear = null;
        $smartCategory = null;
        $cleanQ = $q;
        
        $sortField = 'created_at';
        $sortDirection = 'desc';

        if ($q) {
            // -- A. Deteksi Tahun (e.g., 2023, 2020) --
            if (preg_match('/\b(19|20)\d{2}\b/', $q, $matches)) {
                $smartYear = $matches[0];
                $cleanQ = str_replace($smartYear, '', $cleanQ);
            }

            // -- B. Deteksi Intent Sorting --

            // Terbaru
            if (preg_match('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|terbit|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', $q)) {
                $sortField = 'created_at';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|terbit|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', '', $cleanQ);
            }
            // Populer
            elseif (preg_match('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|viral|rating|unggulan|terpopuler|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', $q)) {
                $sortField = 'favored_by_users_count';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|viral|rating|unggulan|terpopuler|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', '', $cleanQ);
            }
            // Terlama / klasik
            elseif (preg_match('/\b(terlama|lama|jadul|klasik|antik|lawas|vintage|retro)\b/i', $q)) {
                $sortField = 'created_at';
                $sortDirection = 'asc';
                $cleanQ = preg_replace('/\b(terlama|lama|jadul|klasik|antik|lawas|vintage|retro)\b/i', '', $cleanQ);
            }
            // Sort A-Z berdasarkan judul
            elseif (preg_match('/\b(abjad|alfabet|alfabetis|a[-\s]?z|dari\s*a|urut\s*judul|urut\s*nama|title)\b/i', $q)) {
                $sortField = 'judul';
                $sortDirection = 'asc';
                $cleanQ = preg_replace('/\b(abjad|alfabet|alfabetis|a[-\s]?z|dari\s*a|urut\s*judul|urut\s*nama|title)\b/i', '', $cleanQ);
            }
            // Sort Z-A
            elseif (preg_match('/\b(z[-\s]?a|terbalik)\b/i', $q)) {
                $sortField = 'judul';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(z[-\s]?a|terbalik)\b/i', '', $cleanQ);
            }

            // -- C. Deteksi Nama Kategori --
            // Ambil semua kategori untuk dicocokkan dengan teks pencarian
            $allCategories = Category::where('is_active', true)->pluck('nama', 'id');
            foreach ($allCategories as $id => $name) {
                if (stripos($q, $name) !== false) {
                    $smartCategory = $id;
                    $cleanQ = preg_replace('/\b' . preg_quote($name, '/') . '\b/i', '', $cleanQ);
                    break;
                }
            }

            // -- D. Hapus "Stop Words" agar pencarian teks lebih fokus --
            $stopWords = [
                // Kata umum buku
                'buku', 'novel', 'komik', 'majalah', 'jurnal', 'makalah', 'skripsi',
                // Pertanyaan & instruksi
                'yang', 'terbit', 'tahun', 'pada', 'tentang', 'kategori', 'penulis',
                'judul', 'di', 'dan', 'atau', 'ke', 'dari', 'untuk', 'adalah', 'ini',
                'itu', 'ada', 'tidak', 'ya', 'no',
                // Kata tanya & perintah
                'cari', 'tampilkan', 'apakah', 'siapa', 'apa', 'saja', 'daftar',
                'koleksi', 'carikan', 'saya', 'tolong', 'info', 'bagaimana', 'mana',
                'dimana', 'berikan', 'kasih', 'minta', 'bantu', 'recommend', 'butuh',
                'coba', 'mau', 'ingin', 'inginkan',
                // Preposisi & konjungsi
                'dengan', 'tema', 'berjudul', 'oleh', 'karangan', 'karya',
                'penerbit', 'terbitan', 'mengenai', 'seputar', 'mencari',
                // Genre / tipe
                'genre', 'jenis', 'tipe', 'seri', 'bidang', 'topik',
                // Halaman / nomor
                'nomor', 'hal', 'halaman', 'bab', 'edisi', 'volume', 'jilid',
            ];
            foreach ($stopWords as $word) {
                $cleanQ = preg_replace('/\b' . $word . '\b/i', '', $cleanQ);
            }

            // -- E. Finalisasi Keyword --
            $cleanQ = trim(preg_replace('/\s+/', ' ', $cleanQ));
        }

        // Logic Prioritas Filter: Explicit (UI) > Smart (Search)
        $finalCategory = $kategori ?: $smartCategory;
        $finalYear = $tahun ?: $smartYear;

        // 3. Bangun Query
        $booksQuery = Book::with('category')
            ->withCount('favoredByUsers'); // Untuk sorting populer

        // -- Pencarian Teks --
        if (!empty($cleanQ)) {
            $booksQuery->where(function ($query) use ($cleanQ) {
                $query->where('judul', 'like', "%$cleanQ%")
                      ->orWhere('penulis', 'like', "%$cleanQ%")
                      ->orWhere('penerbit', 'like', "%$cleanQ%")
                      ->orWhere('isbn', 'like', "%$cleanQ%")
                      ->orWhere('deskripsi', 'like', "%$cleanQ%")
                      ->orWhere('subjek', 'like', "%$cleanQ%")
                      ->orWhereHas('category', function ($qCat) use ($cleanQ) {
                          $qCat->where('nama', 'like', "%$cleanQ%");
                      });
            });
        }

        // -- Filter Lainnya --
        if ($finalCategory) {
            $booksQuery->where('category_id', $finalCategory);
        }
        if ($finalYear) {
            $booksQuery->where('tahun_terbit', $finalYear);
        }
        if ($penulis) {
            $booksQuery->where('penulis', $penulis);
        }

        // -- Sorting --
        if ($sortField === 'favored_by_users_count') {
            $booksQuery->orderBy('favored_by_users_count', 'desc');
        } else {
            // Jika user cari "terbaru", kita prioritaskan tahun_terbit kemudian created_at
            if (isset($q) && preg_match('/\b(terbaru|baru|terkini|rilis|terbit)\b/i', $q)) {
                $booksQuery->orderBy('tahun_terbit', 'desc')->orderBy('created_at', 'desc');
            } else {
                $booksQuery->orderBy($sortField, $sortDirection);
            }
        }

        // 4. Eksekusi Pagination
        $books = $booksQuery->paginate(12)->withQueryString();

        // 5. Data untuk Dropdown UI
        $categories = Category::where('is_active', true)->get();
        $years = Book::selectRaw('DISTINCT tahun_terbit')->orderBy('tahun_terbit', 'desc')->pluck('tahun_terbit');
        $authors = Book::selectRaw('DISTINCT penulis')->orderBy('penulis', 'asc')->pluck('penulis');

        $schema = SchemaHelper::getLibrarySchema($books->getCollection());

        return view('user.catalog.index', compact('books', 'categories', 'years', 'authors', 'schema'));
    }

    /**
     * Tampilkan halaman detail buku
     */
    public function show(Book $book)
    {
        $book->load('category');

        $relatedBooks = Book::with('category')
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->where('status', 'aktif')
            ->take(3)
            ->get();

        $activeBorrowing = null;
        if (auth()->check()) {
            $activeBorrowing = \App\Models\Borrowing::where('user_id', auth()->id())
                ->where('book_id', $book->id)
                ->whereIn('status', ['pending', 'borrowed', 'overdue'])
                ->first();
        }

        $schema = SchemaHelper::getBookSchema($book);

        return view('user.catalog.show', compact('book', 'relatedBooks', 'schema', 'activeBorrowing'));
    }
}   