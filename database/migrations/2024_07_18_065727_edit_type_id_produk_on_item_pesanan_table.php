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
        Schema::table('item_pesanan', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_pesanan', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('restrict')->change();
        });
    }
};
