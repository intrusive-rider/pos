<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUlids;
    protected $guarded = [];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

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

    /**
     * Memformat harga awal.
     */
    public function getSubTotalFmtAttribute()
    {
        return 'Rp' . number_format($this->sub_total, 2, ',', '.');
    }

    /**
     * Memformat harga akhir.
     */
    public function getGrandTotalFmtAttribute()
    {
        return 'Rp' . number_format($this->grand_total, 2, ',', '.');
    }
}
