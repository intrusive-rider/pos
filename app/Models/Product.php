<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price') // beserta banyaknya pembelian
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Memformat harga produk.
     */
    public function getPriceFmtAttribute()
    {
        return 'Rp' . number_format($this->price, 2, ',', '.');
    }
}
