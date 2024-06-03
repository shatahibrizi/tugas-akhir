<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = ['id_pembeli', 'status', 'metode_pembayaran', 'total_harga', 'tanggal_pesanan'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'item_pesanan', 'id_pesanan', 'id_produk')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli', 'id_pembeli');
    }
}
