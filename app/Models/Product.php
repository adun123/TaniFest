<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'jumlah',
        'harga',
        'discount_percentage',
        'category',
        'photo',
        'description',
        'variants',
        'photos',
    ];

    protected $casts = [
        'variants' => 'array',
        'photos' => 'array',
        'discount_percentage' => 'integer',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function variantLabel(): string
    {
        $variants = $this->variants ?? [];

        return $variants === [] ? '1 pack' : implode(', ', $variants);
    }

    public function variantOptions(): array
    {
        return $this->variants ?? [];
    }

    public function photoGallery(): array
    {
        return $this->photos ?? [];
    }
}
