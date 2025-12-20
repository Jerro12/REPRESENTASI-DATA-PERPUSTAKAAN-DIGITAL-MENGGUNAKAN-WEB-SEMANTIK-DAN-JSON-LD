<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Tampilkan semua buku
     */
    public function index()
    {
        $books = Book::with('category')->latest()->get(); // ambil relasi kategori
        $categories = Category::where('is_active', 1)->get(); // untuk dropdown create/edit
        return view('admin.book.index', compact('books', 'categories'));
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|string|unique:books,kode_buku',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'isbn' => 'nullable|string|unique:books,isbn',
            'bahasa' => 'nullable|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'deskripsi' => 'nullable|string',
            'subjek' => 'nullable|string|max:255',
            'status' => 'nullable|in:aktif,nonaktif',
            'jumlah_halaman' => 'nullable|integer',
            'file_path' => 'nullable|string|max:255',
            'cover' => 'nullable|string|max:255',
        ]);

        Book::create([
            'kode_buku' => $request->kode_buku,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'bahasa' => $request->bahasa,
            'category_id' => $request->category_id,
            'deskripsi' => $request->deskripsi,
            'subjek' => $request->subjek,
            'status' => $request->status ?? 'aktif', // default aktif
            'jumlah_halaman' => $request->jumlah_halaman,
            'file_path' => $request->file_path,
            'cover' => $request->cover,
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Update buku
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'kode_buku' => 'required|string|unique:books,kode_buku,' . $book->id,
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'isbn' => 'nullable|string|unique:books,isbn,' . $book->id,
            'bahasa' => 'nullable|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'deskripsi' => 'nullable|string',
            'subjek' => 'nullable|string|max:255',
            'status' => 'nullable|in:aktif,nonaktif',
            'jumlah_halaman' => 'nullable|integer',
            'file_path' => 'nullable|string|max:255',
            'cover' => 'nullable|string|max:255',
        ]);

        $book->update([
            'kode_buku' => $request->kode_buku,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'bahasa' => $request->bahasa,
            'category_id' => $request->category_id,
            'deskripsi' => $request->deskripsi,
            'subjek' => $request->subjek,
            'status' => $request->status ?? 'aktif',
            'jumlah_halaman' => $request->jumlah_halaman,
            'file_path' => $request->file_path,
            'cover' => $request->cover,
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Hapus buku
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}