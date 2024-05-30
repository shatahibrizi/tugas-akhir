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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->unsignedBigInteger('id_pembeli');
            $table->foreign('id_pembeli')->references('id_pembeli')->on('pembeli')->onDelete('cascade');
            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('cascade');
            $table->integer('jumlah')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
