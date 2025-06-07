<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Melihat profil user login
    public function showSelf()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    // Memproses update profil user
    public function update(Request $request)
    {
        $messages = [
            'photo.image' => 'Format gambar harus berupa jpeg, jpg, png, atau gif.',
            'photo.max' => 'Ukuran file gambar maksimal adalah 2048 KB.'
        ];

        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:6',
        ], $messages);

        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('profiles');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
