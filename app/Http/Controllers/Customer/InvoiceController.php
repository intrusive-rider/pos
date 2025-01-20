<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Transaction::latest()->get();
        return view('customer.invoice.index', compact('invoices'));
    }

    public function show(Transaction $invoice)
    {
        $invoice->load(['products', 'discounts']);
        return view('customer.invoice.show', compact('invoice'));
    }
}
