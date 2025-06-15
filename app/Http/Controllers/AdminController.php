<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Game;
use Carbon\Carbon;
use App\Models\RoleRequest;


class AdminController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::count(); // Total pengguna dalam database
        $activeUsers = User::where('status', 1)->count(); // Hanya user yang berstatus aktif
        $totalGames = Game::count(); // Total game dalam database
        // Ambil game yang dibuat dalam 1 hari terakhir
        $todayGames = Game::whereDate('created_at', Carbon::today())->get();


        return view('backend.admin.index', compact('totalUsers', 'activeUsers', 'totalGames', 'todayGames'));
    }

    public function adminpanel()
    {
        $admins = Admin::all();
        return view('backend.admin.paneladmin', compact('admins'));
    }

    public function userpanel()
    {
        $users = User::all();
        return view('backend.admin.paneluser', compact('users'));
    }

    public function gamepanel()
    {
        $games = Game::with('user')->get();
        $games = Game::all();
        return view('backend.admin.gamepanel', compact('games'));
    }

    public function roleRequestPanel()
    {
        $roleRequests = RoleRequest::with('user')->get();
        return view('backend.admin.role-requests', compact('roleRequests'));
    }

    public function create(Request $request)
    {
        $admin = Admin::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role, // 1 = Super Admin, 2 = Admin Biasa
        ]);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan!');
    }

    public function updateRole(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->role = $request->role; // Ubah role
        $admin->save();

        return redirect()->back()->with('success', 'Role admin berhasil diubah!');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role; // Ubah role user 
        $user->status = $request->status; // Aktif atau tidak
        $user->save();

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }

    public function updateGame(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->status = $request->status; // Aktif atau tidak
        $game->save();

        return redirect()->back()->with('success', 'Game berhasil diperbarui!');
    }

    public function approve($id)
    {
        $request = RoleRequest::findOrFail($id);
        $request->update(['status' => 'approved']);

        // Ubah role user menjadi developer (2)
        $request->user->update(['role' => 2]);

        return back()->with('success', 'Role berhasil disetujui.');
    }

    public function reject($id)
    {
        $request = RoleRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Role berhasil ditolak.');
    }

    public function delete($id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Admin berhasil dihapus!');
    }

}
