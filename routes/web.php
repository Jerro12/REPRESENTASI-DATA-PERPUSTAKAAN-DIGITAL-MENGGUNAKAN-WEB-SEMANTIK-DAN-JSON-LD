<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
// use App\Http\Controllers\Admin\BookController;
// use App\Http\Controllers\Admin\MetadataController;
// use App\Http\Controllers\Admin\JsonLDValidatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

        // Mengelola Buku
        // Route::resource('/books', BookController::class);

        // Mengelola Metadata JSON-LD
        // Route::get('/metadata', [MetadataController::class, 'index'])->name('metadata.index');
        // Route::post('/metadata/{book}/update', [MetadataController::class, 'update'])->name('metadata.update');

        // Validasi JSON-LD
        // Route::get('/jsonld-validator', [JsonLDValidatorController::class, 'index'])
        //     ->name('jsonld.validator');
        // Route::post('/jsonld-validator/check', [JsonLDValidatorController::class, 'check'])
        //     ->name('jsonld.validator.check');
    });

require __DIR__ . '/auth.php';
