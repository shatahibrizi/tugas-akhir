<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaniLogsTable extends Migration
{
    public function up()
    {
        Schema::create('petani_logs', function (Blueprint $table) {
            $table->id('id_logs');
            $table->unsignedBigInteger('id_pengepul');
            $table->unsignedBigInteger('id_petani');
            $table->foreign('id_pengepul')->references('id_pengepul')->on('users')->onDelete('cascade');
            $table->foreign('id_petani')->references('id_petani')->on('petani')->onDelete('cascade');
            $table->string('action');
            $table->text('changes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('petani_logs');
    }
}
