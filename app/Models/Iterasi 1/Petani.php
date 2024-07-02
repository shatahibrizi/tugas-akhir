<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory;

    protected $table = 'petani';
    protected $primaryKey = 'id_petani';
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'luas_lahan',
        'lokasi_lahan',
        'foto',
        'grup_petani',
    ];

    protected $attributes = [
        'id_admin' => 1, // Memberikan nilai default 'active' pada kolom "status"
    ];

    function products()
    {
        return $this->hasMany(Product::class, 'id_petani', 'id_petani');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
