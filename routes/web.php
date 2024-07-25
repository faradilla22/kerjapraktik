<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\newController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/item', [newController::class, 'index_item'])->name('item');
Route::get('/item2', [newController::class, 'index_item2'])->name('item2');

//Route::resource('/item', \App\Http\Controllers\ItemController::class);
//Route::resource('/item2', \App\Http\Controllers\ItemController::class);

Route::resource('/bobots', \App\Http\Controllers\BobotController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/item2', [newController::class, 'index_item2'])->name('item2.index');
Route::get('/item', [newController::class, 'index_item'])->name('item.index');


//Route::post('/item2/store', [newController::class, 'store']);

Route::get('/items/pabrik/{id_pabrik}/bagian/{id_bagian}', [newController::class, 'showItems']);


Route::get('/update-values', [newController::class, 'updateValues'])->name('update-values');

Route::get('/summary', [newController::class, 'index_summary'])->name('summary.index');
Route::get('/update-values2', [newController::class, 'updateValues2'])->name('update-values2');
Route::post('/items/{id}/update', [newController::class, 'update']);

//Route::post('/item2/{id}/update', [newController::class, 'update'])->name('item2.update');
//Route::delete('/item2/{id}/delete', [newController::class, 'destroy'])->name('item2.delete');


Route::get('/update-values3', [newController::class, 'updateValues3'])->name('update-values3');

Route::get('/update-values4', [newController::class, 'updateValues4'])->name('update-values4');

// routes/web.php
Route::patch('/item2/{id}/change-status', [newController::class, 'changeStatus'])->name('item2.change-status');

Route::post('/item2/{id}/update', [newController::class, 'update'])->name('item2.update');
//Route::post('/item2/store', [newController::class, 'store'])->name('item2.store');

//Route::post('/item2/store', [newController::class, 'store'])->name('item2.store');
//Route::post('/item2/store', [newController::class, 'store'])->name('item2.store');

Route::post('/item2/store', [newController::class, 'store'])->name('item2.store');


Route::post('/item/{id}/approve', [newController::class, 'approve'])->name('item.approve');

//Route::post('/item/{id}/reject', [newController::class, 'rejectItem'])->name('item.reject');

Route::post('/item/{id}/reject', [newController::class, 'reject'])->name('item.reject');


Route::get('/item2/{id_barang}/trends', [newController::class, 'getTrends'])->name('item2.trends');