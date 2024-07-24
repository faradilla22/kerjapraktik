<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Middleware\StatusMiddleware;
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

Route::get('/item2', [newController::class, 'index_item2'])->name('item2.index');

Route::post('/items/{id}/update', [newController::class, 'update']);
Route::post('/items/store', [newController::class, 'store']);

Route::get('/items/pabrik/{id_pabrik}/bagian/{id_bagian}', [newController::class, 'showItems']);
Route::get('/update-values', [newController::class, 'updateValues'])->name('update-values');

Route::get('/summary', [newController::class, 'index_summary'])->name('summary.index');
Route::get('/update-values2', [newController::class, 'updateValues2'])->name('update-values2');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('koordinator/penggunas', [KoordinatorController::class, 'index'])->name('koordinator.penggunas');
    Route::post('koordinator/penggunas/{pengguna}', [KoordinatorController::class, 'approve'])->name('koordinator.penggunas.approve');
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