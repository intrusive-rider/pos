<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
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

        [$total_before, $total_after, $discount] = $this->calculate_total($quantities);

        $transaction = Transaction::with('discount')->create([
            'seller_id' => Auth::user()->id,
            'buyer' => $buyer,
            'total_before' => $total_before,
            'total_after' => $total_after,
            'payment_amount' => 0,
        ]);        

        if ($discount) {
            $transaction['discount_id'] = $discount->id;
        }

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
            'buyer' => 'required',
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($transaction) {
                    $max_amount = $transaction->total_after;

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

    protected function calculate_total($quantities)
    {
        $total_before = $this->calculate_total_before($quantities);
        $total_after = $total_before;

        $discount = $this->get_active_discount();

        if ($discount) {
            $total_after = $this->apply_discount($total_before, $discount);
        }

        return [$total_before, $total_after, $discount];
    }

    private function calculate_total_before($quantities)
    {
        $total_before = 0;

        foreach ($quantities as $prod_id => $quantity) {
            $product = Product::find($prod_id);
            if ($product) {
                $total_before += $product->price * $quantity;
            }
        }

        return $total_before;
    }

    private function get_active_discount()
    {
        return Discount::where('start_date', '<=', today())
            ->where('end_date', '>=', today())
            ->first();
    }

    private function apply_discount($total_before, $discount)
    {
        if ($discount->type === 'fixed') {
            return $total_before > $discount->value ? $total_before - $discount->value : $total_before;
        }

        if ($discount->type === 'perc') {
            $total_after = $total_before * (1 - ($discount->value / 100));

            return $discount->max_value && ($total_after < $total_before - $discount->max_value)
                ? $total_before - $discount->max_value
                : $total_after;
        }

        return $total_before;
    }
}
