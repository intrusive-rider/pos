<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CheckoutService;
use App\Services\MidtransService;

class OrderController extends Controller
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
        return view('customer.order.create', compact('products', 'discounts'));
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

        $order = Order::with('discount')->create([
            'seller_id' => Auth::id(),
            'buyer' => $buyer,
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'payment_amount' => 0,
        ]);

        if ($discounts->isNotEmpty()) {
            $order->discounts()->attach($discounts);
        }

        foreach ($quantities as $product_id => $quantity) {
            if ($quantity > 0) {
                $order->products()->attach($product_id, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('checkout-order', $order->id);
    }

    public function show(Order $order)
    {
        $order->load(['products', 'discounts']);
        return view('customer.order.show', compact('order'));
    }

<<<<<<< HEAD:app/Http/Controllers/Customer/TransactionController.php
    public function pay(Request $request, Transaction $transaction, MidtransService $midtrans)
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
        ]);

        $transaction->update([
            'buyer' => $request->input('buyer'),
        ]);

        $payment = $transaction->payments->last();

        if ($payment == null || $payment->status == 'EXPIRED') {
            $snap_token = $midtrans->createSnapToken($transaction);

            $transaction->payments()->create([
=======
    public function pay(Request $request, Order $order, MidtransService $midtrans)
    {
        $order->update($request->validate([
            'buyer' => 'required',
        ]));        

        $payment = $order->payments->last();

        if ($payment == null || $payment->status == 'EXPIRED') {
            $snap_token = $midtrans->createSnapToken($order);

            $order->payments()->create([
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4:app/Http/Controllers/Customer/OrderController.php
                'snap_token' => $snap_token,
                'status' => 'PENDING',
            ]);
        } else {
            $snap_token = $payment->snap_token;
        }

<<<<<<< HEAD:app/Http/Controllers/Customer/TransactionController.php
        return view('customer.transaction.pay', compact('transaction', 'snap_token'));

        // foreach ($transaction->products as $product) {
        //     $product->decrement('stock', $product->pivot->quantity);
        // }

        // $invoice = $transaction->id;
=======
        return view('customer.order.pay', compact('order', 'snap_token'));

        // foreach ($order->products as $product) {
        //     $product->decrement('stock', $product->pivot->quantity);
        // }

        // $invoice = $order->id;
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4:app/Http/Controllers/Customer/OrderController.php
        // return redirect(route('show-invoice', $invoice));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect(route('home'));
    }
}
