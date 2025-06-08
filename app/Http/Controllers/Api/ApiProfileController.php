<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ApiProfileController extends Controller
{
    // GET /api/profile
    public function show(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => 'Profile fetched successfully',
            'data' => $request->user()
        ]);
    }

    // PUT /api/profile
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'        => 'nullable|string|max:255',
            'first_name'  => 'nullable|string|max:255',
            'last_name'   => 'nullable|string|max:255',
            'birth_date'  => 'nullable|date',
            'email'       => 'nullable|email|unique:users,email,' . $user->id,
            'phone'       => 'nullable|string|max:20',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');
            $validated['photo'] = $path;
        }

        if (isset($validated['email']) && $validated['email'] !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->fill($validated);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    // DELETE /api/profile
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required']
        ]);

        $user = $request->user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Password salah'], 403);
        }

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return response()->json(['message' => 'Akun berhasil dihapus']);
    }
}
