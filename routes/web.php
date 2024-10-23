<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockLogController;
use App\Models\StockLog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'allProducts')->name('shop.allProducts');
    Route::get('/categories', 'allCategories')->name('shop.allCategories');
    Route::get('/c/{category}', 'showCategory')->name('shop.showCategory');
    Route::get('/shop/bag', 'bag')->name('shop.bag');
    Route::post('/shop/bag', 'bag')->name('shop.bag');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::post('/products', 'store')->name('products.store');
    Route::put('/products/{product}', 'update')->name('products.update');
    Route::put('/products/{product}/addStock', 'addStock')->name('products.addStock');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::post('/categories', 'store')->name('categories.store');
    Route::put('/categories/{category}', 'update')->name('categories.update');
});

Route::controller(StockLogController::class)->group(function () {
    Route::get('/stock-logs', 'index')->name('stock-logs.index');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers', 'index');
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

Route::get('/sales', function () {
    return view('dashboard.sales.index');
})->name('sales.index');



// route group
// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
