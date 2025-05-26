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
        Schema::create('pengasuhs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string("nbm")->nullable();
            $table->string("nama_pengasuh");
            $table->string("jenis_kelamin")->nullable();
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("pendidikan_terakhir")->nullable();
            $table->unsignedBigInteger('id_jabatan');
            $table->string("alamat")->nullable();
            $table->string("nomor_handphone")->nullable();
            $table->string("email")->nullable();
            $table->date("tanggal_masuk")->nullable();
            $table->string('foto_kartukeluarga')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_pengasuh')->nullable();
            $table->timestamps();

            $table->foreign('id_jabatan')->references('id')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengasuhs');
    }
};
