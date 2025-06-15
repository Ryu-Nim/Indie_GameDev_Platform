<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.admin.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('login');
        $password = $request->input('password');

        // Deteksi apakah login berupa email atau username
        $loginType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba login dengan guard admin
        if (Auth::guard('admin')->attempt([$loginType => $loginInput, 'password' => $password])) {
            $request->session()->regenerate(); // Regenerasi session ID
            return redirect()->route('backend.admin.index');
        }

        // Gagal login
        return back()->withErrors([
            'login' => 'Login gagal! Cek kembali username/email dan password Anda.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('backend.admin.login')->with('success', 'Anda telah logout.');
    }
}
