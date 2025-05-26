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
        Schema::create('prestasianakasuhs', function (Blueprint $table) {
            $table->string('id_anakasuh');
            $table->string('nama_prestasi')->nullable();
            $table->timestamps();

            $table->foreign('id_anakasuh')->references('id_anakasuh')->on('anakasuhs');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasianakasuhs');
    }
};
