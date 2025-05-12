<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function index()
    {
        $user = Auth::user(); // atau User::find($id) kalau pakai parameter
        return view('profile.index', compact('user'));
    }

    public function create()
    {
        return view('profile.index', [
            'judul' => 'Tambah User',
        ]);
    }
}
