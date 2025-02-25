<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('blogs')->middleware('guest');

Route::get('/', [HomeController::class, 'index'])->name('blogs')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [HomeController::class, 'akun'])->name('dashboard');

    Route::get('/kategori/{id}', [HomeController::class, 'showKategori']);

    Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
    Route::post('/create', [BlogController::class, 'store'])->name('create');

    Route::get('/myblog', [ArtikelController::class, 'myblog'])->name('myblog');
    Route::get('/artikel/{idArtikel}', [ArtikelController::class, 'show'])->name('artikel.show');
    Route::get('/artikel/{idArtikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{idArtikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{idArtikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
});

require __DIR__ . '/auth.php';