<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $primaryKey = 'idKomentar';
    protected $fillable = ['idUser', 'idArtikel', 'komentar', 'rating'];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'idArtikel', 'idArtikel');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id'); // Sesuaikan dengan nama foreign key
    }
}