<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/community', function () {
    return view('community.index');
});

use App\Http\Controllers\ThreadController;

Route::get('/thread/{slug}', [ThreadController::class, 'show'])->name('thread.show');


