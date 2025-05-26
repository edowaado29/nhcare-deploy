<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasianakasuh extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_anakasuh';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_anakasuh',
        'nama_prestasi'
    ];

    public function anakasuh()
    {
        return $this->belongsTo(Anakasuh::class, 'id_anakasuh');
    }
}
