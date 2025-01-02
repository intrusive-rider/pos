<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Discount;

class CheckoutService
{
    public function total($quantities)
    {
        $discount = Discount::where('active', '=', true)->first();

        $sub_total = $this->sub_total($quantities);
        $grand_total = $this->apply($sub_total, $discount);

        return [$sub_total, $grand_total, $discount];
    }

    private function sub_total($quantities)
    {
        $sub_total = 0;

        foreach ($quantities as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product) {
                $sub_total += $product->price * $quantity;
            }
        }

        return $sub_total;
    }

    private function apply($sub_total, $discount)
    {
        // fixed
        if ($discount->type === 'fixed') {
            return $sub_total > ($discount->value + 5_000)
                ? ($sub_total - $discount->value)
                : $sub_total;
        }

        // perc
        if ($discount->type === 'perc' && $sub_total >= 10_000) {
            return $sub_total - min(
                $sub_total * ($discount->value / 100),
                $discount->max_value ?? $sub_total
            );
        }        

        return $sub_total;
    }
}
