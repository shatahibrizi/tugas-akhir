<?php

namespace App\Models;

use App\Models\Pengepul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'id_petani',
        'id_kategori',
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

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id_petani');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
