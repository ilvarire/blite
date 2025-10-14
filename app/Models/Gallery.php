<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_featured',
        'facebook_link',
        'instagram_link',
        'tiktok_link',
        'slug'
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean'
        ];
    }
}
