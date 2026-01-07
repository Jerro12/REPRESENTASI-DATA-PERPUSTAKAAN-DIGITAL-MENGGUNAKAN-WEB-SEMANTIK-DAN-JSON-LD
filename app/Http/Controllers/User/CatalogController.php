<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class CatalogController extends Controller
{
    /**
     * Tampilkan halaman katalog buku
     */
    public function index(Request $request)
    {
        // Tangkap input search & filter
        $q = $request->input('q');
        $kategori = $request->input('kategori');
        $tahun = $request->input('tahun');

        // Logic Smart Search / "Google-like"
        // Jika user mengetikkan sesuatu di 'q', kita coba ekstrak informasi berguna
        $smartYear = null;
        $cleanQ = $q;
        
        $sortField = 'created_at';
        $sortDirection = 'desc';

        if ($q) {
            // 1. Coba cari tahun 4 digit (misal: 2020, 2023)
            if (preg_match('/\b(19|20)\d{2}\b/', $q, $matches)) {
                $smartYear = $matches[0];
                $cleanQ = str_replace($smartYear, '', $cleanQ);
            }

            // 2. Deteksi Intent Sorting (Terbaru, Terlama, Populer)
            if (preg_match('/\b(terbaru|baru)\b/i', $q)) {
                $sortField = 'created_at';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(terbaru|baru)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(terlama|lama)\b/i', $q)) {
                $sortField = 'created_at';
                $sortDirection = 'asc';
                $cleanQ = preg_replace('/\b(terlama|lama)\b/i', '', $cleanQ);
            } elseif (preg_match('/\b(populer|favorit)\b/i', $q)) {
                $sortField = 'favored_by_users_count';
                $sortDirection = 'desc';
                $cleanQ = preg_replace('/\b(populer|favorit)\b/i', '', $cleanQ);
            }

            // 3. Hapus "stop words"
            $stopWords = ['buku', 'yang', 'terbit', 'tahun', 'pada', 'tentang', 'kategori', 'penulis', 'judul', 'di', 'dan', 'atau'];
            foreach ($stopWords as $word) {
                $cleanQ = preg_replace('/\b' . $word . '\b/i', '', $cleanQ);
            }

            // Bersihkan spasi ganda
            $cleanQ = trim(preg_replace('/\s+/', ' ', $cleanQ));
        }

        // Jika user secara eksplisit memilih filter tahun di UI (dropdown), itu prioritas.
        $finalYear = $tahun ?: $smartYear;

        // Query buku
        $books = Book::with('category')
            ->withCount('favoredByUsers') // Untuk sorting populer
            ->when($q, function ($query) use ($cleanQ) {
                // Pencarian teks menggunakan $cleanQ (keyword bersih)
                if (!empty($cleanQ)) {
                    $query->where(function ($sub) use ($cleanQ) {
                        $sub->where('judul', 'like', "%$cleanQ%")
                            ->orWhere('penulis', 'like', "%$cleanQ%")
                            ->orWhere('penerbit', 'like', "%$cleanQ%")
                            ->orWhere('isbn', 'like', "%$cleanQ%")
                            ->orWhere('deskripsi', 'like', "%$cleanQ%")
                            ->orWhere('subjek', 'like', "%$cleanQ%")
                            ->orWhereHas('category', function ($qCategory) use ($cleanQ) {
                                $qCategory->where('nama', 'like', "%$cleanQ%");
                            });
                    });
                }
            })
            ->when($kategori, function ($query, $kategori) {
                $query->where('category_id', $kategori);
            })
            ->when($finalYear, function ($query, $year) {
                $query->where('tahun_terbit', $year);
            })
            // Sorting Dinamis
            ->when($sortField == 'favored_by_users_count', function ($query) {
                return $query->orderBy('favored_by_users_count', 'desc');
            }, function ($query) use ($sortField, $sortDirection) {
                return $query->orderBy($sortField, $sortDirection);
            })
            ->paginate(12)
            ->withQueryString(); // biar search & filter tetap di pagination

        // Ambil kategori aktif & tahun unik
        $categories = Category::where('is_active', true)->get();
        $years = Book::selectRaw('DISTINCT tahun_terbit')->orderBy('tahun_terbit', 'desc')->pluck('tahun_terbit');

        return view('user.catalog.index', compact('books', 'categories', 'years'));
    }

    /**
     * Tampilkan halaman detail buku
     */
    public function show(Book $book)
    {
        $book->load('category');
        return view('user.catalog.show', compact('book'));
    }
}
