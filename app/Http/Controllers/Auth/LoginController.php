<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('username', 'password');

        // Retrieve the user based on username
        $pengguna = Pengguna::where('username', $credentials['username'])->first();
    
        if ($pengguna && $pengguna->password === $credentials['password']) {
            // Password matches, proceed with login
            if ($pengguna->approved) {
                Auth::login($pengguna);
                return redirect()->intended('bobots');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akun belum disetujui.');
            }
        }

        //check encrypted password
        //     if (Auth::attempt($credentials)) {
        //     return redirect()->intended('bobots');
        // }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}