<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\CleanupTransactions;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::middleware([CleanupTransactions::class])->group(function () {

        Route::view('/', 'home')->name('home');

        // transactions
        Route::get('new', [TransactionController::class, 'create'])->name('create-transaction');
        Route::post('new', [TransactionController::class, 'store'])->name('store-transaction');

        // invoices
        Route::get('invoice', [InvoiceController::class, 'index'])->name('index-invoice');
        Route::get('invoice/{transaction}', [InvoiceController::class, 'show'])->name('show-invoice');

        // products
        Route::get('product', [ProductController::class, 'index'])->name('index-product');

        Route::get('product/create', [ProductController::class, 'create'])->name('new-product');
        Route::post('product/create', [ProductController::class, 'store'])->name('save-product');

        Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('edit-product');
        Route::patch('product/edit/{id}', [ProductController::class, 'update'])->name('update-product');
        Route::delete('product/{id}', [ProductController::class, 'destroy'])->name('delete-product');
    });

    // checkout
    Route::get('checkout/{transaction}', [TransactionController::class, 'show'])->name('checkout-transaction');
    Route::post('checkout/{transaction}', [TransactionController::class, 'pay'])->name('pay-transaction');
    Route::delete('checkout/{transaction}', [TransactionController::class, 'destroy'])->name('delete-transaction');
});
