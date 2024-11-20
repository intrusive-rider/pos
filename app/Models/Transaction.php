<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
