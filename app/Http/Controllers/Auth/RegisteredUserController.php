<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'digits_between:10,15', 'regex:/^[0-9]+$/', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $fullName = trim((string) $request->input('name')) ?: trim($firstName.' '.$lastName);

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => $fullName,
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
