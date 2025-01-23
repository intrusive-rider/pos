<?php

use App\Http\Controllers\Inventory\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Middleware\BlockMultiCheckout;
use App\Http\Controllers\Inventory\DiscountController;
use App\Http\Middleware\CleanupOrders;
use App\Http\Middleware\ExpireDiscount;

require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum', ExpireDiscount::class])->group(function () {

    Route::middleware([CleanupOrders::class])->group(function () {

        Route::view('/', 'home')->name('home');

        // orders
        Route::get('new', [OrderController::class, 'create'])->name('create-order');
        Route::post('new', [OrderController::class, 'store'])->name('store-order');

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
        Route::get('checkout/{order}', [OrderController::class, 'show'])->name('checkout-order');
        Route::post('checkout/{order}', [OrderController::class, 'pay'])->name('pay-order');
        Route::delete('checkout/{order}', [OrderController::class, 'destroy'])->name('delete-order');
    });
});
