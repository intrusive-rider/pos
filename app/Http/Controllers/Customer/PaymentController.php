<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Mengonfirmasi pembayaran, lalu *redirect* ke *front-end* Midtrans
     */
    public function pay(PaymentRequest $request, Order $order)
    {
        [
            'buyer' => $buyer,
            'response' => $response,
        ] = $request->validated();

        Payment::create([
            'order_id' => $order->id,
            'buyer' => $buyer,
        ]);

        return redirect($response['data']['redirect_url']);
    }
}
