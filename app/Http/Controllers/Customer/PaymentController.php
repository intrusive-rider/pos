<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function midtrans_callback(Request $request, MidtransService $midtrans)
    {
        if ($midtrans->isSignatureKeyVerified()) {
            $order = $midtrans->getOrder();

            if ($midtrans->getStatus() == 'success') {
                $order->update([
                    'status' => 'processing',
                    'payment_status' => 'paid',
                ]);

                $last_payment = $order->payments()->latest()->first();
                $last_payment->update([
                    'status' => 'PAID',
                    'paid_at' => now(),
                ]);
            }

            if ($midtrans->getStatus() == 'pending') {
                // lakukan sesuatu jika pembayaran masih pending, seperti mengirim notifikasi ke customer
                // bahwa pembayaran masih pending dan harap selesai pembayarannya
            }

            if ($midtrans->getStatus() == 'expire') {
                // lakukan sesuatu jika pembayaran expired, seperti mengirim notifikasi ke customer
                // bahwa pembayaran expired dan harap melakukan pembayaran ulang
            }

            if ($midtrans->getStatus() == 'cancel') {
                // lakukan sesuatu jika pembayaran dibatalkan
            }

            if ($midtrans->getStatus() == 'failed') {
                // lakukan sesuatu jika pembayaran gagal
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notification successfully processed',
                ]);
        } else {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
    }
}
