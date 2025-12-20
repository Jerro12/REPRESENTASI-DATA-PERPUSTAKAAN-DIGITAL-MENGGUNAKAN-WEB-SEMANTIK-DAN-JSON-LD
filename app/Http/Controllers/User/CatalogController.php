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

        // Query buku
        $books = Book::with('category')
            ->when($q, function ($query, $q) {
                $query->where('judul', 'like', "%$q%")
                    ->orWhere('penulis', 'like', "%$q%")
                    ->orWhereHas('category', function ($qCategory) use ($q) {
                        $qCategory->where('nama', 'like', "%$q%");
                    });
            })
            ->when($kategori, function ($query, $kategori) {
                $query->where('category_id', $kategori);
            })
            ->when($tahun, function ($query, $tahun) {
                $query->where('tahun_terbit', $tahun);
            })
            ->orderBy('created_at', 'desc')
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
