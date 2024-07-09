<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('auth.login');
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
    Route::post('/stock-barang/storegas', [ProductController::class, 'storeGas'])->name('stock-barang.storegas');
    Route::get('/stock-barang/creategas', function () {
        return view('stock-barang.creategas');
    })->name('stock-barang.creategas');
    Route::post('/stock-barang/update-quantity-gas/{id}', [ProductController::class, 'updateQuantityGas'])->name('stock-barang.updateQuantityGas');
    Route::delete('/stock-barang/deletegas/{id}', [ProductController::class, 'deleteGas'])->name('stock-barang.deletegas');
    Route::post('/stock-barang/update-price-gas/{id}', [ProductController::class, 'updatePriceGas'])->name('stock-barang.updatePriceGas');

    //Stock Minuman
    Route::get('/stock-barang/minuman', [ProductController::class, 'showDrinks'])->name('stock-barang.minuman');
    Route::post('/stock-barang/storeminuman', [ProductController::class, 'storeMinuman'])->name('stock-barang.storeminuman');
    Route::get('/stock-barang/createminuman', function () {
        return view('stock-barang.createminuman');
    })->name('stock-barang.createminuman');
    Route::post('/stock-barang/update-quantity-minuman/{id}', [ProductController::class, 'updateQuantityMinuman'])->name('stock-barang.updateQuantityMinuman');
    Route::delete('/stock-barang/deleteminuman/{id}', [ProductController::class, 'deleteMinuman'])->name('stock-barang.deleteminuman');
    Route::post('/stock-barang/update-price-minuman/{id}', [ProductController::class, 'updatePriceMinuman'])->name('stock-barang.updatePriceMinuman');

    //Stock Sembako
    Route::get('/stock-barang/sembako', [ProductController::class, 'showGroceries'])->name('stock-barang.sembako');
    Route::post('/stock-barang/storesembako', [ProductController::class, 'storeSembako'])->name('stock-barang.storesembako');
    Route::get('/stock-barang/createsembako', function () {
        return view('stock-barang.createsembako');
    })->name('stock-barang.createsembako');
    Route::post('/stock-barang/update-quantity-sembako/{id}', [ProductController::class, 'updateQuantitySembako'])->name('stock-barang.updateQuantitySembako');
    Route::delete('/stock-barang/deletesembako/{id}', [ProductController::class, 'deleteSembako'])->name('stock-barang.deletesembako');
    Route::post('/stock-barang/update-price-sembako/{id}', [ProductController::class, 'updatePrice'])->name('stock-barang.updatePriceSembako');

    //Stock Rokok
    Route::get('/stock-barang/rokok', [ProductController::class, 'showCigarettes'])->name('stock-barang.rokok');
    Route::post('/stock-barang/storerokok', [ProductController::class, 'storeRokok'])->name('stock-barang.storerokok');
    Route::get('/stock-barang/createrokok', function () {
        return view('stock-barang.createrokok');
    })->name('stock-barang.createrokok');
    Route::post('/stock-barang/update-quantity-rokok/{id}', [ProductController::class, 'updateQuantityRokok'])->name('stock-barang.updateQuantityRokok');
    Route::delete('/stock-barang/deleterokok/{id}', [ProductController::class, 'deleteRokok'])->name('stock-barang.deleterokok');
    Route::post('/stock-barang/update-price-rokok/{id}', [ProductController::class, 'updatePriceRokok'])->name('stock-barang.updatePriceRokok');

    //transaksi
    Route::get('/transaksi', function () {
        return view('transaksi');
    })->name('transaksi');

    Route::get('/transaksi/create', function () {
        return view('transaksi.create');
    })->name('transaksicreate');


});

