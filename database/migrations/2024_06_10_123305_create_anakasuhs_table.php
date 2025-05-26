<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anakasuhs', function (Blueprint $table) {
            $table->string('id_anakasuh')->primary();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('asrama')->nullable();
            $table->string('no_akta')->nullable();
            $table->string('img_akta')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('img_kk')->nullable();
            $table->string('no_skko')->nullable();
            $table->string('img_skko')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('tingkat')->nullable();
            $table->string('kelas')->nullable();
            $table->string('cabang')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('nik_wali')->nullable();
            $table->string('img_anak')->nullable();
            $table->timestamps();
            $table->string('status_anak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anakasuhs');
    }
};
