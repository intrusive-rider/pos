<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountType extends Model
{
    protected $guarded = [];

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'discount_type_id');
    }
}
