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
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id('id_pembeli');
            $table->string('nama', 64);
            $table->string('email', 30)->unique();
            $table->string('username', 20)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('password', 20);
            $table->string('foto_profil', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembeli');
    }
};
