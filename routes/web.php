<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogAktivitasController;

use App\Http\Controllers\DokumentasiController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard (semua role)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('user', UserController::class)->except(['show']);
    Route::resource('tarif', TarifController::class)->except(['show']);
    Route::resource('area', AreaController::class)->except(['show']);
    Route::resource('kendaraan', KendaraanController::class)->except(['show']);
    Route::get('log', [LogAktivitasController::class, 'index'])->name('log.index');
});

// Petugas routes
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/masuk', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('transaksi/masuk', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('transaksi/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');
    Route::post('transaksi/{transaksi}/checkout', [TransaksiController::class, 'prosesCheckout'])->name('transaksi.proses-checkout');
    Route::get('transaksi/{transaksi}/struk', [TransaksiController::class, 'struk'])->name('transaksi.struk');
    Route::get('transaksi/{transaksi}/cetak', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak');
});

// Owner routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// Dokumentasi (akses langsung, tidak perlu auth)
Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi');

// Redirect named routes tanpa prefix (untuk kemudahan di views)
Route::middleware('auth')->group(function () {
    Route::get('/user', fn() => redirect()->route('admin.user.index'))->name('user.index');
    Route::get('/tarif', fn() => redirect()->route('admin.tarif.index'))->name('tarif.index');
    Route::get('/area', fn() => redirect()->route('admin.area.index'))->name('area.index');
    Route::get('/kendaraan', fn() => redirect()->route('admin.kendaraan.index'))->name('kendaraan.index');
    Route::get('/laporan', fn() => redirect()->route('owner.laporan.index'))->name('laporan.index');
});
