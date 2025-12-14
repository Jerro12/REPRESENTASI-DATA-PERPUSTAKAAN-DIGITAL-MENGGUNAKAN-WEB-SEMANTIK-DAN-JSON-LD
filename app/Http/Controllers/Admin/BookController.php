<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|string|unique:books,kode_buku',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|unique:books,isbn',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Book::create($request->all());

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'kode_buku' => 'required|string|unique:books,kode_buku,' . $book->id,
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|unique:books,isbn,' . $book->id,
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $book->update($request->all());

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
