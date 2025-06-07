<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TopupController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');

// Menampilkan profil user
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UsersController::class, 'showSelf'])->name('profile');
    Route::get('/profile/edit', [UsersController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UsersController::class, 'update'])->name('profile.update');
});

// Rute untuk Top Up
Route::get('/topup', [TopupController::class, 'index'])->name('topup.index');
Route::post('/topup', [TopupController::class, 'store'])->name('topup.store');

Route::get('/upload', function () {
    return view('upload');
})->name('uploadPage');

Route::get('/upload', function () {
    return view('upload');
})->middleware('developer');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

Route::post('/upload', [GameController::class, 'uploadGame'])->name('uploadGame')->middleware('auth');
Route::get('/download/{id}', [GameController::class, 'downloadGame'])->name('downloadGame');