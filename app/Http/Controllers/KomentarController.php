<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'idArtikel' => 'required|exists:artikels,idArtikel',
            'komentar' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        try {
            // Dapatkan ID user yang sedang login
            $idUser = Auth::id();

            // Simpan komentar dan rating ke dalam tabel komentars
            $komentar = new Komentar();
            $komentar->idUser = $idUser;
            $komentar->idArtikel = $request->idArtikel;
            $komentar->komentar = $request->komentar;
            $komentar->rating = $request->rating;
            $komentar->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan gagal jika terjadi error
            return redirect()->back()->with('error', 'Gagal menambahkan komentar: ' . $e->getMessage());
        }
    }
}