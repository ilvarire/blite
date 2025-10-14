<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_type',
        'product_id',
        'weight',
        'size_id',
        'size',
        'rental_start',
        'rental_duration',
        'rental_end',
        'caution_fee',
        'quantity',
        'unit_price',
        'total'
    ];

    public function product()
    {
        return $this->morphTo(null, 'product_type', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
