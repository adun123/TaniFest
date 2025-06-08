<?php

namespace App\Http\Controllers;

use App\Models\CategoryBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryBannerController extends Controller
{
    public function index()
    {
        $categories = CategoryBanner::all();
        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        CategoryBanner::create([
            'title' => $request->title,
            'image_url' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, CategoryBanner $categoryBanner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($categoryBanner->image_url && Storage::disk('public')->exists($categoryBanner->image_url)) {
                Storage::disk('public')->delete($categoryBanner->image_url);
            }

            $imagePath = $request->file('image')->store('uploads', 'public');
            $categoryBanner->image_url = $imagePath;
        }

        $categoryBanner->title = $request->title;
        $categoryBanner->save();

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(CategoryBanner $categoryBanner)
    {
        if ($categoryBanner->image_url && Storage::disk('public')->exists($categoryBanner->image_url)) {
            Storage::disk('public')->delete($categoryBanner->image_url);
        }

        $categoryBanner->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
