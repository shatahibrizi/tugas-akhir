<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'qr_code_path',
    ];

    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'item_pesanan', 'id_produk', 'id_pesanan')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    public function pengepul()
    {
        return $this->belongsToMany(Pengepul::class, 'tambah_produk', 'id_produk', 'id_pengepul')
            ->withPivot('jumlah', 'tanggal')
            ->withTimestamps();;
    }

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id_petani');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorit', 'id_produk', 'id_pembeli');
    }
}
