<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_pengepul';
    protected $attributes = [
        'id_admin' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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


    public function updateProfile($data)
    {
        return $this->fill($data)->save();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'tambah_produk', 'id_pengepul', 'id_produk');
    }

    // public function isAdmin()
    // {
    //     return false; // Atau logika lain yang menentukan apakah pengguna adalah admin
    // }
}
