<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            'books' => Book::latest()->take(6)->get(),
            'categories' => Category::withCount('books')
                ->orderByDesc('books_count')
                ->take(8)
                ->get(),
        ]);
    }
}