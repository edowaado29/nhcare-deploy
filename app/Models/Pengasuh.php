<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengasuh extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nbm',
        'nama_pengasuh',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'id_jabatan',
        'alamat',
        'nomor_handphone',
        'email',
        'tanggal_masuk',
        'status_pengasuh',
        'foto_kartukeluarga',
        'foto_ktp',
        'foto_pengasuh'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
