<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function getSubTotalFmtAttribute()
    {
        return 'Rp' . number_format($this->sub_total, 2, ',', '.');
    }

    public function getGrandTotalFmtAttribute()
    {
        return 'Rp' . number_format($this->grand_total, 2, ',', '.');
    }
    
    public function getPaymentAmountFmtAttribute()
    {
        return 'Rp' . number_format($this->payment_amount, 2, ',', '.');
    }
}
