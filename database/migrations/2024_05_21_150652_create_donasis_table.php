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
        Schema::create('donasis', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->double('nominal');
            $table->date('tanggal_donasi');
            $table->string('tujuan');
            $table->string('doa');
            $table->string('id_donatur');
            $table->timestamps();

            $table->foreign('id_donatur')->references('id_donatur')->on('kedonaturans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
