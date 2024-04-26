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
        Schema::create('petani', function (Blueprint $table) {
            $table->id('id_petani');
            $table->string('nama', 64);
            $table->string('alamat', 100)->nullable();
            $table->integer('no_hp')->length(13)->nullable();
            $table->string('luas_lahan', 10)->nullable();
            $table->string('lokasi_lahan', 100)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('grup_petani', 20)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petani');
    }
};
