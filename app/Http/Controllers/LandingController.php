<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            // 3 buku terbaru
            'books' => Book::with('category')
                ->latest()
                ->take(3)
                ->get(),

            // Kategori terpopuler
            'categories' => Category::withCount('books')
                ->orderByDesc('books_count')
                ->take(8)
                ->get(),
        ]);
    }
}