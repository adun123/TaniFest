<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // Kalau belum ada, buat baru
            if (! $user) {
                $nameParts = explode(' ', trim($googleUser->getName()), 2);

                $user = User::create([
                    'name' => $googleUser->getName(),
                    'first_name' => $nameParts[0] ?: 'Google',
                    'last_name' => $nameParts[1] ?? 'User',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'phone' => 'google-'.$googleUser->getId(),
                    'password' => Hash::make(Str::random(32)),
                    'role' => 'customer',
                ]);
            }

            Auth::login($user);

            return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'customer.dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google.');
        }
    }
}
