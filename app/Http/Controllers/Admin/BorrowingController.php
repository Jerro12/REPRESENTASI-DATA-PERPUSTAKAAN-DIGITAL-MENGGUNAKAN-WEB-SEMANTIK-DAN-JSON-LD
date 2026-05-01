<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $borrowings = Borrowing::with(['user', 'book'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('book', function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15);

        return view('admin.borrowing.index', compact('borrowings'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        $borrowing->update([
            'status' => 'returned',
            'return_date' => Carbon::now(),
        ]);

        // Restore stock
        $borrowing->book->increment('stok_buku');

        return back()->with('success', 'Buku berhasil ditandai sebagai dikembalikan.');
    }

    public function destroy(Borrowing $borrowing)
    {
        // If deleting a non-returned loan, maybe we should restore stock? 
        // Usually, we only delete old logs.
        $borrowing->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
