<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class InvoiceController extends Controller
{
    /**
     * Menampilkan hal. daftar invois
     * 
     * @return View
     */
    public function index()
    {
        $invoices = Order::latest()->get();
        return view('customer.invoice.index', compact('invoices'));
    }

    /**
     * Melihat salah satu invois.
     * 
     * @param Order $invoice
     * @return View
     */
    public function show(Order $invoice)
    {
        $invoice->load(['products', 'discounts']);
        return view('customer.invoice.show', compact('invoice'));
    }
}
