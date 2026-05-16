<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::latest()->take(6)->get(); // ambil 6 resep terbaru

        return view('admin.reseps.index', compact('reseps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'bahan.*' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|url',
            'stok' => 'required|integer|min:1',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi', 'video', 'stok']);

        if ($request->video) {
            preg_match('/(?:youtu\.be\/|youtube\.com\/watch\?v=)([^\&\?]+)/', $request->video, $matches);
            $data['video'] = $matches[1] ?? $request->video;
        }

        $data['bahan'] = implode("\n", $request->input('bahan', []));

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('reseps', 'public');
        }

        $resep = Resep::create($data);

        foreach ($request->bahan as $item) {
            $resep->bahans()->create(['nama' => $item]);
        }

        return redirect()->route('admin.reseps.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    public function update(Request $request, Resep $resep)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'bahan' => 'nullable|array',
            'bahan.*' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|url',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi', 'video']);

        if ($request->filled('bahan')) {
            $data['bahan'] = implode("\n", $request->input('bahan'));
        }

        if ($request->hasFile('foto')) {
            if ($resep->foto) {
                Storage::disk('public')->delete($resep->foto);
            }
            $data['foto'] = $request->file('foto')->store('reseps', 'public');
        }

        $resep->update($data);

        if ($request->filled('bahan')) {
            $resep->bahans()->delete();
            foreach ($request->input('bahan') as $item) {
                $resep->bahans()->create(['nama' => $item]);
            }
        }

        return redirect()->route('admin.reseps.index')->with('success', 'Resep berhasil diperbarui!');
    }

    public function destroy(Resep $resep)
    {
        if ($resep->foto) {
            Storage::disk('public')->delete($resep->foto);
        }

        $resep->delete();

        return redirect()->route('admin.reseps.index')->with('success', 'Resep berhasil dihapus!');
    }

    public function show($id)
    {
        $resep = Resep::findOrFail($id);

        return view('customer.Resep.resep-detail', compact('resep'));
    }
}
