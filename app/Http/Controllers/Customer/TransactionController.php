<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CheckoutService;
use App\Services\MidtransService;

class TransactionController extends Controller
{
    protected $checkout_service;

    public function __construct(CheckoutService $checkout_service)
    {
        $this->checkout_service = $checkout_service;
    }

    public function create()
    {
        $products = Product::with('category')
            ->get()
            ->groupBy(function ($product) {
                return $product->category->name;
            });

        $discounts = Discount::where('active', '=', true)->get();
        return view('customer.transaction.create', compact('products', 'discounts'));
    }

    public function store(Request $request)
    {
        $buyer = 'Buyer';
        $quantities = $request->input('quantity', []);
        $discount_id = array_keys($request->input('discount', []));
        $discounts = Discount::whereIn('id', $discount_id)->get();

        if (empty($quantities) || array_sum($quantities) === 0) {
            return redirect()->back()->with('error', 'You must add at least one product to proceed.');
        }

        [$sub_total, $grand_total, $discounts] = $this->checkout_service->total($quantities, $discounts);

        $transaction = Transaction::with('discount')->create([
            'seller_id' => Auth::id(),
            'buyer' => $buyer,
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'payment_amount' => 0,
        ]);

        if ($discounts->isNotEmpty()) {
            $transaction->discounts()->attach($discounts);
        }

        foreach ($quantities as $product_id => $quantity) {
            if ($quantity > 0) {
                $transaction->products()->attach($product_id, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('checkout-transaction', $transaction->id);
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['products', 'discounts']);
        return view('customer.transaction.show', compact('transaction'));
    }

    public function pay(Request $request, Transaction $transaction, MidtransService $midtrans)
    {
        $request->validate([
            'buyer' => 'required',
        ]);

        $transaction->update([
            'buyer' => $request->input('buyer'),
        ]);

        $payment = $transaction->payments->last();

        if ($payment == null || $payment->status == 'EXPIRED') {
            $snap_token = $midtrans->createSnapToken($transaction);

            $transaction->payments()->create([
                'snap_token' => $snap_token,
                'status' => 'PENDING',
            ]);
        } else {
            $snap_token = $payment->snap_token;
        }

        return view('customer.transaction.pay', compact('transaction', 'snap_token'));

        // foreach ($transaction->products as $product) {
        //     $product->decrement('stock', $product->pivot->quantity);
        // }

        // $invoice = $transaction->id;
        // return redirect(route('show-invoice', $invoice));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect(route('home'));
    }
}
