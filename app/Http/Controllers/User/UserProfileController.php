<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil riwayat peminjaman
        $borrowings = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Statistik
        $stats = [
            'total' => $borrowings->count(),
            'active' => $borrowings->whereIn('status', ['pending', 'borrowed'])->count(),
            'returned' => $borrowings->where('status', 'returned')->count(),
        ];

        return view('user.profile.index', compact('user', 'borrowings', 'stats'));
    }
}
