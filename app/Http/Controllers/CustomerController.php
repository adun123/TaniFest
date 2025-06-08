<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Resep;

use App\Models\CategoryBanner;
class CustomerController extends Controller
{
    //
    public function productlist(Request $request)
{
    $kategori = $request->query('kategori');

    if ($kategori && $kategori !== 'semua') {
        $products = Product::where('category', $kategori)->get();
    } else {
        $products = Product::all();
    }

    return view('customer.category.product-list', compact('products'));
}




public function dashboard(Request $request)
{

    $discountedProducts = Product::where('discount_percentage', '>', 0)->take(6)->get();
    $kategori = $request->query('kategori');
    $categories = CategoryBanner::all();

    if ($kategori && $kategori !== 'semua') {
        $products = Product::where('category', $kategori)->get();
    } else {
        $products = Product::all();
    }
    $reseps = Resep::latest()->take(6)->get(); // Ambil 6 resep terbaru
    return view('customer.dashboard', compact('reseps','discountedProducts', 'products','categories', 'kategori'));
}

public function reseps()
{
    $reseps = Resep::latest()->get(); // Ambil semua resep, bisa kamu paginasi jika perlu
    return view('customer.Resep.reseps', compact('reseps'));
}

public function cart(){
    return view('customer.cart',compact('cart'));
}

   public function show($id)
    {
    $resep = Resep::with('bahans')->findOrFail($id);
        
        return view('customer.Resep.resep-detail', compact('resep'));
    }

    public function semuakategori()
    {
        $products = Product::all();
        $categories = CategoryBanner::all();
        return view('customer.Category.category', compact('products', 'categories'));
    }

    public function search(Request $request)
{
    $q = $request->input('q');

    // Cari produk dan resep yang cocok
    $products = Product::where('nama', 'like', "%$q%")
        ->orWhere('category', 'like', "%$q%")
        ->get();

    $reseps = Resep::where('nama', 'like', "%$q%")
        ->orWhere('deskripsi', 'like', "%$q%")
        ->get();

    return view('customer.result', compact('products', 'reseps', 'q'));
}


}
