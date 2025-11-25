<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController; // Pastikan baris ini ada
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware Auth
Route::middleware('auth')->group(function () {
    
    // --- Route untuk Soal Ujian (Produk) ---
    Route::resource('products', ProductController::class);

    // --- Route Bawaan Profile (WAJIB ADA agar tidak error) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';