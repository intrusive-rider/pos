<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\CleanupTransactions;
use App\Http\Controllers\DataProductController;
use App\Http\Controllers\TransactionController;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::middleware([CleanupTransactions::class])->group(function () {
        Route::view('/', 'home')->name('home');

        Route::get('new', [TransactionController::class, 'create'])->name('new-transaction');
        Route::post('new', [TransactionController::class, 'store'])->name('save-transaction');

        Route::get('invoice', [InvoiceController::class, 'index'])->name('index-invoice');
        Route::get('invoice/{transaction}', [InvoiceController::class, 'show'])->name('show-invoice');

        Route::get('update-stock', [StockController::class, 'UpdateStocks'])->name('new-product');
        Route::post('update-stock/store', [StockController::class, 'store'])->name('save-product');


        Route::get('data-product', [DataProductController::class, 'DataProduct'])->name('new-data');
        Route::get('edit-product/{id}', [DataProductController::class, 'EditProduct'])->name('new-edit');
        Route::post('update-product/{id}', [DataProductController::class, 'update'])->name('save-update');
        Route::get('delete-product/{id}', [DataProductController::class, 'delete'])->name('delete-product');
    });

    Route::get('checkout/{transaction}', [TransactionController::class, 'show'])->name('checkout-transaction');
    Route::post('checkout/{transaction}', [TransactionController::class, 'pay'])->name('pay-transaction');
    Route::delete('checkout/{transaction}', [TransactionController::class, 'destroy'])->name('delete-transaction');
});
