<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Melihat profil user
    public function show($id)
    {
        $user = User::findOrFail($id);
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
        // Pesan error custom
        $messages = [
            'photo.image' => 'Format gambar harus berupa jpeg, jpg, png, atau gif.',
            'photo.max' => 'Ukuran file gambar maksimal adalah 2048 KB.'
        ];

        // Validasi dengan pesan error custom
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:6', // Password tidak wajib diisi
        ], $messages);

        // Update data user
        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('profiles');
        }

        // Jika user memasukkan password baru, lakukan hashing sebelum menyimpan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile', $user->id)->with('success', 'Profil berhasil diperbarui!');
    }
}