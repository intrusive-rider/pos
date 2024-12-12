<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class InvoiceController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->get();
        return view('invoice.index', compact('transactions'));
    }

    public function show(Transaction $invoice)
    {
        $invoice->load('products');
        return view('invoice.show', compact('transaction'));
    }
}
