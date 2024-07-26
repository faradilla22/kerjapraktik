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

Route::get('/items/pabrik/{id_pabrik}/bagian/{id_bagian}', [newController::class, 'showItems']);

Route::get('/summary', [newController::class, 'index_summary'])->name('summary.index');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::post('/items/{id}/update', [newController::class, 'update']);
Route::get('/update-values3', [newController::class, 'updateValues3'])->name('update-values3');

Route::get('/update-values4', [newController::class, 'updateValues4'])->name('update-values4');
Route::patch('/item2/{id}/change-status', [newController::class, 'changeStatus'])->name('item2.change-status');

Route::post('/item2/{id}/update', [newController::class, 'update'])->name('item2.update');
Route::post('/item2/store', [newController::class, 'store'])->name('item2.store');


Route::post('/item/{id}/approve', [newController::class, 'approve'])->name('item.approve');
Route::post('/item/{id}/reject', [newController::class, 'reject'])->name('item.reject');


Route::get('/item2/{id_barang}/trends', [newController::class, 'getTrends'])->name('item2.trends');

Route::middleware(['auth', 'cekAdmin'])->group(function () {
    Route::get('admin/penggunas', [AdminController::class, 'index'])->name('admin.penggunas');
    Route::post('admin/penggunas/{pengguna}', [AdminController::class, 'approve'])->name('admin.penggunas.approve');
});

Route::middleware(['auth', 'cekEngineer:P1B'])->group(function () {
    Route::get('/item2', [newController::class, 'index_item2'])->name('item2.index');
    Route::get('/update-values', [newController::class, 'updateValues'])->name('update-values');
    Route::get('/update-values2', [newController::class, 'updateValues2'])->name('update-values2');
});

Route::middleware(['auth', 'cekKoordinator'])->group(function () {
    Route::get('/item', [newController::class, 'index_item'])->name('item');
});