<?php

use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('/', 'pos.home')->name('home');

    Route::get('new', [PosController::class, 'create'])->name('new-transaction');
    Route::post('new', [PosController::class, 'store'])->name('save-transaction');

    Route::get('checkout/{transaction}', [PosController::class, 'show'])->name('checkout-transaction');
    Route::post('checkout/{transaction}', [PosController::class, 'pay'])->name('pay-transaction');
    Route::delete('checkout/{transaction}', [PosController::class, 'destroy'])->name('delete-transaction');

    Route::view('invoice', 'invoice.index');
    Route::get('invoice/{transaction}', [PosController::class, 'invoice'])->name('view-invoice');
});
