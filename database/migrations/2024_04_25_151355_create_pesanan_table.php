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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->integer('jumlah')->length(5)->nullable();

            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('restrict');
            $table->unsignedBigInteger('id_pembeli');
            $table->foreign('id_pembeli')->references('id_pembeli')->on('pembeli')->onDelete('restrict');

            $table->enum('status', ['Gagal', 'Diproses', 'Selesai'])->nullable();
            $table->date('tanggal_pesanan')->nullable();
            $table->enum('metode_pembayaran', ['COD', 'Transfer'])->nullable();
            $table->integer('total_harga')->length(9)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
