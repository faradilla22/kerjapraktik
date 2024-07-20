<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('item.index');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:penggunas',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $pengguna = Pengguna::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($pengguna);

        return redirect()->intended('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
