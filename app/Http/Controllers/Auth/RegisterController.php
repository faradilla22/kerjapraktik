<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:penggunas',
            'password' => 'required|min:3|confirmed',
            'status' => 'required|in:engineer,engineer koordinator',
        ]);

        $pengguna = Pengguna::create([
            'username' => $request->username,
            'password' => $request->password,
            'status' => $request->status,
        ]);

        Auth::login($pengguna);

        return redirect()->intended('bobots');
    }
}
