<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'size',
        'price',
        'caution_fee',
        'is_featured',
        'weight',
        'slug'
    ];

    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'product', 'product_type', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(EquipmentImage::class);
    }
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean'
        ];
    }
}
