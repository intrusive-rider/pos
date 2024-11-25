<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('/', 'home')->name('home');

    Route::get('new', [TransactionController::class, 'create'])->name('new-transaction');
    Route::post('new', [TransactionController::class, 'store'])->name('save-transaction');

    Route::get('checkout/{transaction}', [TransactionController::class, 'show'])->name('checkout-transaction');
    Route::post('checkout/{transaction}', [TransactionController::class, 'pay'])->name('pay-transaction');
    Route::delete('checkout/{transaction}', [TransactionController::class, 'destroy'])->name('delete-transaction');

    Route::get('invoice', [InvoiceController::class, 'index'])->name('index-invoice');
    Route::get('invoice/{transaction}', [InvoiceController::class, 'show'])->name('show-invoice');
});
