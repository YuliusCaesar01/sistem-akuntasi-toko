<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Stock Routes
    Route::prefix('stock-barang')->name('stock-barang.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');

        // Gas Routes
        Route::prefix('gas')->name('gas.')->group(function () {
            Route::get('/', [ProductController::class, 'showGas'])->name('index');
            Route::post('/store', [ProductController::class, 'storeGas'])->name('store');
            Route::get('/create', function () {
                return view('stock-barang.creategas');
            })->name('create');
            Route::post('/update-quantity/{id}', [ProductController::class, 'updateQuantityGas'])->name('updateQuantity');
            Route::delete('/delete/{id}', [ProductController::class, 'deleteGas'])->name('delete');
            Route::post('/update-price/{id}', [ProductController::class, 'updatePriceGas'])->name('updatePrice');
        });

        // Drinks Routes
        Route::prefix('minuman')->name('minuman.')->group(function () {
            Route::get('/', [ProductController::class, 'showDrinks'])->name('index');
            Route::post('/store', [ProductController::class, 'storeMinuman'])->name('store');
            Route::get('/create', function () {
                return view('stock-barang.createminuman');
            })->name('create');
            Route::post('/update-quantity/{id}', [ProductController::class, 'updateQuantityMinuman'])->name('updateQuantity');
            Route::delete('/delete/{id}', [ProductController::class, 'deleteMinuman'])->name('delete');
            Route::post('/update-price/{id}', [ProductController::class, 'updatePriceMinuman'])->name('updatePrice');
        });

        // Groceries Routes
        Route::prefix('sembako')->name('sembako.')->group(function () {
            Route::get('/', [ProductController::class, 'showGroceries'])->name('index');
            Route::post('/store', [ProductController::class, 'storeSembako'])->name('store');
            Route::get('/create', function () {
                return view('stock-barang.createsembako');
            })->name('create');
            Route::post('/update-quantity/{id}', [ProductController::class, 'updateQuantitySembako'])->name('updateQuantity');
            Route::delete('/delete/{id}', [ProductController::class, 'deleteSembako'])->name('delete');
            Route::post('/update-price/{id}', [ProductController::class, 'updatePrice'])->name('updatePrice');
        });

        // Cigarettes Routes
        Route::prefix('rokok')->name('rokok.')->group(function () {
            Route::get('/', [ProductController::class, 'showCigarettes'])->name('index');
            Route::post('/store', [ProductController::class, 'storeRokok'])->name('store');
            Route::get('/create', function () {
                return view('stock-barang.createrokok');
            })->name('create');
            Route::post('/update-quantity/{id}', [ProductController::class, 'updateQuantityRokok'])->name('updateQuantity');
            Route::delete('/delete/{id}', [ProductController::class, 'deleteRokok'])->name('delete');
            Route::post('/update-price/{id}', [ProductController::class, 'updatePriceRokok'])->name('updatePrice');
        });
    });

    // Transaction Routes
    Route::resource('purchases', PurchaseController::class)->names([
        'index' => 'purchases.index',
        'create' => 'purchases.create',
        'destroy' => 'purchases.destroy',
    ]);

    // Report Routes
    Route::get('/laporan', function () {
        return view('laporan');
    })->name('laporan');
});
