<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('/item', \App\Http\Controllers\ItemController::class);
Route::resource('/bobots', \App\Http\Controllers\BobotController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::post('/item/{id}/updateEcrRr', [ItemController::class, 'updateEcrRr']);
