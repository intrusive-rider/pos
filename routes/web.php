<?php

use App\Http\Controllers\Inventory\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Inventory\ProductController;

require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum'])->group(function () {

    Route::view('/', 'home')->name('home');

    // orders
    Route::get('order/create', [OrderController::class, 'create'])->name('create-order');
    Route::post('order/create', [OrderController::class, 'checkout'])->name('checkout-order');

    // products
    Route::get('products', [ProductController::class, 'index'])->name('index-product');

    Route::get('products/create', [ProductController::class, 'create'])->name('new-product');
    Route::post('products/create', [ProductController::class, 'store'])->name('save-product');

    Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('edit-product');
    Route::patch('products/edit/{product}', [ProductController::class, 'update'])->name('update-product');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('delete-product');

    // categories
    Route::get('categories/create', [CategoryController::class, 'create'])->name('new-category');
    Route::patch('categories/create', [CategoryController::class, 'store'])->name('save-category');

    Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::patch('categories/edit/{category}', [CategoryController::class, 'update'])->name('update-category');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('delete-category');
});
