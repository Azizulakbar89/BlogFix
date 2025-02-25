<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function myblog()
    {
        $userId = Auth::id();
        $artikel = Artikel::with(['kategoris', 'ratings'])
            ->where('idUser', $userId) // Filter berdasarkan idUser
            ->orderBy('idArtikel', 'desc')
            ->paginate(10);

        $kategori = Kategori::all();
        $recent1 = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(3)
            ->get();

        return view('akun.myblog', compact('artikel', 'kategori', 'recent1'));
    }

    public function destroy($idArtikel)
    {
        // Temukan artikel berdasarkan ID
        $artikel = Artikel::find($idArtikel);

        // Jika artikel tidak ditemukan
        if (!$artikel) {
            return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan'], 404);
        }

        // Ambil path gambar
        $gambarPath = $artikel->gambar;

        // Hapus artikel dari database
        $artikel->delete();

        // Hapus file gambar dari storage jika ada
        if ($gambarPath && Storage::exists('gambar/' . $gambarPath)) {
            Storage::delete('gambar/' . $gambarPath);
        }

        // Redirect dengan pesan sukses
        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus']);
    }

    public function show($id) {}
    public function edit($idArtikel)
    {
        $kategori = Kategori::all();
        $blog = Artikel::findOrFail($idArtikel); // Ambil satu data artikel berdasarkan ID
        $recent1 = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(3)
            ->get();

        return view('akun.edit-myblog', compact('blog', 'kategori', 'recent1'));
    }

    public function update(Request $request, $id)
    {
        $blog = Artikel::findOrFail($id);

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'idKategori' => 'required|exists:kategoris,idKategori',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480', // Maksimal 20MB
        ]);

        // Handle image upload
        $newName = $blog->gambar; // Simpan nama gambar lama sebagai default

        // Jika ada gambar baru, update
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($blog->gambar && Storage::exists('public/gambar/' . $blog->gambar)) {
                Storage::delete('public/gambar/' . $blog->gambar);
            }

            // Simpan gambar baru
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $newName = $request->judul . '-' . now()->timestamp . '.' . $extension;
            $request->file('gambar')->storeAs('gambar', $newName);
        }

        // Simpan perubahan pada database
        $blog->judul = $request->judul;
        $blog->idKategori = $request->idKategori;
        $blog->deskripsi = $request->deskripsi;
        $blog->gambar = $newName; // Simpan nama gambar baru atau lama
        $blog->save();

        // Redirect dengan pesan sukses
        return redirect()->route('myblog')->with('success', 'Artikel berhasil diupdate');
    }
}