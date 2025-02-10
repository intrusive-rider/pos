<?php

use App\Http\Controllers\Inventory\DiscountController;
use Illuminate\Support\Facades\Route;

Route::get('discounts', [DiscountController::class, 'index'])->name('index-discount');

Route::get('discounts/create', [DiscountController::class, 'create'])->name('create-discount');
Route::post('discounts/create', [DiscountController::class, 'store'])->name('store-discount');

Route::get('discounts/edit/{discount}', [DiscountController::class, 'edit'])->name('edit-discount');
Route::patch('discounts/edit/{discount}', [DiscountController::class, 'update'])->name('update-discount');

Route::delete('discounts/{discount}', [DiscountController::class, 'destroy'])->name('delete-discount');
