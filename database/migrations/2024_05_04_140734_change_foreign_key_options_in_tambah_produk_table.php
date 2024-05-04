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
        Schema::table('tambah_produk', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('cascade');

            $table->dropForeign(['id_pengepul']);
            $table->foreign('id_pengepul')->references('id_pengepul')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tambah_produk', function (Blueprint $table) {
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('restrict');
            $table->foreign('id_pengepul')->references('id_pengepul')->on('users')->onDelete('restrict');
        });
    }
};
