<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'discount_id');
    }

    public function getValueFmtAttribute()
    {
        if ($this->type === 'perc') {
            return $this->value . '%';
        }

        return 'Rp' . number_format($this->value, 2, ',', '.');
    }

    public function getMaxValueFmtAttribute()
    {
        return 'Rp' . number_format($this->max_value, 2, ',', '.');
    }
}
