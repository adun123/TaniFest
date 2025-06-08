<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->harga;
        });

        return response()->json([
            'data' => $cartItems,
            'total' => $total
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->jumlah) {
            return response()->json(['message' => 'Jumlah melebihi stok'], 422);
        }

        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity
            ]);
            $cart = $existingCart;
        } else {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json([
            'message' => 'Item ditambahkan ke keranjang',
            'data' => $cart
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->jumlah
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return response()->json([
            'message' => 'Item keranjang diperbarui',
            'data' => $cart
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
