<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    // Tampilkan koleksi buku favorit user
    public function index()
    {
        $books = auth()->user()->favoriteBooks()->with('category')->paginate(12);

        return view('user.collection.index', compact('books'));
    }

    // Toggle simpan / hapus buku favorit
    public function toggle(Request $request, $bookId)
    {
        $user = $request->user();

        if ($user->favoriteBooks()->where('book_id', $bookId)->exists()) {
            $user->favoriteBooks()->detach($bookId);
            $status = 'removed';
        } else {
            $user->favoriteBooks()->attach($bookId);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }
}
