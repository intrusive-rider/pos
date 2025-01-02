<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CheckoutService;

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

        return view('transaction.create', compact('products'));
    }

    public function store(Request $request)
    {
        $buyer = 'Buyer';
        $quantities = $request->input('quantity');
        $validation = empty($quantities) || array_sum($quantities) === 0;

        if ($validation) {
            return redirect()->back()->with('error', 'You must add at least one product to proceed.');
        }

        [$sub_total, $grand_total, $discount] = $this->checkout_service->total($quantities);

        $transaction = Transaction::with('discount')->create([
            'seller_id' => Auth::user()->id,
            'buyer' => $buyer,
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'payment_amount' => 0,
        ]);        

        if ($discount) {
            $transaction->update(['discount_id' => $discount->id]);
        }        

        foreach ($quantities as $product_id => $quantity) {
            $product = Product::find($product_id);

            if ($product && $quantity > 0) {
                $transaction->products()->attach($product_id, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('checkout-transaction', $transaction->id);
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('products');
        return view('transaction.show', compact('transaction'));
    }

    public function pay(Request $request, Transaction $transaction)
    {
        $request->validate([
            'buyer' => 'required',
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($transaction) {
                    $max_amount = $transaction->grand_total;

                    if ($value < $max_amount) {
                        $fail('The ' . $attribute . ' cannot be less than Rp' . number_format($max_amount, 2, ',', '.') . '.');
                    }
                },
            ],
        ]);

        $transaction->update([
            'buyer' => $request->input('buyer'),
            'payment_amount' => $request->input('amount'),
        ]);

        foreach ($transaction->products as $product) {
            $product->decrement('stock', $product->pivot->quantity);
        }

        $invoice = $transaction->id;
        return redirect(route('show-invoice', $invoice));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect(route('home'));
    }
}