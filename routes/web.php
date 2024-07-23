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

Route::post('/items/{id}/update', [newController::class, 'update']);
Route::post('/items/store', [newController::class, 'store']);

Route::get('/items/pabrik/{id_pabrik}/bagian/{id_bagian}', [newController::class, 'showItems']);

Route::get('/update-values', [newController::class, 'updateValues'])->name('update-values');