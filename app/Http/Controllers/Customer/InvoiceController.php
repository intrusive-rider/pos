<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Order::latest()->get();
        return view('customer.invoice.index', compact('invoices'));
    }

    public function show(Order $invoice)
    {
        $invoice->load(['products', 'discounts']);
        return view('customer.invoice.show', compact('invoice'));
    }
}
