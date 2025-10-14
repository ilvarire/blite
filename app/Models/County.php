<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code'
    ];

    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function shippingFee()
    {
        return $this->hasMany(ShippingFee::class);
    }
}
