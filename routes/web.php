<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
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
// Guest middleware group
Route::middleware(['guest'])->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('register');
        Route::post('/register', 'store')->name('register.store');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'authenticate')->name('login.authenticate');
    });
});

// User middleware
Route::middleware(['auth'])->group(function () {
    Route::controller(BagController::class)->group(function () {
        Route::get('/my-bag', 'bag')->name('bag');
        Route::post('/pay', 'pay')->name('pay');
        Route::post('/addToBag', 'addToBag')->name('addToBag');
        Route::post('/dropFromBag', 'dropFromBag')->name('dropFromBag');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');
    Route::post('/stock-logs', [StockLogController::class, 'store'])->name('stock-logs.store');
});

// Admin middleware
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('orders.index');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/dashboard/orders', 'index')->name('orders.index')->middleware('admin');
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

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/dashboard/employees', 'index')->name('employees.index');
    });

    // buat sales route
});



// route group
// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
