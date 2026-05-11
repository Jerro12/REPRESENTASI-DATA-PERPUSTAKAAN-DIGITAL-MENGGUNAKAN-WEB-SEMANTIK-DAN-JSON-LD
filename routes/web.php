<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\SearchEngineController;
use App\Http\Controllers\User\KoleksiController;
use App\Http\Controllers\User\BorrowingController;
use App\Http\Controllers\LandingController;


Route::get('/', [LandingController::class, 'index']);

// Daftar Kategori
Route::get('/kategori-buku', [App\Http\Controllers\User\UserCategoryController::class, 'index'])
    ->name('kategori.index');

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard User menggunakan halaman landing premium
    Route::get('/dashboard', [App\Http\Controllers\LandingController::class, 'index'])->name('dashboard');

    // Katalog Buku (Menggunakan Search Engine Controller untuk NLP Search)
    Route::get('/katalog', [SearchEngineController::class, 'index'])
        ->name('katalog.index');

    // Detail Buku
    Route::get('/katalog/{book}', [CatalogController::class, 'show'])
        ->name('katalog.show');

    // Koleksi Favorit
    Route::get('/koleksi', [KoleksiController::class, 'index'])
        ->name('koleksi');

    // Daftar Kategori
    Route::get('/kategori-buku', [App\Http\Controllers\User\UserCategoryController::class, 'index'])
        ->name('kategori.index');

    Route::post('/koleksi/toggle/{book}', [KoleksiController::class, 'toggle'])
        ->name('koleksi.toggle');

    Route::post('/pinjam/{book}', [BorrowingController::class, 'store'])
        ->name('borrowing.store');
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Kategori
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Buku
        Route::get('books', [BookController::class, 'index'])->name('books.index');
        Route::post('books', [BookController::class, 'store'])->name('books.store');
        Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // Peminjaman
        Route::get('borrowings', [\App\Http\Controllers\Admin\BorrowingController::class, 'index'])->name('borrowings.index');
        Route::post('borrowings/{borrowing}/approve', [\App\Http\Controllers\Admin\BorrowingController::class, 'approve'])->name('borrowings.approve');
        Route::post('borrowings/{borrowing}/reject', [\App\Http\Controllers\Admin\BorrowingController::class, 'reject'])->name('borrowings.reject');
        Route::post('borrowings/{borrowing}/return', [\App\Http\Controllers\Admin\BorrowingController::class, 'returnBook'])->name('borrowings.return');
        Route::delete('borrowings/{borrowing}', [\App\Http\Controllers\Admin\BorrowingController::class, 'destroy'])->name('borrowings.destroy');
    });

require __DIR__ . '/auth.php';