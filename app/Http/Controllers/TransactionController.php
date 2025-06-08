<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
 use App\Models\TransactionItem; // 
class TransactionController extends Controller
{


    // menampolkan data dari keranjang ke halakan checkout
    public function checkout(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array',
            'cart_ids.*' => 'exists:carts,id'
        ]);

        $cartItems = Cart::whereIn('id', $request->cart_ids)
            ->where('user_id', Auth::id())
            ->with(['product', 'resep'])
            ->get();

        $shippingCost = 6000;

        foreach ($cartItems as $cart) {
            if (!$cart->product && !$cart->resep) {
                dd("Item dengan ID {$cart->id} tidak ditemukan (baik product maupun resep).");
            }
        }


        $validCartItems = $cartItems->filter(function ($cart) {
            return $cart->product !== null;
        });

        $totalProductPrice = $cartItems->sum(function ($cart) {
            if ($cart->product) {
                return $cart->product->harga * $cart->quantity;
            } elseif ($cart->resep) {
                return $cart->resep->harga * $cart->quantity;
            }
            return 0;
        });


        
        
        $totalPrice = $totalProductPrice + $shippingCost;
        

        $paymentMethods = [
        ['value' => 'cod', 'label' => 'COD'],
        ['value' => 'transfer_bank', 'label' => 'Transfer Bank'],
        ['value' => 'qris', 'label' => 'Qris'],
        ['value' => 'dana', 'label' => 'Dana'],
        ['value' => 'gopay', 'label' => 'Gopay'],
            ];
                $banks = [
        ['name' => 'Bank BCA', 'logo' => 'bca.jpg'],
        ['name' => 'Bank BRI', 'logo' => 'bri.jpg'],
        ['name' => 'Bank Mandiri', 'logo' => 'mandiri.jpg'],
        ['name' => 'Bank BNI', 'logo' => 'bni.jpg'],
        ['name' => 'Bank Syariah Indonesia (BSI)', 'logo' => 'bsi.jpg'],
        ['name' => 'SeaBank', 'logo' => 'seabank.jpg'],
    ];

        $selectedAddress = Address::where('user_id', Auth::id())->first();
        if (!$selectedAddress) {
    return redirect()->route('profile.edit')->with('error', 'Silakan lengkapi alamat terlebih dahulu.');
}

        return view('customer.checkout', [
            'cartItems' => $cartItems,
            'shippingCost' => $shippingCost,
            'totalPrice' => $totalPrice,
            'selectedAddress' => $selectedAddress,
            'paymentMethods' => $paymentMethods,
            'banks' => $banks,
        ]);
    }




    
public function store(Request $request)
{
    $request->validate([
        'address_id' => 'required|exists:addresses,id',
        'delivery_day' => 'required|date',
        'delivery_time' => 'required',
        'payment_method' => 'required',
        'bank_option' => 'required_if:payment_method,transfer_bank',
    ]);
    // dd('VALIDASI LULUS');

    $carts = Cart::with(['product', 'resep'])
                ->where('user_id', Auth::id())
                ->get()
                ->filter(function($cart) {
                    // Hanya ambil cart yang valid
                    return !is_null($cart->product_id) || !is_null($cart->resep_id);
                });

    if ($carts->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang tidak valid atau kosong.');
    }

    // Ambil keranjang dengan relasi produk dan resep
    $carts = Cart::with(['product', 'resep'])
                ->where('user_id', Auth::id())
                ->get();

    if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong.');
        }
        if (!$request->address_id) {
        return redirect()->back()->with('error', 'Alamat pengiriman tidak ditemukan.');
    }


    // Hitung total dari semua item: product dan resep
    $totalProductPrice = $carts->sum(function ($cart) {
        if ($cart->product) {
            return $cart->product->harga * $cart->quantity;
        } elseif ($cart->resep) {
            return $cart->resep->harga * $cart->quantity;
        }
        return 0;
    });

    $shippingCost = 3000;
    $totalPrice = $totalProductPrice + $shippingCost;

    try {
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'address_id' => $request->address_id,
            'delivery_day' => $request->delivery_day,
            'delivery_time' => $request->delivery_time,
            'shipping_method' => 'default',
            'payment_method' => $request->payment_method,
            'shipping_cost' => $shippingCost,
            'total_price' => $totalPrice,
            'virtual_account' => 'VA-' . strtoupper(Str::random(10)),
            'bank_option' => $request->bank_option ?? null,
            'status' => 'on Process',
        ]);

        foreach ($carts as $cart) {
            $price = 0;

            if ($cart->product) {
                $price = $cart->product->harga;
            } elseif ($cart->resep) {
                $price = $cart->resep->harga;
            } else {
                // Tidak valid, skip saja item ini
                continue;
            }
              logger('Transaksi berhasil dibuat:', ['id' => $transaction->id]);
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'resep_id' => $cart->resep_id,
                'quantity' => $cart->quantity,
                 'price' => $cart->product ? $cart->product->harga : $cart->resep->harga,
            ]);
            

        }

        if ($carts->contains(function ($cart) {
            return is_null($cart->product) && is_null($cart->resep);
        })) {
            return redirect()->back()->with('error', 'Terdapat item tidak valid di keranjang.');
        }



        Cart::where('user_id', Auth::id())->delete();
        
        return redirect()->route('checkout.success', $transaction->id);

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

public function history()
{
    $transactions = Transaction::with(['address', 'items.product'])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
        

    return view('customer.pesanan', compact('transactions'));
}

public function success(Request $request, $id)
{
    $status = $request->get('status');

    $query = Transaction::with(['items.product', 'items.resep'])
        ->where('user_id', Auth::id());

    $allowedStatus = ['dikemas', 'dikirim', 'selesai', 'pembatalan', 'pengembalian'];

    if ($status && $status !== 'semua' && in_array($status, $allowedStatus)) {
        $query->where('status', $status);
    }

    $transactions = $query->latest()->get();

    $transaction = Transaction::with(['items.product', 'items.resep']) // pastikan ini juga include resep
        ->where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('customer.success', compact('transaction', 'transactions'));
}

};