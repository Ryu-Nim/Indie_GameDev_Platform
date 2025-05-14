<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function processLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        // Coba login dengan email atau username
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Batasi percobaan login untuk keamanan
        if (RateLimiter::tooManyAttempts('login:' . $request->ip(), 5)) {
            return back()->withErrors(['login' => 'Terlalu banyak percobaan login, coba lagi nanti.']);
        }
        RateLimiter::hit('login:' . $request->ip(), 60);

        // Proses login dengan opsi Remember Me
        $remember = $request->has('remember');
        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']], $remember)) {
            return redirect()->intended('/upload')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login' => 'Username atau email, serta password salah'])->with('error', 'Login gagal!');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}