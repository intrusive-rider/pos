<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * *Utility class* untuk API Midtrans
 */
class MidtransService
{
    /**
     * Mendapatkan *redirect URL*
     */
    public function get_redirect($order_id, int $gross_amount, ?string $buyer)
    {
        $api = config('midtrans.base_url') . 'v1/transactions';

        $header = [
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
            'content-type' => 'application/json',
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
            ],
            'customer_details' => [
                'first_name' => $buyer
            ],
        ];

        $response = Http::withHeaders($header)
            ->withBody(json_encode($params))
            ->post($api);

        $status = $response->status();
        $data = $response->json();

        return compact('status', 'data');
    }
}
