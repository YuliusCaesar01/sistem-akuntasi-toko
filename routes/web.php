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

  
    //Stok 
    Route::get('stock-barang', [ProductController::class, 'showGroceries', 'showGas', 'showDrinks','showCigarettes' ])->name('stock-barang');

    //Stok Gas
    Route::get('/stock-barang/gas', [ProductController::class, 'showGas'])->name('stock-barang.gas');
    
    //Stock Minuman
    Route::get('/stock-barang/minuman', [ProductController::class, 'showDrinks'])->name('stock-barang.minuman');

    //Stock Sembako
    Route::get('/stock-barang/sembako', [ProductController::class, 'showGroceries'])->name('stock-barang.sembako');
    Route::get('/stock-barang/createsembako', [ProductController::class, 'createSembako'])->name('stock-barang.createsembako');
    Route::post('/stock-barang/store', [ProductController::class, 'storeSembako'])->name('stock-barang.storesembako');

    //Stock Rokok
    Route::get('/stock-barang/rokok', [ProductController::class, 'showCigarettes'])->name('stock-barang.rokok');

    //transaksi
    Route::get('/transaksi', function () {
        return view('transaksi');
    })->name('transaksi');

    Route::get('/transaksi/create', function () {
        return view('transaksi.create');
    })->name('transaksicreate');


});

