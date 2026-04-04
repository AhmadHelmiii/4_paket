<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Models\Pengembalian;
use App\Http\Controllers\LaporanController;

Route::get('/', fn() => redirect()->route('login'));

// Auth routes (dari Breeze)
require __DIR__.'/auth.php';

// Dashboard — semua role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
    Route::resource('kategori', KategoriController::class);
    Route::get('log', [LogAktivitasController::class, 'index'])->name('log.index');
});

// Alat — admin & petugas (CRUD)
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('alat', AlatController::class)->except(['index', 'show']);
});

// Alat — semua role bisa lihat
Route::middleware(['auth'])->group(function () {
    Route::get('/alat', [AlatController::class, 'index'])->name('alat.index');
    Route::get('/alat/{alat}', [AlatController::class, 'show'])->name('alat.show');
});

// Peminjaman — semua role tapi aksi berbeda
Route::middleware(['auth'])->prefix('peminjaman')->name('peminjaman.')->group(function () {
    Route::get('/', [PeminjamanController::class, 'index'])->name('index');
    Route::get('/create', [PeminjamanController::class, 'create'])->middleware('role:peminjam')->name('create');
    Route::post('/', [PeminjamanController::class, 'store'])->middleware('role:peminjam')->name('store');
    Route::get('/{peminjaman}', [PeminjamanController::class, 'show'])->name('show');
    Route::post('/{peminjaman}/aksi', [PeminjamanController::class, 'aksi'])->middleware('role:petugas,admin')->name('aksi');
    Route::post('/{peminjaman}/konfirmasi', [PeminjamanController::class, 'konfirmasi'])->middleware('role:peminjam')->name('konfirmasi');
    Route::delete('/{peminjaman}', [PeminjamanController::class, 'destroy'])->middleware('role:admin')->name('destroy');
});

// Pengembalian — petugas & admin
Route::middleware(['auth', 'role:petugas,admin'])->prefix('pengembalian')->name('pengembalian.')->group(function () {
    Route::get('/', [PengembalianController::class, 'index'])->name('index');
    Route::get('/{peminjaman}', [PengembalianController::class, 'show'])->name('show');
    Route::post('/{peminjaman}', [PengembalianController::class, 'store'])->name('store');
    Route::get('/data/semua', [PengembalianController::class, 'semua'])->name('semua');
    Route::delete('/{pengembalian}/hapus', [PengembalianController::class, 'destroy'])->name('destroy');
});

// Laporan — petugas & admin
Route::middleware(['auth', 'role:petugas,admin'])->prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('index');
    Route::get('/pdf', [LaporanController::class, 'exportPdf'])->name('pdf');
});
