<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cartItems = Cart::with(['product', 'resep'])->where('user_id', $user->id)->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * ($item->product?->harga ?? $item->resep?->harga ?? 0);
        });

        return response()->json([
            'data' => $cartItems,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required_without:resep_id|nullable|exists:products,id',
            'resep_id' => 'required_without:product_id|nullable|exists:reseps,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->filled('product_id') && $request->filled('resep_id')) {
            return response()->json(['message' => 'Pilih produk atau resep, bukan keduanya'], 422);
        }

        $product = $request->filled('product_id') ? Product::findOrFail($request->product_id) : null;
        $resep = $request->filled('resep_id') ? Resep::findOrFail($request->resep_id) : null;
        $stock = $product?->jumlah ?? $resep?->stok;

        if ($stock !== null && $request->quantity > $stock) {
            return response()->json(['message' => 'Jumlah melebihi stok'], 422);
        }

        $existingCart = Cart::where('user_id', Auth::id())
            ->when($product, fn ($query) => $query->where('product_id', $product->id))
            ->when($resep, fn ($query) => $query->where('resep_id', $resep->id))
            ->first();

        if ($existingCart) {
            $newQuantity = $existingCart->quantity + $request->quantity;

            if ($stock !== null && $newQuantity > $stock) {
                return response()->json(['message' => 'Jumlah melebihi stok'], 422);
            }

            $existingCart->update([
                'quantity' => $newQuantity,
            ]);
            $cart = $existingCart;
        } else {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product?->id,
                'resep_id' => $resep?->id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json([
            'message' => 'Item ditambahkan ke keranjang',
            'data' => $cart,
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $maxQuantity = $cart->product?->jumlah ?? $cart->resep?->stok;
        $quantityRules = ['required', 'integer', 'min:1'];

        if ($maxQuantity !== null) {
            $quantityRules[] = 'max:'.$maxQuantity;
        }

        $request->validate(['quantity' => $quantityRules]);

        $cart->update(['quantity' => $request->quantity]);

        return response()->json([
            'message' => 'Item keranjang diperbarui',
            'data' => $cart,
        ]);
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cart->delete();

        return response()->json(['message' => 'Item dihapus dari keranjang']);
    }
}
