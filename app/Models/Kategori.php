<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = [
        'nama',
    ];

    function products()
    {
        return $this->hasMany(Product::class, 'id_kategori', 'id_kategori');
    }
}
