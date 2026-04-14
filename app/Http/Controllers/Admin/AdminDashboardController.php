<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku' => \App\Models\Book::count(),
            'total_kategori' => \App\Models\Category::count(),
            'total_penulis' => \App\Models\Book::distinct('penulis')->count('penulis'),
            'total_stok' => \App\Models\Book::count(), // Placeholder since no stock field exists
        ];

        $recentBooks = \App\Models\Book::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBooks'));
    }
}
