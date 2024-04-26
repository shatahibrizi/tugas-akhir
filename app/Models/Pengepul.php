<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengepul extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'nama',
        'email',
        'username',
        'alamat',
        'password',
        'no_hp',
        'no_rek',
        'foto_profil',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'tambah_produk', 'id_pengepul', 'id_produk');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
