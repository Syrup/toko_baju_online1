<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TProdukController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Produk routes (public)
// Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
// Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::resource('produk', TProdukController::class); 

/* ================= ADMIN ================= */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/dashboard', [AdminController::class,'dashboard']);    
});

/* ================= USER ================= */
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])
        ->name('user.dashboard');
    Route::get('/dashboard',[UserController::class, 'dashboardUser']);    
});
