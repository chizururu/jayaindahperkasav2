<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LapormasukanController;
use App\Http\Controllers\LaporPengeluaranController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('karyawan', UserController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('pemasukan', LapormasukanController::class);
    Route::resource('laporantransaksi', DetailTransaksiController::class);
    Route::resource('pengeluaran', LaporPengeluaranController::class);
    Route::get('transaksi/{transaksi}/invoices', [TransaksiController::class, 'invoices'])->name('transaksi.invoices');
});
