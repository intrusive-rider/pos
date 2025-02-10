<?php

use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('new', [OrderController::class, 'create'])->name('create-order');
Route::post('new', [OrderController::class, 'store'])->name('store-order');

Route::get('checkout/{order}', [OrderController::class, 'show'])->name('show-order');
Route::get('edit/{order}', [OrderController::class, 'edit'])->name('edit-order');

Route::post('checkout/{order}', [PaymentController::class, 'pay'])->name('pay-order');

Route::post('edit/{order}', [OrderController::class, 'update'])->name('update-order');
