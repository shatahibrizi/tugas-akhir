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
            $table->dropColumn('status');
            $table->dropColumn('tanggal_pesanan');
            $table->dropColumn('metode_pembayaran');
            $table->dropColumn('total_harga');
            $table->date('tanggal')->nullable()->after('id_pengepul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tambah_produk', function (Blueprint $table) {
            $table->enum('status', ['Gagal', 'Diproses', 'Selesai'])->nullable();
            $table->date('tanggal_pesanan')->nullable();
            $table->enum('metode_pembayaran', ['COD', 'Transfer'])->nullable();
            $table->integer('total_harga')->length(9)->nullable();
            $table->dropColumn('tanggal');
        });
    }
};
