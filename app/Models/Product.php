<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['nama', 'jumlah', 'harga','category', 'photo','description', 'variants', 'photos'
];

protected $casts = [
    'variants' => 'array',
    'photos' => 'array',
];

    public function carts()
{
    return $this->hasMany(Cart::class);
}

}
