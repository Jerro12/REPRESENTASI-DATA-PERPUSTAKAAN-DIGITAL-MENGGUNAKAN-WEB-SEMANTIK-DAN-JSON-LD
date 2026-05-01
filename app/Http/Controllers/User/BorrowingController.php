<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        // Check if book has stock
        if ($book->stok_buku <= 0) {
            return back()->with('error', 'Stok buku ini sedang kosong.');
        }

        // Check if user already has an active borrowing for this book
        $existing = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sedang meminjam buku ini.');
        }

        // Create borrowing record
        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(7), // Default 7 days
            'status' => 'borrowed',
        ]);

        // Decrement stock
        $book->decrement('stok_buku');

        return back()->with('success', 'Buku berhasil dipinjam. Silakan ambil di perpustakaan.');
    }
}
