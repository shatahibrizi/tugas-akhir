<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'luas_lahan',
        'lokasi_lahan',
        'foto',
        'grup_petani',
    ];

    function product()
    {
        return $this->hasMany(Product::class, 'id_petani', 'id_petani');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
