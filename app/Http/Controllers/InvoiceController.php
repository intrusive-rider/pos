<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Transaction::latest()->get();
        return view('invoice.index', compact('invoices'));
    }

    public function show(Transaction $invoice)
    {
        $invoice->load('products');
        return view('invoice.show', compact('invoice'));
    }
}
