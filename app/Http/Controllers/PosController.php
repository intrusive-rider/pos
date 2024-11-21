<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('pos.create', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $buyer = 'Test';
        $quantities = $request->input('quantity');
        $validation = empty($quantities) || array_sum($quantities) === 0;

        if ($validation) {
            return redirect()->back()->with('error', 'You must add at least one product to proceed.');
        }

        $transaction = Transaction::create([
            'seller_id' => Auth::user()->id,
            'buyer' => $buyer,
            'total' => $this->calculateTotal($quantities),
        ]);

        foreach ($quantities as $prod_id => $quantity) {
            $product = Product::find($prod_id);

            if ($product && $quantity > 0) {
                $transaction->products()->attach($prod_id, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('checkout', $transaction->id);
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('products');
        return view('pos.show', compact('transaction'));
    }

    public function pay(Request $request, Transaction $transaction)
    {
        $request->validate([
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

        $transaction->payment_amount = $request->input('amount');
        $transaction->save();

        foreach ($transaction->products as $product) {
            $product->increment('stock', $product->pivot->quantity);
        }

        return redirect(route('receipt', $transaction->id));
    }

    public function receipt(Transaction $transaction)
    {
        $transaction->load('products');
        return view('pos.receipt', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect('/');
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
