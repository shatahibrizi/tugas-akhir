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
            $table->enum('kecamatan', [
                'Aikmel', 'Jerowaru', 'Keruak', 'Labuan Haji', 'Lenek', 'Masbagik',
                'Montong Gading', 'Pringgabaya', 'Pringgasela', 'Sakra', 'Sakra Timur',
                'Sakra Barat', 'Sambelia', 'Selong', 'Sembalun', 'Sikur', 'Sukamulia',
                'Suralaga', 'Suela', 'Terara', 'Wanasaba', 'Ampenan', 'Cakranegara',
                'Mataram', 'Sandubaya', 'Sekarbela', 'Selaparang', 'Bayan', 'Gangga',
                'Kayangan', 'Pemenang', 'Tanjung', 'Batukliang', 'Batukliang Utara',
                'Janapria', 'Jonggat', 'Kopang', 'Praya', 'Praya Barat', 'Praya Barat Daya',
                'Praya Tengah', 'Praya Timur', 'Pringgarata', 'Pujut', 'Batu Layar',
                'Gunungsari', 'Lingsar', 'Narmada', 'Kediri', 'Labuapi', 'Kuripan',
                'Gerung', 'Lembar', 'Sekotong'
            ])->after('kabupaten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembeli', function (Blueprint $table) {
            //
        });
    }
};
