<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard.index');
    Route::get('/create', function () {
        $products = Product::all();
        return view('dashboard.create', ['products' => $products]);
    });
});
