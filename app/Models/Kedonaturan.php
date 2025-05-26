<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kedonaturan extends Authenticatable
{
    
    use HasApiTokens, HasFactory, Notifiable;


    protected $primaryKey = 'id_donatur';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_donatur',
        'nama_donatur',
        'nomor_handphone',
        'alamat',
        'jenis_kelamin',
        'email',
        'password',
        'pertanyaan',
        'jawaban',
        'foto_donatur',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $currentDateTime = Carbon::now()->format('YmdHisu');
            $model->id_donatur = "D-". $currentDateTime;
        });
    }
}
