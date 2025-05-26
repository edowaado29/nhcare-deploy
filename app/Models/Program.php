<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaProgram',
        'deskripsiProgram',
        'gambarProgram'
    ];
    public function getGambarProgramUrlAttribute($value)
    {
        return url('storage/programs/' . $value);}
}

