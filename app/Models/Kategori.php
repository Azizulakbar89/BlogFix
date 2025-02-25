<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'idKategori';

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'idKategori', 'idKategori');
    }
    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'idKategori', 'idKategori');
    }
}