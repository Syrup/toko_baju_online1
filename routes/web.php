<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserKatalogController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/* ================= ADMIN ================= */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Produk Management (CRUD)
    Route::resource('produk', TProdukController::class);

    // Pelanggan Management
    Route::resource('pelanggan', PelangganController::class);

    // Pesanan Management (All orders)
    Route::resource('pesanan', PesananController::class);

    // Laporan Keuangan
    Route::get('/laporan-keuangan', [LaporanController::class, 'index'])->name('laporan.index');
});

/* ================= USER ================= */
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/', [UserController::class, 'index'])->name('dashboard');

    // Katalog Produk (Read-only, browse only)
    Route::get('/katalog', [UserKatalogController::class, 'index'])->name('katalog.index');
    Route::get('/katalog/{id}', [UserKatalogController::class, 'show'])->name('katalog.show');

    // Pesanan Saya (User's own orders)
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::delete('/pesanan/{pesanan}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

    // Profil Saya
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/profil/change-password', [ProfilController::class, 'editPassword'])->name('profil.change-password');
    Route::post('/profil/update-password', [ProfilController::class, 'updatePassword'])->name('profil.update-password');
});
