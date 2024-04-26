<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_pengepul');
            $table->string('nama', 64);
            $table->string('email', 30)->unique();
            $table->string('username', 20)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('password', 20);
            $table->integer('no_hp')->length(13)->nullable();
            $table->integer('no_rek')->length(20)->nullable();
            $table->string('foto_profil', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
