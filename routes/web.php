<?php

use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('/', 'pos.home')->name('home');

    Route::get('new', [PosController::class, 'create']);
    Route::post('new', [PosController::class, 'store']);

    Route::get('checkout/{transaction}', [PosController::class, 'show'])->name('checkout');
    Route::post('checkout/{transaction}', [PosController::class, 'pay']);
    Route::delete('checkout/{transaction}', [PosController::class, 'destroy']);

    Route::get('receipt/{transaction}', [PosController::class, 'receipt'])->name('receipt');
});
