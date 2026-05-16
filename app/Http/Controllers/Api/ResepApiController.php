<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepApiController extends Controller
{
    public function index()
    {
        return response()->json(Resep::latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'bahan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|url',
            'stok' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('reseps', 'public');
        }

        $resep = Resep::create($validated);

        return response()->json(['message' => 'Resep berhasil dibuat', 'data' => $resep], 201);
    }

    public function show($id)
    {
        $resep = Resep::findOrFail($id);

        return response()->json($resep);
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'bahan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|url',
        ]);

        if ($request->hasFile('foto')) {
            if ($resep->foto) {
                Storage::disk('public')->delete($resep->foto);
            }
            $validated['foto'] = $request->file('foto')->store('reseps', 'public');
        }

        $resep->update($validated);

        return response()->json(['message' => 'Resep berhasil diperbarui', 'data' => $resep]);
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        if ($resep->foto) {
            Storage::disk('public')->delete($resep->foto);
        }
        $resep->delete();

        return response()->json(['message' => 'Resep berhasil dihapus']);
    }
}
