<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleRequest;

class RoleRequestController extends Controller
{
    //

    public function showForm()
    {
        $user = auth()->user();

        // Cek apakah user sudah jadi developer
        if ($user->role === 'developer') {
            return redirect()->route('home')->with('error', 'Kamu sudah menjadi developer.');
        }

        // Cek apakah user sudah pernah mengirim request (dalam status apapun)
        $hasRequested = RoleRequest::where('user_id', $user->id)->exists();
        if ($hasRequested) {
            abort(403, 'Kamu sudah pernah mengirim permintaan request.');
        }

        // Kalau aman, tampilkan form
        return view('requestform');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $existing = RoleRequest::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'Kamu sudah mengajukan permintaan. Tunggu konfirmasi dari admin.');
        }

        RoleRequest::create([
            'user_id' => auth()->id(),
            'requested_role' => 'developer',
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan berhasil diajukan.');
    }

}
