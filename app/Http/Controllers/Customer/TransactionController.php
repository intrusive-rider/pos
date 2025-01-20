<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Discount;
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

    public function pay(Request $request, Transaction $transaction)
    {
        
        // $request->validate([
        //     'buyer' => 'required',
        //     'payment_method' => 'required|in:cash,midtrans',
        //     'amount' => 'required_if:payment_method,cash|nullable|numeric',
        // ]);
    
        // if ($request->input('payment_method') === 'cash') {
        //     $request->validate([
        //         'amount' => [
        //             'required',
        //             'numeric',
        //             function ($attribute, $value, $fail) use ($transaction) {
        //                 if ($value < $transaction->grand_total) {
        //                     $fail('The ' . $attribute . ' cannot be less than Rp' . number_format($transaction->grand_total, 2, ',', '.'));
        //                 }
        //             },
        //         ],
        //     ]);
    
        //     $transaction->update([
        //         'buyer' => $request->input('buyer'),
        //         'payment_amount' => $request->input('amount'),
        //         'payment_status' => 'paid',
        //     ]);
    
        //     foreach ($transaction->products as $product) {
        //         $product->decrement('stock', $product->pivot->quantity);
        //     }
            
    
        //     return redirect(route('show-invoice', $transaction->id));
        // }

        // // Proses jika pembayaran menggunakan Midtrans
        // if ($request->input('payment_method') === 'midtrans') {
        //     // Konfigurasi Midtrans
        //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
        //     \Midtrans\Config::$isProduction = config('midtrans.is_production');
        //     \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        //     \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        //     // Set parameter untuk Midtrans
        //     $params = [
        //         'transaction_details' => [
        //             'order_id' => 'ORDER-' . $transaction->id . '-' . time(),
        //             'gross_amount' => $transaction->grand_total,
        //         ],
        //         'customer_details' => [
        //             'first_name' => $request->input('buyer'),
        //             'email' => Auth::user()->email,
        //         ],
        //     ];

        //     // Ambil Snap Token
        //     $snapToken = \Midtrans\Snap::getSnapToken($params);

        //     $transaction->snap_token = $snapToken;
        //     $transaction->save();

        //     return redirect()->route('show-invoice', $snapToken);
        // }


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
