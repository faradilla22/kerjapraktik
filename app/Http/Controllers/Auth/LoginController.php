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

        $user = Pengguna::where('username', $credentials['username'])
                        ->where('password', $credentials['password'])
                        ->first();

        if ($user) {
        Auth::login($user);
        return redirect()->intended('bobots');
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