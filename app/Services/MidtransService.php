<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class MidtransService
{
    protected string $serverKey;
    protected string $isProduction;
    protected string $isSanitized;
    protected string $is3ds;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = config('midtrans.is_production');
        $this->isSanitized = config('midtrans.is_sanitized');
        $this->is3ds = config('midtrans.is_3ds');

        Config::$serverKey = $this->serverKey;
        Config::$isProduction = $this->isProduction;
        Config::$isSanitized = $this->isSanitized;
        Config::$is3ds = $this->is3ds;
    }

    public function createSnapToken(Order $order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'TRS-' . sprintf('%03d', $order->id),
                'gross_amount' => $order->grand_total,
            ],
            'item_details' => $this->mapItemsToDetails($order),
            'customer_details' => $this->getCustomerDetails($order),
        ];

        try {
            return Snap::getSnapToken($params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function isSignatureKeyVerified()
    {
        $notification = new Notification();

        $localSignatureKey = hash(
            'sha512',
            $notification->order_id . $notification->status_code .
                $notification->gross_amount . $this->serverKey
        );

        return $localSignatureKey === $notification->signature_key;
    }

    public function getOrder()
    {
        $notification = new Notification();
        return Order::where('id', $notification->order_id)->first();
    }

    public function getStatus()
    {
        $notification = new Notification();
        $order_status = $notification->transaction_status;
        $fraud_status = $notification->fraud_status;

        return match ($order_status) {
            'capture' => ($fraud_status == 'accept') ? 'success' : 'pending',
            'settlement' => 'success',
            'deny' => 'failed',
            'cancel' => 'cancel',
            'expire' => 'expire',
            'pending' => 'pending',
            default => 'unknown',
        };
    }

    protected function mapItemsToDetails(Order $order)
    {
        return $order->products()->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'name' => $product->name,
            ];
        })->toArray();
    }

    protected function getCustomerDetails(Order $order)
    {
        return [
            'first_name' => $order->buyer,
        ];
    }
}