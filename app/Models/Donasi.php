<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_transaksi',
        'nominal',
        'tanggal_donasi',
        'tujuan',
        'doa',
        'id_donatur'
    ];

    public function donatur()
    {
        return $this->belongsTo(Kedonaturan::class, 'id_donatur');
    }
}
