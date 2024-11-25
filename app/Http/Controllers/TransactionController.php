<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('transaction.create', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $buyer = 'Buyer';
        $quantities = $request->input('quantity');
        $validation = empty($quantities) || array_sum($quantities) === 0;

        if ($validation) {
            return redirect()->back()->with('error', 'You must add at least one product to proceed.');
        }

        $transaction = Transaction::create([
            'seller_id' => Auth::user()->id,
            'buyer' => $buyer,
            'total' => $this->calculateTotal($quantities),
            'payment_amount' => 0,
        ]);

        foreach ($quantities as $prod_id => $quantity) {
            $product = Product::find($prod_id);

            if ($product && $quantity > 0) {
                $transaction->products()->attach($prod_id, ['quantity' => $quantity]);
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
            'buyer' => ['required'],
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($transaction) {
                    $maxAmount = $transaction->total;

                    if ($value < $maxAmount) {
                        $fail('The ' . $attribute . ' cannot be less than Rp' . number_format($maxAmount, 2, ',', '.') . '.');
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

        return redirect(route('show-invoice', $transaction->id));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect(route('home'));
    }

    protected function calculateTotal($quantities)
    {
        $total = 0;

        foreach ($quantities as $prod_id => $quantity) {
            $product = Product::find($prod_id);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }

        return $total;
    }
}
