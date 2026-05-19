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

        // Check if user already has an active or pending borrowing for this book
        $existing = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'borrowed'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah mengajukan peminjaman atau sedang meminjam buku ini.');
        }

        // Create borrowing record with pending status
        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(5), // Default 5 days from now (will be updated when approved)
            'status' => 'pending',
        ]);

        // Decrement stock to reserve it
        $book->decrement('stok_buku');

        return back()->with('success', 'Pengajuan pinjam buku berhasil. Silakan tunggu persetujuan admin.');
    }
}
