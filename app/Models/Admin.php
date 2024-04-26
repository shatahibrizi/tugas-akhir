<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';

    function pengepul()
    {
        return $this->hasMany(Pengepul::class, 'id_admin', 'id_admin');
    }

    function petani()
    {
        return $this->hasMany(Petani::class, 'id_admin', 'id_admin');
    }
}
