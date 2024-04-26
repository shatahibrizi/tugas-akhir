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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id_petani')->required()->after('harga');
            $table->foreign('id_petani')->references('id_petani')->on('petani')->onDelete('restrict');

            $table->unsignedBigInteger('id_kategori')->required()->after('id_petani');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);
            $table->dropColumn('id_kategori');

            $table->dropForeign(['id_petani']);
            $table->dropColumn('id_petani');
        });
    }
};
