<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::post('/products', 'store')->name('product.store');
    Route::put('/products/{product}', 'update')->name('product.update');
    Route::put('/products/{product}/addStock', 'addStock')->name('product.addStock');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::post('/categories', 'store')->name('category.store');
    Route::put('/categories/{category}', 'update')->name('category.update');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers', 'index');
});
