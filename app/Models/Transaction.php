<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function getTotalBeforeFmtAttribute()
    {
        return 'Rp' . number_format($this->total_before, 2, ',', '.');
    }

    public function getTotalAfterFmtAttribute()
    {
        return 'Rp' . number_format($this->total_after, 2, ',', '.');
    }
    
    public function getPaymentAmountFmtAttribute()
    {
        return 'Rp' . number_format($this->payment_amount, 2, ',', '.');
    }
}
