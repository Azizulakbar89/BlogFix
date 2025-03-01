<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('blogs')->middleware('guest');

Route::get('/', [HomeController::class, 'index'])->name('blogs')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [HomeController::class, 'akun'])->name('dashboard');

    Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
    Route::post('/create', [BlogController::class, 'store'])->name('create');

    Route::get('/myblog', [ArtikelController::class, 'myblog'])->name('myblog');
    Route::get('/kat', [ArtikelController::class, 'kategori'])->name('kategori');
    Route::post('/kategori/store', [ArtikelController::class, 'store'])->name('kategori.store');
    Route::get('/artikel/{idArtikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{idArtikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{idArtikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
});

Route::get('/artikel/{idArtikel}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/kategorishow/{idKategori}', [KategoriController::class, 'detailKategori'])->name('kategori.detail');
Route::post('/komentar/store', [KomentarController::class, 'store'])->name('komentar.store');



require __DIR__ . '/auth.php';
