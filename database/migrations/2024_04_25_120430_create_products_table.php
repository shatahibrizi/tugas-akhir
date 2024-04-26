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
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk', 30);
            $table->text('deskripsi')->nullable();
            $table->integer('harga')->length(10)->nullable();
            $table->integer('jumlah')->length(8)->nullable();
            $table->string('estimasi_busuk', 8)->nullable();
            $table->string('foto_produk', 100)->nullable();
            $table->enum('grade', ['A', 'B', 'C'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
