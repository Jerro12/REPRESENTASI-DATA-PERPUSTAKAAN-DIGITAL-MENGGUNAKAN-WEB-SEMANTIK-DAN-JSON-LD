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
     * ============================================================
     * PerpusSearch — Smart Search Engine untuk Perpustakaan Digital
     * ============================================================
     * 
     * Alur Kerja (Pipeline):
     * 1. PRE-PROCESSING    : Bersihkan tanda baca & frasa jebakan
     * 2. INTENT DETECTION   : Deteksi urutan (terbaru, terlama, A-Z, populer)
     * 3. ENTITY EXTRACTION  : Deteksi tahun, kategori (unlimited), penulis, penerbit
     * 4. FUZZY MATCHING     : Toleransi typo untuk nama kategori
     * 5. SUBJEK MATCHING    : Cari juga di kolom subjek buku
     * 6. STOP WORD REMOVAL  : Hapus kata-kata tidak bermakna
     * 7. SEARCH EXECUTION   : Gabungkan hasil kategori + subjek + teks (OR logic)
     * 8. RESPONSE           : Kirim hasil + metadata feedback ke view
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $kategori = $request->input('kategori');
        $tahun = $request->input('tahun');
        $penulis = $request->input('penulis');

        $smartYear = null;
        $smartCategories = [];
        $smartCategoryNames = [];
        $smartAuthor = null;
        $smartPublisher = null;
        $cleanQ = $q;
        $sortLabel = null;
        $sortField = 'tahun_terbit';
        $sortDirection = 'desc';
        
        // ====================================================
        // STEP 0: BLOKIR PENCARIAN ISENG / UJI COBA
        // ====================================================
        $isBlockedQuery = false;
        if ($q) {
            $testWords = ['tes', 'test', 'tests', 'testing', 'coba', 'mencoba', 'percobaan', 'uji', 'ujian', 'menguji', 'cek', 'check', 'checking', 'halo', 'hai', 'hello', 'ping', 'p', 'asdf', '123', '1234'];
            $coreQ = trim(strtolower(preg_replace('/\b(cari|carikan|buku|tolong|coba)\b/i', '', strtolower($q))));
            
            if (in_array(strtolower(trim($q)), $testWords) || in_array($coreQ, $testWords)) {
                $isBlockedQuery = true;
                $cleanQ = ''; // Kosongkan query agar tidak diproses lebih lanjut
            }
        }

        if ($q && !$isBlockedQuery) {
            // ====================================================
            // STEP 1: PRE-PROCESSING
            // ====================================================
            $cleanQ = preg_replace('/[^\w\s\-]/', ' ', $cleanQ);
            $cleanQ = trim(preg_replace('/\s+/', ' ', $cleanQ));
            
            // Hapus frasa perintah/tanya
            $cleanQ = preg_replace('/\b(siapa\s+penulis|siapa\s+pengarang|siapa\s+penerbit|apa\s+judul|buku\s+apa|daftar\s+buku|tampilkan\s+buku|list\s+buku|tampilkan\s+daftar|tunjukkan\s+buku|kasih\s+lihat|tolong\s+carikan)\b/i', '', $cleanQ);
            $q = preg_replace('/\b(daftar\s+buku|tampilkan\s+buku|list\s+buku|tampilkan\s+daftar|tunjukkan\s+buku)\b/i', '', $q);

            // ====================================================
            // STEP 2: INTENT DETECTION (Urutan / Sorting)
            // ====================================================
            if (preg_match('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', $q)) {
                $sortField = 'tahun_terbit';
                $sortDirection = 'desc';
                $sortLabel = 'Terbaru (Tahun Terbit)';
                $cleanQ = preg_replace('/\b(terbaru|baru|anyar|terkini|terbitan|rilis|recent|fresh|mutakhir|modern|update|tergress|edisi\s*baru)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', $q)) {
                $sortField = 'favored_by_users_count';
                $sortDirection = 'desc';
                $sortLabel = 'Paling Populer';
                $cleanQ = preg_replace('/\b(populer|favorit|disukai|rekomendasi|terbaik|hits|top|trending|terlaris|bestseller|pilihan|andalan|terpilih|banyak\s*dibaca|sering\s*dipinjam)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(terlama|lama|jadul|klasik|lawas|antik|vintage|retro|kuno|tua)\b/i', $q)) {
                $sortField = 'tahun_terbit';
                $sortDirection = 'asc';
                $sortLabel = 'Terlama (Tahun Terbit)';
                $cleanQ = preg_replace('/\b(terlama|lama|jadul|klasik|lawas|antik|vintage|retro|kuno|tua)\b/i', '', $cleanQ);
            } elseif (preg_match('/(abjad|alfabet|alfabetis|a[\s\-]*z|a\s*(sampai|ke)\s*z|dari\s*a|urut\s*judul|urut\s*nama|title)/i', $q)) {
                $sortField = 'judul';
                $sortDirection = 'asc';
                $sortLabel = 'Abjad (A → Z)';
                $cleanQ = preg_replace('/(abjad|alfabet|alfabetis|a[\s\-]*z|a\s*(sampai|ke)\s*z|dari\s*a|urut\s*judul|urut\s*nama|title)/i', '', $cleanQ);
            } elseif (preg_match('/\b(z[\s\-]*a|terbalik)\b/i', $q)) {
                $sortField = 'judul';
                $sortDirection = 'desc';
                $sortLabel = 'Abjad (Z → A)';
                $cleanQ = preg_replace('/\b(z[\s\-]*a|terbalik)\b/i', '', $cleanQ);
            }

            // ====================================================
            // STEP 3: ENTITY EXTRACTION
            // ====================================================
            $stopWords = [
                'buku', 'novel', 'komik', 'majalah', 'jurnal', 'makalah', 'skripsi', 'artikel', 'karya', 'bacaan', 'literatur',
                'saya', 'suka', 'baca', 'membaca', 'mencari', 'minta', 'tolong', 'cari', 'carikan', 'butuh', 'recommend', 'rekomendasi',
                'lihat', 'menampilkan', 'tampilkan', 'menemukan', 'temukan', 'pengen', 'ingin', 'inginkan', 'mau', 'dapat', 'dapatkan',
                'pilih', 'berikan', 'kasih', 'bantu', 'coba',
                'yang', 'pada', 'tentang', 'kategori', 'penulis', 'judul', 'tema', 'genre', 'topik', 'bidang', 'jenis', 'tipe', 'seri',
                'di', 'dan', 'atau', 'serta', 'ke', 'dari', 'untuk', 'adalah', 'ini', 'itu', 'buat', 'seputar', 'mengenai', 'terkait', 'sampai',
                'ada', 'tidak', 'berjudul', 'oleh', 'karangan', 'penerbit', 'terbitan', 'tahun', 'terbit', 'edisi', 'volume', 'jilid', 
                'hal', 'halaman', 'bab', 'nomor', 'apakah', 'siapa', 'apa', 'saja', 'daftar', 'koleksi', 'info', 'bagaimana', 'mana', 
                'dimana', 'kapan', 'punya', 'gak', 'dong', 'sih', 'ya', 'no', 'dong', 'deh',
                'ditulis', 'dibuat', 'dikarang', 'diterbitkan', 'dicetak', 'kenapa', 'mengapa', 'gimana', 'gmn', 'tulis', 'karang', 'bikin',
                'min', 'halo', 'hai', 'isinya', 'membahas', 'aja', 'kak', 'bang', 'pak', 'bu', 'judulnya', 'penulisnya', 'penerbitnya',
                'nggak', 'ngga', 'caranya', 'bahas', 'bahasnya', 'paling', 'sangat', 'amat', 'ter'
            ];

            // -- 3a. Deteksi Tahun --
            if (preg_match('/\b(19|20)\d{2}\b/', $cleanQ, $matches)) {
                $smartYear = $matches[0];
                $cleanQ = str_replace($smartYear, '', $cleanQ);
            }

            // -- 3b. Deteksi Kategori (UNLIMITED — 1, 2, 3, atau lebih) --
            $allCategories = Category::where('is_active', true)->get();
            
            // Bersihkan cleanQ sementara untuk pencocokan kategori
            $lowerQ = strtolower($cleanQ);
            
            foreach ($allCategories as $category) {
                $catName = strtolower($category->nama);
                
                // === EXACT MATCH: Cocokkan nama lengkap kategori ===
                if (strpos($lowerQ, $catName) !== false) {
                    $smartCategories[] = $category->id;
                    $smartCategoryNames[] = $category->nama;
                    // Hapus dari cleanQ
                    $cleanQ = preg_replace('/' . preg_quote($category->nama, '/') . '/i', '', $cleanQ);
                    $lowerQ = strtolower($cleanQ);
                    continue;
                }
                
                // === KEYWORD MATCH: Cocokkan kata kunci dari nama kategori ===
                // Misal: "Tokoh & Biografi" -> cek "tokoh", "biografi"
                $cleanCatName = str_replace(['&', 'dan', 'atau', '/', '-'], ' ', $catName);
                $catKeywords = array_filter(explode(' ', $cleanCatName), function($word) {
                    return strlen(trim($word)) > 3;
                });

                foreach ($catKeywords as $keyword) {
                    $keyword = trim($keyword);
                    if (preg_match('/\b' . preg_quote($keyword, '/') . '\b/i', $cleanQ)) {
                        if (!in_array($category->id, $smartCategories)) {
                            $smartCategories[] = $category->id;
                            $smartCategoryNames[] = $category->nama;
                        }
                        // Hapus keyword dari cleanQ
                        $cleanQ = preg_replace('/\b' . preg_quote($keyword, '/') . '\b/i', '', $cleanQ);
                        $lowerQ = strtolower($cleanQ);
                        break;
                    }
                }
                
                // === FUZZY MATCH: Toleransi typo (levenshtein distance ≤ 2) ===
                if (!in_array($category->id, $smartCategories)) {
                    $queryWords = array_filter(explode(' ', $lowerQ), fn($w) => strlen(trim($w)) > 3);
                    foreach ($queryWords as $word) {
                        $word = trim($word);
                        if (in_array($word, $stopWords)) continue; // Abaikan stopword untuk fuzzy match
                        
                        // Cek fuzzy terhadap nama kategori lengkap
                        if (levenshtein($word, $catName) <= 2 && levenshtein($word, $catName) > 0) {
                            $smartCategories[] = $category->id;
                            $smartCategoryNames[] = $category->nama . ' (koreksi dari "' . $word . '")';
                            $cleanQ = preg_replace('/\b' . preg_quote($word, '/') . '\b/i', '', $cleanQ);
                            $lowerQ = strtolower($cleanQ);
                            break;
                        }
                        // Cek fuzzy terhadap keyword kategori
                        foreach ($catKeywords as $keyword) {
                            $keyword = trim($keyword);
                            if (strlen($keyword) > 4 && levenshtein($word, $keyword) <= 2 && levenshtein($word, $keyword) > 0) {
                                $smartCategories[] = $category->id;
                                $smartCategoryNames[] = $category->nama . ' (koreksi dari "' . $word . '")';
                                $cleanQ = preg_replace('/\b' . preg_quote($word, '/') . '\b/i', '', $cleanQ);
                                $lowerQ = strtolower($cleanQ);
                                break 2;
                            }
                        }
                    }
                }
            }
            $smartCategories = array_unique($smartCategories);

            // -- 3c. Deteksi Penulis --
            $boundary = '\b(?:dari|untuk|di|yang|tahun|penerbit|karya|penulis|karangan|oleh|terbitan|cetakan|produksi|judul|kategori|tentang|seputar|membahas|isinya|aja|diterbitkan|dikarang|dibuat|dicetak)\b';
            if (preg_match('/\b(karya|penulis|karangan|oleh)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?(.*?)(?=' . $boundary . '|$)/i', $cleanQ, $matches)) {
                $smartAuthor = trim($matches[2]);
                if (!empty($smartAuthor)) {
                    $cleanQ = preg_replace('/\b(karya|penulis|karangan|oleh)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?' . preg_quote($smartAuthor, '/') . '/i', '', $cleanQ);
                }
            }

            // -- 3d. Deteksi Penerbit --
            if (preg_match('/\b(penerbit|produksi|cetakan|terbitan)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?(.*?)(?=' . $boundary . '|$)/i', $cleanQ, $matches)) {
                $smartPublisher = trim($matches[2]);
                if (!empty($smartPublisher)) {
                    $cleanQ = preg_replace('/\b(penerbit|produksi|cetakan|terbitan)\s+(?:(?:buku|novel|cerita|dari|yg|yang)\s+)?' . preg_quote($smartPublisher, '/') . '/i', '', $cleanQ);
                }
            }

            // ====================================================
            // STEP 4: STOP WORD REMOVAL
            // ====================================================
            
            foreach ($stopWords as $word) {
                $cleanQ = preg_replace('/\b' . $word . '\b/i', '', $cleanQ);
            }
            $cleanQ = trim(preg_replace('/\s+/', ' ', $cleanQ));
        }

        // ====================================================
        // STEP 5: HIGHLIGHT QUERY (untuk marker di UI)
        // ====================================================
        $highlightQuery = $q ?? '';
        if ($highlightQuery) {
            $basicStopWords = ['buku', 'novel', 'mencari', 'cari', 'tampilkan', 'lihat', 'ingin', 'mau', 'ada',
                'itu', 'ini', 'dan', 'atau', 'serta', 'dari', 'yang', 'ke', 'di', 'untuk', 'daftar', 'sampai',
                'tentang', 'tolong', 'carikan', 'dong', 'sih'];
            foreach ($basicStopWords as $bw) {
                $highlightQuery = preg_replace('/\b' . $bw . '\b/i', '', $highlightQuery);
            }
            $highlightQuery = trim(preg_replace('/\s+/', ' ', $highlightQuery));
        }

        // ====================================================
        // STEP 6: SEARCH EXECUTION (OR-based, seperti Search Engine)
        // ====================================================
        $finalYear = $tahun ?: $smartYear;
        $finalAuthor = $penulis ?: $smartAuthor;

        $hasTextSearch = !empty($cleanQ);
        $hasSmartCategories = !empty($smartCategories);
        $hasManualCategory = !empty($kategori);

        // Bangun query Eloquent
        $booksQuery = Book::query()->with('category')->withCount('favoredByUsers');

        // -- PENGECUALIAN UNTUK PENCARIAN ISENG --
        if ($isBlockedQuery) {
            $booksQuery->where('id', '<', 0); // Force hasil kosong
        } else {
            // -- FILTER MANUAL DARI SIDEBAR (selalu ketat) --
        if ($hasManualCategory) {
            $booksQuery->where('category_id', $kategori);
        }

        // -- LOGIKA PENCARIAN UTAMA (OR-based) --
        if ($hasTextSearch && $hasSmartCategories && !$hasManualCategory) {
            // ==============================
            // KASUS: Teks + Kategori (Gabungan)
            // Contoh: "buku pendidikan kecerdasan buatan dan sejarah"
            //   → smartCategories = [Pendidikan, Kecerdasan Buatan, Sejarah]
            //   → cleanQ = "" (atau sisa kata kunci)
            // ==============================
            $stemmerFactory = new StemmerFactory();
            $stemmer = $stemmerFactory->createStemmer();
            $stemmedQ = $stemmer->stem($cleanQ);
            $searchWords = array_filter(explode(' ', $stemmedQ), fn($w) => strlen(trim($w)) > 1);
            
            $booksQuery->where(function($query) use ($smartCategories, $searchWords, $cleanQ) {
                // OR 1: Buku yang kategorinya cocok
                $query->whereIn('category_id', $smartCategories);
                
                // OR 2: Buku yang subjeknya mengandung kata kunci kategori
                $query->orWhere(function($q) use ($smartCategories, $searchWords) {
                    // Cari di subjek berdasarkan nama kategori
                    $catNames = Category::whereIn('id', $smartCategories)->pluck('nama');
                    foreach ($catNames as $catName) {
                        $q->orWhere('subjek', 'LIKE', '%' . $catName . '%');
                    }
                });
                
                // OR 3: Buku yang teksnya cocok (judul, deskripsi, penulis, subjek)
                if (!empty($searchWords)) {
                    $query->orWhere(function($q) use ($searchWords) {
                        foreach ($searchWords as $word) {
                            $word = trim($word);
                            $q->where(function($inner) use ($word) {
                                $inner->where('judul', 'LIKE', '%' . $word . '%')
                                      ->orWhere('deskripsi', 'LIKE', '%' . $word . '%')
                                      ->orWhere('penulis', 'LIKE', '%' . $word . '%')
                                      ->orWhere('subjek', 'LIKE', '%' . $word . '%');
                            });
                        }
                    });
                }
            });
            
        } elseif ($hasSmartCategories && !$hasTextSearch && !$hasManualCategory) {
            // ==============================
            // KASUS: Hanya Kategori (tanpa teks sisa)
            // Contoh: "buku pendidikan dan sejarah"
            //   → Tampilkan semua buku di kategori tersebut + yang subjeknya cocok
            // ==============================
            $booksQuery->where(function($query) use ($smartCategories) {
                $query->whereIn('category_id', $smartCategories);
                
                // Juga cari di subjek buku
                $catNames = Category::whereIn('id', $smartCategories)->pluck('nama');
                foreach ($catNames as $catName) {
                    // Pecah nama kategori untuk pencocokan yang lebih fleksibel
                    $keywords = array_filter(explode(' ', str_replace(['&', '/'], ' ', $catName)), fn($w) => strlen(trim($w)) > 3);
                    foreach ($keywords as $kw) {
                        $query->orWhere('subjek', 'LIKE', '%' . trim($kw) . '%');
                    }
                }
            });
            
        } elseif ($hasTextSearch) {
            // ==============================
            // KASUS: Hanya Teks (tanpa kategori terdeteksi)
            // Contoh: "kalkulus", "machine learning"
            // ==============================
            $stemmerFactory = new StemmerFactory();
            $stemmer = $stemmerFactory->createStemmer();
            $stemmedQ = $stemmer->stem($cleanQ);
            
            // Coba Scout dulu
            $scoutResults = Book::search($stemmedQ)->keys();
            
            if ($scoutResults->isNotEmpty()) {
                // Juga cari tambahan via LIKE untuk hasil lebih lengkap
                $searchWords = array_filter(explode(' ', $cleanQ), fn($w) => strlen(trim($w)) > 1);
                $booksQuery->where(function($query) use ($scoutResults, $searchWords) {
                    $query->whereIn('id', $scoutResults);
                    
                    // OR: tambahan dari LIKE search
                    foreach ($searchWords as $word) {
                        $word = trim($word);
                        $query->orWhere(function($inner) use ($word) {
                            $inner->where('judul', 'LIKE', '%' . $word . '%')
                                  ->orWhere('deskripsi', 'LIKE', '%' . $word . '%')
                                  ->orWhere('penulis', 'LIKE', '%' . $word . '%')
                                  ->orWhere('subjek', 'LIKE', '%' . $word . '%')
                                  ->orWhere('penerbit', 'LIKE', '%' . $word . '%');
                        });
                    }
                });
            } else {
                // Fallback: LIKE search
                $searchWords = array_filter(explode(' ', $cleanQ), fn($w) => strlen(trim($w)) > 1);
                if (!empty($searchWords)) {
                    $booksQuery->where(function($query) use ($searchWords) {
                        $first = true;
                        foreach ($searchWords as $word) {
                            $word = trim($word);
                            if ($first) {
                                $query->where(function($inner) use ($word) {
                                    $inner->where('judul', 'LIKE', '%' . $word . '%')
                                          ->orWhere('deskripsi', 'LIKE', '%' . $word . '%')
                                          ->orWhere('penulis', 'LIKE', '%' . $word . '%')
                                          ->orWhere('subjek', 'LIKE', '%' . $word . '%')
                                          ->orWhere('penerbit', 'LIKE', '%' . $word . '%');
                                });
                                $first = false;
                            } else {
                                // Kata kedua dst menggunakan OR agar lebih inklusif
                                $query->orWhere(function($inner) use ($word) {
                                    $inner->where('judul', 'LIKE', '%' . $word . '%')
                                          ->orWhere('deskripsi', 'LIKE', '%' . $word . '%')
                                          ->orWhere('penulis', 'LIKE', '%' . $word . '%')
                                          ->orWhere('subjek', 'LIKE', '%' . $word . '%')
                                          ->orWhere('penerbit', 'LIKE', '%' . $word . '%');
                                });
                            }
                        }
                    });
                }
            }
        }

        }

        // -- FILTER TAMBAHAN (Tahun, Penulis, Penerbit) --
        if ($finalYear) {
            $booksQuery->where('tahun_terbit', $finalYear);
        }
        if ($finalAuthor) {
            $booksQuery->where('penulis', 'LIKE', '%' . $finalAuthor . '%');
        }
        if ($smartPublisher) {
            $booksQuery->where('penerbit', 'LIKE', '%' . $smartPublisher . '%');
        }

        // -- SORTING --
        if ($sortField === 'favored_by_users_count') {
            $booksQuery->orderBy('favored_by_users_count', 'desc');
        } else {
            $booksQuery->orderBy($sortField, $sortDirection);
        }

        $books = $booksQuery->paginate(12)->withQueryString();

        // ====================================================
        // STEP 7: RESPONSE — Kirim data + metadata ke View
        // ====================================================
        $categories = Category::where('is_active', true)->get();
        $years = Book::selectRaw('DISTINCT tahun_terbit')->orderBy('tahun_terbit', 'desc')->pluck('tahun_terbit');
        $authors = Book::selectRaw('DISTINCT penulis')->orderBy('penulis', 'asc')->pluck('penulis');

        $schema = SchemaHelper::getSearchResultsSchema($books->items(), $cleanQ);

        // Bangun metadata feedback untuk ditampilkan ke user
        $searchFeedback = [];
        $spoTriplets = []; // Array untuk menampung format Subjek-Predikat-Objek
        
        if (!empty($smartCategoryNames)) {
            $searchFeedback['categories'] = $smartCategoryNames;
            foreach ($smartCategoryNames as $catName) {
                $spoTriplets[] = ['subject' => 'Buku', 'predicate' => 'memiliki_kategori', 'object' => $catName];
            }
        }
        if ($sortLabel) {
            $searchFeedback['sort'] = $sortLabel;
            $spoTriplets[] = ['subject' => 'Hasil_Pencarian', 'predicate' => 'diurutkan_berdasarkan', 'object' => $sortLabel];
        }
        if ($smartYear) {
            $searchFeedback['year'] = $smartYear;
            $spoTriplets[] = ['subject' => 'Buku', 'predicate' => 'diterbitkan_pada_tahun', 'object' => $smartYear];
        }
        if ($smartAuthor) {
            $searchFeedback['author'] = $smartAuthor;
            $spoTriplets[] = ['subject' => 'Buku', 'predicate' => 'ditulis_oleh', 'object' => $smartAuthor];
        }
        if ($smartPublisher) {
            $searchFeedback['publisher'] = $smartPublisher;
            $spoTriplets[] = ['subject' => 'Buku', 'predicate' => 'diterbitkan_oleh', 'object' => $smartPublisher];
        }
        if (!empty($cleanQ)) {
            $searchFeedback['keywords'] = $cleanQ;
            $spoTriplets[] = ['subject' => 'Buku', 'predicate' => 'mengandung_kata_kunci', 'object' => $cleanQ];
        }

        return view('user.catalog.index', [
            'books' => $books,
            'categories' => $categories,
            'years' => $years,
            'authors' => $authors,
            'schema' => $schema,
            'activeCategories' => $hasManualCategory ? [$kategori] : $smartCategories,
            'finalYear' => $finalYear,
            'finalAuthor' => $finalAuthor,
            'smartCategories' => $smartCategories,
            'smartCategoryNames' => $smartCategoryNames,
            'searchFeedback' => $searchFeedback,
            'spoTriplets' => $spoTriplets,
            'q' => $highlightQuery
        ]);
    }
}
