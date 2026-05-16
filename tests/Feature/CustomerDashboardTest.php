<?php

use App\Models\Product;
use App\Models\User;

it('renders customer dashboard products with array variants', function () {
    $user = User::factory()->create(['role' => 'customer']);

    Product::create([
        'nama' => 'Paket Sayur',
        'jumlah' => 10,
        'harga' => 25000,
        'discount_percentage' => 10,
        'category' => 'Sayuran Hijau',
        'variants' => ['400gr', '800gr'],
    ]);

    $this->actingAs($user)
        ->get(route('customer.dashboard'))
        ->assertOk()
        ->assertSee('400gr, 800gr');
});
