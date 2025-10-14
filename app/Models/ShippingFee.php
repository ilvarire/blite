<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    protected $fillable = [
        'county_id',
        'state',
        'base_fee',
        'fee_per_kg',
        'est_delivery_time'
    ];

    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }
}
