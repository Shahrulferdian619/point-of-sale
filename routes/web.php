<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Transaksi\PembelianController;
use App\Http\Controllers\Transaksi\PengeluaranController;
use App\Http\Controllers\Transaksi\PenjualanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::prefix('master')->name('master.')->group(function(){

    //kategori produk
    Route::get('kategori/index', [KategoriController::class, 'index'])->name('kategori-index');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori-create');
    Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori-store');
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori-edit');
    Route::patch('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori-update');
    
    //produk
    Route::get('produk/index', [ProdukController::class, 'index'])->name('produk-index');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk-create');
    Route::post('produk/store', [ProdukController::class, 'store'])->name('produk-store');
    Route::get('produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk-edit');
    Route::patch('produk/update/{id}', [ProdukController::class, 'update'])->name('produk-update');

    //supplier
    Route::get('supplier/index', [SupplierController::class, 'index'])->name('supplier-index');
    Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier-create');
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('supplier-store');
    Route::get('supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier-edit');
    Route::patch('supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier-update');
});

Route::prefix('laporan')->name('laporan.')->group(function(){

});

Route::prefix('transaksi')->name('transaksi.')->group(function(){

    //pembelian produk
    Route::get('pembelian/index', [PembelianController::class, 'index'])->name('pembelian-index');
    Route::get('pembelian/create', [PembelianController::class, 'create'])->name('pembelian-create');
    Route::post('pembelian/store', [PembelianController::class, 'store'])->name('pembelian-store');
    Route::get('pembelian/edit/{id}', [PembelianController::class, 'edit'])->name('pembelian-edit');
    Route::patch('pembelian/update/{id}', [PembelianController::class, 'update'])->name('pembelian-update');

    //pengeluaran
    Route::get('pengeluaran/index', [PengeluaranController::class, 'index'])->name('pengeluaran-index');
    Route::get('pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran-create');
    Route::post('pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran-store');
    Route::get('pengeluaran/edit/{id}', [PengeluaranController::class, 'edit'])->name('pengeluaran-edit');
    Route::patch('pengeluaran/update/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran-update');

    //penjualan
    Route::get('penjualan/index', [PenjualanController::class, 'index'])->name('penjualan-index');
    Route::get('penjualan/create', [PenjualanController::class, 'create'])->name('penjualan-create');
    Route::get('penjualan/show/{id}', [PenjualanController::class, 'show'])->name('penjualan-show');
    Route::post('penjualan/store', [PenjualanController::class, 'store'])->name('penjualan-store');
    Route::get('penjualan/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualan-edit');
    Route::patch('penjualan/update/{id}', [PenjualanController::class, 'update'])->name('penjualan-update');
    Route::get('penjualan/exportPDF/{id}', [PenjualanController::class, 'exportPDF'])->name('penjualan-pdf');
});
