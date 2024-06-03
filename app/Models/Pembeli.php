<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pembeli extends Authenticatable
{
    use HasFactory;
    protected $primaryKey = 'id_pembeli';
    protected $table = 'pembeli';
    protected $guard = 'pembeli';

    protected $fillable = [
        'nama',
        'email',
        'username',
        'alamat',
        'password',
        'foto_profil',
        'no_hp'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_pembeli', 'id_pembeli');
    }
}
