<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function detailKategori($idKategori)
    {
        //tambahan aja
        $recent1 = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(3)
            ->get();

        // Ambil kategori berdasarkan ID
        $kategoriList = Kategori::findOrFail($idKategori);

        // Ambil semua artikel yang terkait dengan kategori tersebut
        $artikel = Artikel::where('idKategori', $idKategori)->get();

        // Ambil data kategori untuk dropdown (jika diperlukan)
        $kategori = Kategori::all();


        // Kirim data ke view
        return view('kategori.detail', compact('kategori', 'artikel', 'kategoriList', 'recent1'));
    }
}