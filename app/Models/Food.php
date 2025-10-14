<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_url',
        'is_available',
        'is_special',
        'is_featured',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function prices()
    {
        return $this->hasMany(FoodPrice::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    public function reviews()
    {
        return $this->hasMany(FoodReview::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'product', 'product_type', 'product_id');
    }
    public function minPrice()
    {
        return $this->prices()->min('price');
    }

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'is_special' => 'boolean',
            'is_featured' => 'boolean'
        ];
    }
}
