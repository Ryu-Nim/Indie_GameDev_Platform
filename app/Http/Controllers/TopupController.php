<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopupController extends Controller
{
    // Menampilkan halaman topup
    public function index()
    {
        return view('topup.index');
    }

    // Menangani form submit topup
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'coin_package' => 'required|string',
        ]);

        // Proses topup disimpan ke log atau database (dummy logic)
        // Untuk sekarang hanya redirect kembali dengan pesan sukses

        return redirect()->route('topup.index')->with('success', 'Top up berhasil diproses!');
    }
}

