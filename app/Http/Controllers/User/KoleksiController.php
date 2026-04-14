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
        $user = auth()->user();

        if ($user->favoriteBooks()->where('book_id', $bookId)->exists()) {
            $user->favoriteBooks()->detach($bookId);
            $status = 'removed';
            $message = 'Buku berhasil dihapus dari koleksi.';
        } else {
            $user->favoriteBooks()->attach($bookId);
            $status = 'added';
            $message = 'Buku berhasil disimpan ke koleksi.';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => $status, 'message' => $message]);
        }

        return back()->with('success', $message);
    }
}
