<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_percentage',
        'start_date',
        'end_date'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
