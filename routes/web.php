<?php

use App\Http\Controllers\Inventory\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Middleware\BlockMultiCheckout;
use App\Http\Controllers\Inventory\DiscountController;
use App\Http\Middleware\CleanupTransactions;
use App\Http\Controllers\Customer\TransactionController;
use App\Http\Middleware\ExpireDiscount;

require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum', ExpireDiscount::class])->group(function () {

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

        // categories
        Route::get('categories/create', [CategoryController::class, 'create'])->name('new-category');
        Route::patch('categories/create', [CategoryController::class, 'store'])->name('save-category');

        Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('edit-category');
        Route::patch('categories/edit/{category}', [CategoryController::class, 'update'])->name('update-category');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('delete-category');

        // discount
        Route::get('discounts', [DiscountController::class, 'index'])->name('index-discount');

        Route::get('discounts/create', [DiscountController::class, 'create'])->name('new-discount');
        Route::post('discounts/create', [DiscountController::class, 'store'])->name('save-discount');

        Route::get('discounts/edit/{discount}', [DiscountController::class, 'edit'])->name('edit-discount');
        Route::patch('discounts/edit/{discount}', [DiscountController::class, 'update'])->name('update-discount');

        Route::delete('discounts/{discount}', [DiscountController::class, 'destroy'])->name('delete-discount');
    });

    // checkout
    Route::middleware([BlockMultiCheckout::class])->group(function () {
        Route::get('checkout/{transaction}', [TransactionController::class, 'show'])->name('checkout-transaction');
        Route::post('checkout/{transaction}', [TransactionController::class, 'pay'])->name('pay-transaction');
        Route::delete('checkout/{transaction}', [TransactionController::class, 'destroy'])->name('delete-transaction');
    });
});
