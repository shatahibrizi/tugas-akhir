<?php

namespace App\Models;

use App\Models\Pengepul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'jumlah',
        'estimasi_busuk',
        'foto_produk',
        'grade',
    ];

    public function pengepul()
    {
        return $this->belongsToMany(Pengepul::class, 'tambah_produk', 'id_produk', 'id_pengepul');
    }

    public function pembeli()
    {
        return $this->belongsToMany(Pembeli::class, 'pesanan', 'id_produk', 'id_pembeli');
    }
}
