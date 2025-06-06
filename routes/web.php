<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route aplikasi Indie GameDev Platform.
| Komentar sudah ditambahkan untuk memperjelas fungsi masing-masing route.
|--------------------------------------------------------------------------
*/

// Halaman utama (welcome)
Route::get('/', [GameController::class, 'showHome'])->name('home');
Route::get('/game/{title}', [GameController::class, 'showGameDetail'])->name('game.detail');


// Halaman login (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Halaman upload game (GET) - hanya untuk user yang sudah login & developer
Route::get('/upload', function () {
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }

    if (Auth::user()->role !== 2) {
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses untuk mengupload game.');
    }

    return view('upload');
})->name('uploadPage');

// Proses upload game (POST) - hanya untuk user yang sudah login
Route::post('/upload', [GameController::class, 'uploadGame'])->name('uploadGame')->middleware('auth');

// Download game berdasarkan ID
Route::get('/download/{id}', [GameController::class, 'downloadGame'])->name('downloadGame');

Route::get('/community', function () {
    return view('community.index');
})->name('community');
Route::get('/thread/{slug}', [ThreadController::class, 'show'])->name('thread.show');

Route::get('/live-search', [GameController::class, 'liveSearch'])->name('liveSearch');

Route::middleware(['auth'])->group(function () {
    Route::post('/bookmark', [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
});
