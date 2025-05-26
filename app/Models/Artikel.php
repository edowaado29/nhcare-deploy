<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judulArtikel',
        'deskripsiArtikel',
        'gambarArtikel',
    ];
    public function getGambarArtikelUrlAttribute($value)
    {
        return url('storage/artikels/' . $value);}
}
