<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ExpireDiscount;

require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum', ExpireDiscount::class])->group(function () {

    Route::view('/', 'home')->name('home');

    require __DIR__ . '/customer/order.php';
    require __DIR__ . '/customer/invoice.php';
    require __DIR__ . '/inventory/product.php';
    require __DIR__ . '/inventory/category.php';
    require __DIR__ . '/inventory/discount.php';
});
