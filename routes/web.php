<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\CekEngineer;
use App\Http\Middleware\CekKoordinator;
use App\Http\Middleware\CekAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/bobots', \App\Http\Controllers\BobotController::class);

Route::post('/items/{id}/update', [newController::class, 'update']);
Route::post('/items/store', [newController::class, 'store']);

Route::get('/items/pabrik/{id_pabrik}/bagian/{id_bagian}', [newController::class, 'showItems']);
Route::get('/update-values', [newController::class, 'updateValues'])->name('update-values');

Route::get('/summary', [newController::class, 'index_summary'])->name('summary.index');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'cekAdmin'])->group(function () {
    Route::get('admin/penggunas', [AdminController::class, 'index'])->name('admin.penggunas');
    Route::post('admin/penggunas/{pengguna}', [AdminController::class, 'approve'])->name('admin.penggunas.approve');
});

Route::middleware(['auth', 'cekEngineer:P1B'])->group(function () {
    Route::get('/item2', [newController::class, 'index_item2'])->name('item2.index');
    Route::get('/update-values2', [newController::class, 'updateValues2'])->name('update-values2');    
});

Route::middleware(['auth', 'cekKoordinator'])->group(function () {
    Route::get('/item', [newController::class, 'index_item'])->name('item');
});

// Common page for all users
// Route::get('/bobots', function () {
//     return view('bobots.index');
// })->middleware('auth');

// Route::get('/', function () {
//     return '';
// })->middleware('role:engineer');

// Route::get('/engineer koordinator/', function () {
//     return '';
// })->middleware('role:engineer koordinator');