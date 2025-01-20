<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceFmtAttribute()
    {
        return 'Rp' . number_format($this->price, 2, ',', '.');
    }
}
