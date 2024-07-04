<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //stock barang
    Route::get('/stock-barang', function () {
        return view('stock-barang');
    })->name('stock-barang');

    Route::get('/stock-barang/minuman', function () {
        return view('stock-barang.minuman');
    })->name('stock-barang.minuman');

    Route::get('/stock-barang/gas', function () {
        return view('stock-barang.gas');
    })->name('stock-barang.gas');

    Route::get('/stock-barang/sembako', [ProductController::class, 'showGroceries'])->name('stock-barang.sembako');
    Route::get('/stock-barang/rokok', [ProductController::class, 'showCigarettes'])->name('stock-barang.rokok');
    //transaksi
    Route::get('/transaksi', function () {
        return view('transaksi');
    })->name('transaksi');

    Route::get('/transaksi/create', function () {
        return view('transaksi.create');
    })->name('transaksicreate');


});

