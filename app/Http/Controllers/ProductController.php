<?php

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

        return view('customer.product-detail', compact('product', 'relatedProducts'));
    }

    public function index()
    {
        $products = Product::latest()->get();

        return view('dashboard', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
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
            $validated['photos'] = $photos;
        }

        if ($request->filled('variants')) {
            $validated['variants'] = collect(explode(',', $request->input('variants')))
                ->map(fn ($variant) => trim($variant))
                ->filter()
                ->values()
                ->all();
        }

        $validated['discount_percentage'] = $validated['discount_percentage'] ?? 0;

        Product::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'category' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'variants' => 'nullable|string',
            'photos.*' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $validated['photo'] = $request->file('photo')->store('products', 'public');
        }

        if ($request->hasFile('photos')) {
            foreach ($product->photos ?? [] as $photo) {
                Storage::disk('public')->delete($photo);
            }

            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('products', 'public');
            }
            $validated['photos'] = $photos;
        }

        if ($request->filled('variants')) {
            $validated['variants'] = collect(explode(',', $request->input('variants')))
                ->map(fn ($variant) => trim($variant))
                ->filter()
                ->values()
                ->all();
        } else {
            $validated['variants'] = null;
        }

        $validated['discount_percentage'] = $validated['discount_percentage'] ?? 0;

        $product->update($validated);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        foreach ($product->photos ?? [] as $photo) {
            Storage::disk('public')->delete($photo);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
