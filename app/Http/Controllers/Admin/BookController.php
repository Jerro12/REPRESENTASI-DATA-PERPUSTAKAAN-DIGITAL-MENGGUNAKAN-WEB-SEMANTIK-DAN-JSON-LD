<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'file_path' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $data = $request->except(['file_path', 'cover']);

        // Upload Cover
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Upload PDF
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('books', 'public');
        }

        // Default status if not set
        $data['status'] = $request->status ?? 'aktif';

        Book::create($data);

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
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['file_path', 'cover']);

        // Upload Cover Baru
        if ($request->hasFile('cover')) {
            // Hapus file lama jika ada
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Upload PDF Baru
        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
                Storage::disk('public')->delete($book->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('books', 'public');
        }

        $book->update($data);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Hapus buku
     */
    public function destroy(Book $book)
    {
        // Hapus file fisik
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }
        if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
            Storage::disk('public')->delete($book->file_path);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}