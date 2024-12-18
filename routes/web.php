<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\CleanupTransactions;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\BlockMultiCheckout;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::middleware([CleanupTransactions::class])->group(function () {

        Route::view('/', 'home')->name('home');

        // transactions
        Route::get('new', [TransactionController::class, 'create'])->name('create-transaction');
        Route::post('new', [TransactionController::class, 'store'])->name('store-transaction');

        // invoices
        Route::get('invoices', [InvoiceController::class, 'index'])->name('index-invoice');
        Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('show-invoice');

        // products
        Route::get('products', [ProductController::class, 'index'])->name('index-product');

        Route::get('products/create', [ProductController::class, 'create'])->name('new-product');
        Route::post('products/create', [ProductController::class, 'store'])->name('save-product');

        Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('edit-product');
        Route::patch('products/edit/{product}', [ProductController::class, 'update'])->name('update-product');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('delete-product');
    });

    // checkout
    Route::middleware([BlockMultiCheckout::class])->group(function () {
        Route::get('checkout/{transaction}', [TransactionController::class, 'show'])->name('checkout-transaction');
        Route::post('checkout/{transaction}', [TransactionController::class, 'pay'])->name('pay-transaction');
        Route::delete('checkout/{transaction}', [TransactionController::class, 'destroy'])->name('delete-transaction');
    });
});
