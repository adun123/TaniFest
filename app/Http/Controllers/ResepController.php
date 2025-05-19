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
            'bahan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|url',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi', 'bahan', 'video']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('reseps', 'public');
        }

        Resep::create($data);

        return redirect()->route('reseps.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    public function update(Request $request, Resep $resep)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'bahan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|url',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi', 'bahan', 'video']);

        if ($request->hasFile('foto')) {
            if ($resep->foto) {
                Storage::disk('public')->delete($resep->foto);
            }
            $data['foto'] = $request->file('foto')->store('reseps', 'public');
        }

        $resep->update($data);

        return redirect()->route('reseps.index')->with('success', 'Resep berhasil diperbarui!');
    }

    public function destroy(Resep $resep)
    {
        if ($resep->foto) {
            Storage::disk('public')->delete($resep->foto);
        }

        $resep->delete();

        return redirect()->route('reseps.index')->with('success', 'Resep berhasil dihapus!');
    }
    public function show($id)
{
    $resep = Resep::findOrFail($id);
    
    return view('customer.Resep.resep-detail', compact('resep'));
}

}
