<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    // public function kategoris()
    // {
    //     return $this->belongsTo(Kategori::class, 'idKategori');
    // }

    protected $primaryKey = 'idArtikel';
    protected $fillable = ['idKategori', 'idUser', 'judul', 'deskripsi', 'gambar'];

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'idKategori', 'idKategori');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Komentar::class, 'idArtikel', 'idArtikel');
    }
}