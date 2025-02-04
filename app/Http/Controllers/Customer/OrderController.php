<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create()
    {
        $products = Product::with('category')
            ->get()
            ->groupBy(function ($product) {
                return $product->category->name;
            });

        return view('customer.order.create', compact('products'));
    }

    public function checkout(Request $request)
    {
        $attr = $request->validate([
            'quantity' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    if (array_sum($value) === 0) {
                        $fail('You must add at least one product to proceed.');
                    }
                },
            ],
        ]);

        $quantities = $attr['quantity'];
        $item_details = [];
        $gross_amount = 0;

        foreach ($quantities as $product_id => $qty) {
            $product = Product::find($product_id);

            if (!$product || $qty <= 0) continue;

            $item_details[] = [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => $qty,
                'name' => $product->name,
                'category' => $product->category->name ?? 'uncategorized',
            ];

            $gross_amount += $product->price * $qty;
        }

        $auth = base64_encode(config('midtrans.server_key') . ':');
        $header = [
            'accept' => 'application/json',
            'authorization' => 'Basic ' . $auth,
            'content-type' => 'application/json',
        ];

        $body = [
            'transaction_details' => [
                'order_id' => Str::random(7),
                'gross_amount' => $gross_amount,
            ],
            'item_details' => $item_details,
        ];

        $response = Http::withHeaders($header)->post(config('midtrans.base_url') . 'payment-links', $body);
        $response_data = $response->json();

        if (isset($response_data['payment_url'])) {
            return redirect($response_data['payment_url']);
        } else {
            return redirect()->back()->with('error', 'Payment URL is unavailable. Please try again.');
        }
    }
}
