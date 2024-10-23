<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // redirect to shop
    return redirect()->route('shop');
});

Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'index')->name('shop');
    Route::get('/shop-categories', 'categories')->name('shop.categories');
});

// Auth
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('login.authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

// User middleware
Route::middleware(['auth'])->group(function () {
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout-bag', 'bag')->name('checkout.bag');
        Route::post('/addToBag', 'addToBag')->name('checkout.addToBag');
    });
});

// Admin middleware
Route::middleware(['auth', 'admin'])->group(function () {

    Route::controller(SalesController::class)->group(function () {
        Route::get('/dashboard/sales', 'index')->name('sales.index');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/dashboard/products', 'index')->name('products.index');
        Route::post('/products', 'store')->name('products.store');
        Route::put('/products/{product}', 'update')->name('products.update');
        Route::put('/products/{product}/addStock', 'addStock')->name('products.addStock');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/dashboard/categories', 'index')->name('categories.index');
        Route::post('/categories', 'store')->name('categories.store');
        Route::put('/categories/{category}', 'update')->name('categories.update');
    });

    Route::controller(StockLogController::class)->group(function () {
        Route::get('/dashboard/stock-logs', 'index')->name('stock-logs.index');
    });

    // buat sales route
});



// route group
// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
