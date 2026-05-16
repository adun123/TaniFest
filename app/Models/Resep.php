<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto',
        'video',
        'harga',
        'stok',
        'bahan',

    ];

    public function bahans()
    {
        return $this->hasMany(Bahan::class);
    }
}
