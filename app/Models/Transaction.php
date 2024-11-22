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

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function getTotalFmtAttribute()
    {
        return 'Rp' . number_format($this->total, 2, ',', '.');
    }
    public function getPaymentAmountFmtAttribute()
    {
        return 'Rp' . number_format($this->payment_amount, 2, ',', '.');
    }
}
