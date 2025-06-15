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

        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (RateLimiter::tooManyAttempts('login:' . $request->ip(), 5)) {
            return back()->withErrors(['login' => 'Terlalu banyak percobaan login, coba lagi nanti.']);
        }
        RateLimiter::hit('login:' . $request->ip(), 60);

        $remember = $request->has('remember');
        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']], $remember)) {
            // Set status user menjadi aktif (1) setelah login
            $user = Auth::user();
            if ($user->status == 2) {
                $user->status = 1;
                $user->save();
            }
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login' => 'Username atau email, serta password salah'])->with('error', 'Login gagal!');
    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Pastikan ada register.blade.php di resources/views/auth/
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 1, // Default sebagai User
            'status' => 2, // nonaktifkan akun secara default
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login dengan akun baru.');
    }

    public function logout(Request $request)
    {
        // Set status user menjadi tidak aktif (2) sebelum logout
        $user = Auth::user();
        if ($user) {
            $user->status = 2;
            $user->save();
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}