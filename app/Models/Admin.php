<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $table = 'admin';
    protected $guard = 'admin';

    function pengepul()
    {
        return $this->hasMany(Pengepul::class, 'id_admin', 'id_admin');
    }

    function petani()
    {
        return $this->hasMany(Petani::class, 'id_admin', 'id_admin');
    }
}
