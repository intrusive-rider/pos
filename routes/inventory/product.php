<?php

use App\Http\Controllers\Inventory\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index'])->name('index-product');

Route::get('products/create', [ProductController::class, 'create'])->name('create-product');
Route::post('products/create', [ProductController::class, 'store'])->name('store-product');

Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('edit-product');
Route::patch('products/edit/{product}', [ProductController::class, 'update'])->name('update-product');

Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('delete-product');