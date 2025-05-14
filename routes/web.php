<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
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