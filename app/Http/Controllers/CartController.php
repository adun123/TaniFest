<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resep;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with(['product', 'resep']) // ← Tambahkan 'resep'
                        ->get();

        // Filter item yang valid (product atau resep tidak null)
        $cartItems = $cartItems->filter(function($item) {
            return $item->product !== null || $item->resep !== null;
        });

        $total = $cartItems->sum(function ($item) {
            if ($item->product) {
                return $item->quantity * $item->product->harga;
            } elseif ($item->resep) {
                return $item->quantity * $item->resep->harga; // pastikan ada kolom harga di tabel resep
            }
            return 0;
        });

        return view('customer.cart', compact('cartItems', 'total'));
    }



    public function store(Product $product, Request $request)
    {
        // Validasi input quantity dan catatan jika ada
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->jumlah,
            'note' => 'nullable|string|max:255'
        ]);

        $userId = Auth::id();

        // Cek apakah produk sudah ada di keranjang user ini (dengan variant juga jika perlu)
        $existingCart = Cart::where('user_id', $userId)
                            ->where('product_id', $product->id)
                            ->first();

        if ($existingCart) {
            // Update quantity (jumlah + yang baru), pastikan tidak melebihi stok produk
            $newQty = $existingCart->quantity + $request->quantity;
            if ($newQty > $product->jumlah) {
                return redirect()->back()->withErrors(['quantity' => 'Jumlah melebihi stok tersedia.']);
            }
            $existingCart->update([
                'quantity' => $newQty,
                'note' => $request->note,
            ]);
        } else {
            // Buat data keranjang baru
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'note' => $request->note,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }


    public function update(Request $request, Cart $cartItem)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:' . $cartItem->product->jumlah
        ]);

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui');
    }

    public function destroy(Cart $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang');
    }

    public function storeResep(Resep $resep, Request $request)
{
    $request->validate([
        'quantity' => 'required|numeric|min:1'
    ]);

    $existingCart = Cart::where('user_id', Auth::id())
                        ->where('resep_id', $resep->id)
                        ->first();

    if ($existingCart) {
        $existingCart->update([
            'quantity' => $existingCart->quantity + $request->quantity
        ]);
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'resep_id' => $resep->id,
            'quantity' => $request->quantity
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Resep ditambahkan ke keranjang');
}

}