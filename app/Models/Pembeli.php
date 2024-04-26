<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';
    protected $fillable = [
        'nama',
        'email',
        'username',
        'alamat',
        'password',
        'foto_profil',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'pesanan', 'id_pembeli', 'id_produk');
    }
}
