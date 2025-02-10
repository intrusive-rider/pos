<?php

namespace App\Services;

use App\Models\Product;

/**
 * *Utility class* untuk menghitung harga akhir.
 */
class CheckoutService
{
    /**
     * Mendapatkan harga awal, akhir, dan diskon (jika ada).
     */
    public function get_total($quantities, $discounts)
    {
        $sub_total = $this->get_sub_total($quantities);
        $grand_total = $this->apply_discount($sub_total, $discounts);

        return compact('sub_total', 'grand_total', 'discounts');
    }

    /**
     * Menghitung harga awal.
     */
    private function get_sub_total($quantities)
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

    /**
     * Menerapkan diskon (jika ada).
     */
    private function apply_discount($sub_total, $discounts)
    {
        foreach ($discounts as $discount) {

            // Nilai tetap
            if ($discount->type === 'fixed') {
                if ($sub_total > ($discount->value + 5_000)) {
                    $sub_total -= $discount->value;
                }
            }

            // Persen
            if ($discount->type === 'perc' && $sub_total >= 10_000) {
                $sub_total -= (int) min(
                    $sub_total * ($discount->value / 100),
                    $discount->max_value ?? $sub_total
                );
            }
        }

        return $sub_total;
    }
}
