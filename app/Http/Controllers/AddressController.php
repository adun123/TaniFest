<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'full_address' => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);

        Auth::user()->addresses()->create($request->only('recipient_name', 'phone', 'full_address', 'postal_code'));

        return redirect()->back()->with('success', 'Alamat berhasil ditambahkan.');
    }

    // Menghapus alamat
    public function destroy($id)
    {
        $address = Address::findOrFail($id);

        // Pastikan alamat milik user yang sedang login
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $address->delete();

        return redirect()->back()->with('success', 'Alamat berhasil dihapus.');
    }

    // Mengupdate alamat
    public function update(Request $request, $id)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'full_address' => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);

        $address = Address::findOrFail($id);

        // Cek otorisasi
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $address->update($request->only('recipient_name', 'phone', 'full_address', 'postal_code'));

        return redirect()->back()->with('success', 'Alamat berhasil diperbarui.');
    }

}

