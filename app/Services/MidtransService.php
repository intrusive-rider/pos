<?php

namespace App\Services;

<<<<<<< HEAD
use App\Models\Transaction;
=======
use App\Models\Order;
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4
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

<<<<<<< HEAD
    public function createSnapToken(Transaction $transaction)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->grand_total,
            ],
            'item_details' => $this->mapItemsToDetails($transaction),
            'customer_details' => $this->getCustomerDetails($transaction),
=======
    public function createSnapToken(Order $order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'TRS-' . sprintf('%03d', $order->id),
                'gross_amount' => $order->grand_total,
            ],
            'item_details' => $this->mapItemsToDetails($order),
            'customer_details' => $this->getCustomerDetails($order),
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4
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

<<<<<<< HEAD
    public function getOrder(): Transaction
    {
        $notification = new Notification();
        return Transaction::where('id', $notification->order_id)->first();
=======
    public function getOrder()
    {
        $notification = new Notification();
        return Order::where('id', $notification->order_id)->first();
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4
    }

    public function getStatus()
    {
        $notification = new Notification();
<<<<<<< HEAD
        $transaction_status = $notification->transaction_status;
        $fraud_status = $notification->fraud_status;

        return match ($transaction_status) {
=======
        $order_status = $notification->transaction_status;
        $fraud_status = $notification->fraud_status;

        return match ($order_status) {
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4
            'capture' => ($fraud_status == 'accept') ? 'success' : 'pending',
            'settlement' => 'success',
            'deny' => 'failed',
            'cancel' => 'cancel',
            'expire' => 'expire',
            'pending' => 'pending',
            default => 'unknown',
        };
    }

<<<<<<< HEAD
    protected function mapItemsToDetails(Transaction $transaction)
    {
        return $transaction->products()->get()->map(function ($product) {
=======
    protected function mapItemsToDetails(Order $order)
    {
        return $order->products()->get()->map(function ($product) {
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4
            return [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'name' => $product->name,
            ];
        })->toArray();
    }

<<<<<<< HEAD
    protected function getCustomerDetails(Transaction $transaction)
    {
        return [
            'first_name' => $transaction->buyer,
=======
    protected function getCustomerDetails(Order $order)
    {
        return [
            'first_name' => $order->buyer,
>>>>>>> 159770e691392fa0abb1b6fa3690024c09f142a4
        ];
    }
}