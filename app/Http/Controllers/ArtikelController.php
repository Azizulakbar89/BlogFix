<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if ($gambarPath && Storage::exists('/public/storage' . $gambarPath)) {
            Storage::delete('/public/storage' . $gambarPath);
        }

        // Redirect dengan pesan sukses
        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus']);
    }

    public function show($idArtikel)
    {
        // Ambil semua kategori
        $kategori = Kategori::all();

        // Cari artikel berdasarkan idArtikel
        $artikel = Artikel::findOrFail($idArtikel);

        // Hitung jumlah komentar untuk artikel ini
        $jumlahKomentar = $artikel->komentars()->count();

        // Ambil data komentar berdasarkan idArtikel
        $komentars = $artikel->komentars()->with('user')->get(); // Jika komentar memiliki relasi ke user

        // Ambil 3 artikel terbaru
        $recent1 = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(3)
            ->get();

        // Ambil 5 artikel terpopuler berdasarkan rating
        $popular = Artikel::with(['kategoris', 'ratings'])
            ->withCount([
                'ratings as total_rating' => function ($query) {
                    $query->select(DB::raw('COALESCE(SUM(rating), 0)')); // Total rating
                },
                'ratings as count_rating' => function ($query) {
                    $query->select(DB::raw('COUNT(rating)')); // Jumlah rating
                }
            ])
            ->get() // Ambil semua data dulu
            ->map(function ($artikel) {
                // Hitung rata-rata rating di PHP
                $artikel->avg_rating = $artikel->count_rating > 0
                    ? ceil($artikel->total_rating / $artikel->count_rating) // Bulatkan ke atas
                    : 0;
                return $artikel;
            })
            ->sortByDesc('avg_rating') // Urutkan berdasarkan avg_rating
            ->take(5); // Ambil 5 artikel terbaik
        $totalRating = $artikel->ratings()->sum('rating');
        $countRating = $artikel->ratings()->count();
        $artikel->avg_rating = $countRating > 0 ? ceil($totalRating / $countRating) : 0;

        // Kirim data ke view
        return view('akun.show', compact('artikel', 'recent1', 'kategori', 'jumlahKomentar', 'popular', 'komentars'));
    }

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
            if ($blog->gambar && Storage::exists('/public/storage' . $blog->gambar)) {
                Storage::delete('/public/storage' . $blog->gambar);
            }

            // Simpan gambar baru
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $newName = $request->judul . '-' . now()->timestamp . '.' . $extension;
            $request->file('gambar')->storeAs($newName);
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

    public function kategori()
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

        return view('akun.kategori', compact('artikel', 'kategori', 'recent1'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|string|max:255|unique:kategoris,kategori',
        ]);

        // Simpan data ke database
        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
