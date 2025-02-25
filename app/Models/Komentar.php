<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'idArtikel', 'idArtikel');
    }
}