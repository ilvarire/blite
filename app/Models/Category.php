<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_featured',
        'image_url'
    ];

    public function food()
    {
        return $this->hasMany(Food::class);
    }

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean'
        ];
    }
}
