<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Helpers\SchemaHelper;

class LandingController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_categories' => Category::count(),
            'total_writers' => Book::distinct('penulis')->count('penulis'),
        ];

        // 4 buku terbaru
        $books = Book::with('category')
            ->where('status', 'aktif')
            ->latest()
            ->take(4)
            ->get();

        // 6 kategori teratas
        $categories = Category::withCount('books')
            ->orderByDesc('books_count')
            ->take(6)
            ->get();

        $schema = SchemaHelper::getLibrarySchema($books);

        return view('landing', compact('stats', 'books', 'categories', 'schema'));
    }
}