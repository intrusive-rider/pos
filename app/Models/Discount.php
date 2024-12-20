<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(DiscountType::class, 'discount_types');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_discount');
    }
}
