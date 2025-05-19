<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Resep;


class CustomerController extends Controller
{
    //
    public function category(Request $request)
{
    $kategori = $request->query('kategori');

    if ($kategori && $kategori !== 'semua') {
        $products = Product::where('category', $kategori)->get();
    } else {
        $products = Product::all();
    }

    return view('customer.category.category', compact('products'));
}


public function dashboard()
{
    $reseps = Resep::latest()->take(6)->get(); // Ambil 6 resep terbaru
    return view('customer.dashboard', compact('reseps'));
}

public function reseps()
{
    $reseps = Resep::latest()->get(); // Ambil semua resep, bisa kamu paginasi jika perlu
    return view('customer.resep.reseps', compact('reseps'));
}

public function cart(){
    return view('customer.cart',compact('cart'));
}


}
