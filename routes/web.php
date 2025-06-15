<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\RoleRequestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route aplikasi Indie GameDev Platform.
| Komentar sudah ditambahkan untuk memperjelas fungsi masing-masing route.
|--------------------------------------------------------------------------
*/

// Halaman utama (welcome)
Route::get('/', [GameController::class, 'showHome'])->name('home'); // Route untuk halaman utama
Route::get('/game/{title}', [GameController::class, 'showGameDetail'])->name('game.detail'); // Detail game berdasarkan judul


// Halaman login (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login'); // Menampilkan form login

// Proses login (POST)
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process'); // Proses autentikasi login

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Menampilkan form registrasi
Route::post('/register', [AuthController::class, 'processRegister']); // Proses registrasi user
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout user


// Halaman upload game (GET) - hanya untuk user yang sudah login & developer
Route::get('/upload', function () {
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }

    if (Auth::user()->role !== 2) {
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses untuk mengupload game.');
    }

    return view('upload');
})->name('uploadPage'); // Menampilkan halaman upload game

// Proses upload game (POST) - hanya untuk user yang sudah login
Route::post('/upload', [GameController::class, 'uploadGame'])->name('uploadGame')->middleware('auth'); // Proses upload game

// Download game berdasarkan ID
Route::get('/download/{id}', [GameController::class, 'downloadGame'])->name('downloadGame'); // Download game

Route::get('/community', function () {
    return view('community.index');
})->name('community'); // Halaman komunitas
Route::get('/thread/{slug}', [ThreadController::class, 'show'])->name('thread.show'); // Detail thread komunitas

Route::get('/live-search', [GameController::class, 'liveSearch'])->name('liveSearch'); // Fitur live search game

Route::middleware(['auth'])->group(function () {
    Route::post('/bookmark', [BookmarkController::class, 'toggle'])->name('bookmark.toggle'); // Bookmark/unbookmark game
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index'); // Daftar bookmark user
});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('backend.admin.login'); // Form login admin
Route::post('/admin/login', [AdminAuthController::class, 'login']); // Proses login admin
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('backend.admin.logout'); // Logout admin

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('backend.admin.index'); // Dashboard admin
    Route::post('/admin/update-role/{id}', [AdminController::class, 'updateRole'])->name('backend.admin.updateRole'); // Update role user
    route::get('/admin/admin-list', [AdminController::class, 'adminpanel'])->name('backend.admin.paneladmin'); // Daftar admin
    route::get('/admin/user-list', [AdminController::class, 'userpanel'])->name('backend.admin.paneluser'); // Daftar user
    route::post('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('backend.admin.updateUser'); // Update data user
    route::get('/admin/game-list', [AdminController::class, 'gamepanel'])->name('backend.admin.gamepanel'); // Daftar game
    Route::post('/admin/update-game/{id}', [AdminController::class, 'updateGame'])->name('backend.admin.updateGame'); // Update data game
    Route::get('/role-requests', [AdminController::class, 'roleRequestPanel'])->name('backend.admin.role-requests');
    Route::patch('/role-requests/{id}/approve', [AdminController::class, 'approve'])->name('backend.admin.role-requests.approve');
    Route::patch('/role-requests/{id}/reject', [AdminController::class, 'reject'])->name('backend.admin.role-requests.reject');
});
Route::middleware('auth')->group(function () {
    Route::post('/request-role', [RoleRequestController::class, 'submit'])->name('requestform.submit');
    Route::get('/request-role', [RoleRequestController::class, 'showForm'])->name('requestform.form');
});

Route::get('/topup', [TopupController::class, 'index'])->name('topup.index'); // Halaman topup
Route::post('/topup', [TopupController::class, 'store'])->name('topup.store'); // Proses topup