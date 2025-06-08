<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    public function index()
    {
        return response()->json(Product::latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
            'category' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'variants' => 'nullable|string',
            'photos.*' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('products', 'public');
        }

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('products', 'public');
            }
            $validated['photos'] = $photos;
        }

        if ($request->variants) {
            $validated['variants'] = array_map('trim', explode(',', $request->variants));
        }

        $product = Product::create($validated);

        return response()->json(['message' => 'Produk berhasil dibuat', 'data' => $product], 201);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
            'category' => 'nullable|string',
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
            if (is_array($product->photos)) {
                foreach ($product->photos as $oldPhoto) {
                    Storage::disk('public')->delete($oldPhoto);
                }
            }

            $newPhotos = [];
            foreach ($request->file('photos') as $photo) {
                $newPhotos[] = $photo->store('products', 'public');
            }
            $validated['photos'] = $newPhotos;
        }

        if ($request->variants) {
            $validated['variants'] = array_map('trim', explode(',', $request->variants));
        }

        $product->update($validated);

        return response()->json(['message' => 'Produk berhasil diperbarui', 'data' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        if (is_array($product->photos)) {
            foreach ($product->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
