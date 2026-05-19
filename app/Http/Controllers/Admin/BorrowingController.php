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

        $borrowings = Borrowing::with(['user', 'book' => function($q) {
            $q->withTrashed();
        }])
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

        $dueDate = Carbon::parse($borrowing->due_date)->startOfDay();
        $returnDate = Carbon::now()->startOfDay();
        $denda = 0;

        if ($returnDate->greaterThan($dueDate)) {
            $lateDays = $dueDate->diffInDays($returnDate);
            $denda = $lateDays * 2000;
        }

        $borrowing->update([
            'status' => 'returned',
            'return_date' => Carbon::now(),
            'denda' => $denda,
        ]);

        // Restore stock
        $borrowing->book->increment('stok_buku');

        return back()->with('success', 'Buku berhasil ditandai sebagai dikembalikan.');
    }

    public function approve(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Hanya peminjaman berstatus pending yang dapat disetujui.');
        }

        $borrowing->update([
            'status' => 'borrowed',
            'borrow_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(5), // Update due date to 5 days from approval
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function reject(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Hanya peminjaman berstatus pending yang dapat ditolak.');
        }

        $borrowing->update([
            'status' => 'rejected',
        ]);

        // Restore stock
        $borrowing->book->increment('stok_buku');

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function destroy(Borrowing $borrowing)
    {
        // If deleting a non-returned and non-rejected loan, we should restore stock
        if (in_array($borrowing->status, ['pending', 'borrowed', 'overdue'])) {
            $borrowing->book->increment('stok_buku');
        }
        
        $borrowing->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
