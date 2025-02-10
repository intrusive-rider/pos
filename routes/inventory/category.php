<?php

use App\Http\Controllers\Inventory\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('categories/create', [CategoryController::class, 'create'])->name('create-category');
Route::post('categories/create', [CategoryController::class, 'store'])->name('store-category');

Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('edit-category');
Route::patch('categories/edit/{category}', [CategoryController::class, 'update'])->name('update-category');

Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('delete-category');
