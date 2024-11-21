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
}
