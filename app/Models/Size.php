<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'label'
    ];

    public function prices()
    {
        return $this->hasMany(FoodPrice::class);
    }
}
