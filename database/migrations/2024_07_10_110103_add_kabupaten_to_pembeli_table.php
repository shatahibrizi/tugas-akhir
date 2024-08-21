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
        Schema::table('pembeli', function (Blueprint $table) {
            $table->enum('kabupaten', ['Lombok Utara', 'Lombok Timur', 'Lombok Tengah', 'Mataram', 'Lombok Barat'])->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembeli', function (Blueprint $table) {
            $table->dropColumn('kabupaten');
        });
    }
};
