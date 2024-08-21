<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetaniLog extends Model
{
    use HasFactory;

    protected $fillable = ['id_pengepul', 'id_petani', 'action', 'changes'];

    public function pengepul()
    {
        return $this->belongsTo(User::class, 'id_pengepul');
    }

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani');
    }
}
