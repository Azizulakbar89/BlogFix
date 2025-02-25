<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Artikel::with(['kategoris', 'users'])
            ->latest()
            ->first();

        // mengambil 2 data dari data ke 1 yang paling terbaru
        $blogss = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->skip(1)
            ->take(2)
            ->get();

        // mengambil data paling terbaru
        $recent = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(4)
            ->get();

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
                    ? $artikel->total_rating / $artikel->count_rating
                    : 0;
                return $artikel;
            })
            ->sortByDesc('avg_rating') // Urutkan berdasarkan avg_rating
            ->take(5); // Ambil 5 artikel terbaik


        $artikel = Artikel::with([
            'kategoris',
            'ratings',
        ])->orderBy("idArtikel", "desc")->paginate(10);

        $kategori = Kategori::all();
        $recent1 = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(3)
            ->get();

        return view('dashboard', compact('blogs', 'blogss', 'recent', 'popular', 'artikel', 'kategori', 'recent1'));
    }

    public function akun()
    {
        $blogs = Artikel::with(['kategoris', 'users'])
            ->latest()
            ->first();

        // mengambil 2 data dari data ke 1 yang paling terbaru
        $blogss = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->skip(1)
            ->take(2)
            ->get();

        // mengambil data paling terbaru
        $recent = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(8)
            ->get();

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
                    ? $artikel->total_rating / $artikel->count_rating
                    : 0;
                return $artikel;
            })
            ->sortByDesc('avg_rating') // Urutkan berdasarkan avg_rating
            ->take(5); // Ambil 5 artikel terbaik

        $artikel = Artikel::with([
            'kategoris',
            'ratings',
        ])->orderBy("idArtikel", "desc")->paginate(10);

        $kategori = Kategori::all();
        $recent1 = Artikel::with(['kategoris'])
            ->orderBy('idArtikel', 'desc')
            ->take(3)
            ->get();

        return view('dashboard', compact('blogs', 'blogss', 'recent', 'popular', 'artikel', 'kategori', 'recent1'));
    }

    public function showKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        $blogs = Artikel::where('idKategori', $id)->get();

        return view('kategori', compact('kategori', 'blogs'));
    }
}