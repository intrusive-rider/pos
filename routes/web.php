<?php

use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('/', 'pos.home')->name('home');
    Route::get('new', [PosController::class, 'index']);
    Route::post('new', [PosController::class, 'checkout']);
});
