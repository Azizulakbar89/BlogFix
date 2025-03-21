<?php

namespace App\Http\Controllers;

use session;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function blog()
    {
        // Ambil semua data kategori dan artikel

        $kategori = Kategori::all();
        $blog = Artikel::all();
        $recent1 = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(3)
            ->get();

        // Tampilkan view dengan data kategori dan artikel
        return view('akun.blog', compact('blog', 'kategori', 'recent1'));
    }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'idKategori' => 'required|exists:kategoris,idKategori',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        // Handle image upload
        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->judul . '-' . now()->timestamp . '.' . $extension;
            $path = $request->file('image')->storeAs($newName);
        }

        // $newName = '';
        // if ($request->file('image')) { // Sesuaikan dengan nama field di form
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $newName = $request->judul . '-' . now()->timestamp . '.' . $extension;
        //     $path = $request->file('image')->storeAs('gambar', $newName, 'public'); // Simpan di disk 'public'
        // }

        // Create the article
        // $artikel = Artikel::create([
        //     'idKategori' => $request->idKategori,
        //     'idUser' => Auth::id(), // Ensure the user is authenticated
        //     'judul' => $request->judul,
        //     'gambar' => $newName,
        //     'deskripsi' => $request->deskripsi,
        //     'created_at' => now(),
        // ]);

        $artikel = Artikel::create([
            'idKategori' => $request->idKategori,
            'idUser' => Auth::id(), // Pastikan pengguna sudah terautentikasi
            'judul' => $request->judul,
            'gambar' => $newName,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
        ]);

        // Check if the article was created successfully
        if ($artikel) {
            session()->flash('success', 'Artikel berhasil dibuat!');
        } else {
            session()->flash('error', 'Gagal membuat artikel!');
        }
        return redirect()->route('blog');
    }


    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'judul' => 'required|string|max:255',
    //         'deskripsi' => 'required|string',
    //         'idKategori' => 'required|exists:kategoris,idKategori',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480', // Pastikan ini sesuai dengan field di form
    //     ]);

    //     // Handle image upload
    //     $newName = '';
    //     if ($request->file('image')) { // Sesuaikan dengan nama field di form
    //         $extension = $request->file('image')->getClientOriginalExtension();
    //         $newName = $request->judul . '-' . now()->timestamp . '.' . $extension;
    //         $path = $request->file('image')->storeAs('gambar', $newName, 'public'); // Simpan di disk 'public'
    //     }

    //     // Create the article
    //     $artikel = Artikel::create([
    //         'idKategori' => $request->idKategori,
    //         'idUser' => Auth::id(), // Pastikan pengguna sudah terautentikasi
    //         'judul' => $request->judul,
    //         'gambar' => $newName,
    //         'deskripsi' => $request->deskripsi,
    //         'created_at' => now(),
    //     ]);

    //     // Redirect dengan pesan sukses atau error
    //     if ($artikel) {
    //         return redirect()->route('blog')->with('success', 'Artikel berhasil dibuat!');
    //     } else {
    //         return redirect()->route('blog')->with('error', 'Gagal membuat artikel!');
    //     }
    // }
}
