<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route aplikasi Indie GameDev Platform.
| Komentar sudah ditambahkan untuk memperjelas fungsi masing-masing route.
|--------------------------------------------------------------------------
*/

// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Halaman login (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);

// Halaman upload game (GET) - hanya untuk developer
Route::get('/upload', function () {
    return view('upload');
})->name('uploadPage')->middleware('developer');

// Proses upload game (POST) - hanya untuk user yang sudah login
Route::post('/upload', [GameController::class, 'uploadGame'])->name('uploadGame')->middleware('auth');

// Download game berdasarkan ID
Route::get('/download/{id}', [GameController::class, 'downloadGame'])->name('downloadGame');