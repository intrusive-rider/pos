<?php

use App\Http\Controllers\Customer\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('invoices', [InvoiceController::class, 'index'])->name('index-invoice');
Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('show-invoice');