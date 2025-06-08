<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function show(Product $product)
{
    // Ambil produk terkait berdasarkan kategori
    $relatedProducts = Product::where('category', $product->category)
    ->where('id', '!=', $product->id)
    ->take(2)
    ->get();
    return view('customer.product-detail', compact('product','relatedProducts'));
}

    public function index()
    {
        $products = Product::latest()->get();
        return view('dashboard', compact('products'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required',
        'jumlah' => 'required|integer',
        'harga' => 'required|integer',
        'discount_percentage' => 'nullable|integer|min:0|max:100',
        'category' => 'required|string|max:255',
        'photo' => 'nullable|image|max:2048',
        'description' => 'nullable|string',
        'variants' => 'nullable|string',
        'photos.*' => 'nullable|image|max:2048',
    ]);

    // Simpan foto utama
    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('products', 'public');
    }

    // Simpan foto tambahan
    if ($request->hasFile('photos')) {
        $photos = [];
        foreach ($request->file('photos') as $photo) {
            $photos[] = $photo->store('products', 'public');
        }
        $validated['photos'] = json_encode($photos);
    }

    // Simpan variants sebagai array
    

    Product::create($validated); // ✅ Pakai data hasil validasi yang sudah dimodifikasi
    return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
}



    public function edit(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'nama' => 'required',
        'jumlah' => 'required|integer',
        'harga' => 'required|integer',
        'discount_percentage' => 'nullable|integer|min:0|max:100',
        'category' => 'required',
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }
        $validated['photo'] = $request->file('photo')->store('products', 'public');
    }

    $product->update($validated); // ✅ jangan pakai $request->all()
    return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
}


    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
