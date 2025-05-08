<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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

}
