<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $fillable = [
        'checkout',
        'maintenance',
        'location',
        'pickup_location',
        'pickup_time',
        'email',
        'policy',
        'guide',
        'about',
        'facebook_link',
        'instagram_link',
        'whatsapp_link',
        'tiktok_link',
        'phone'
    ];

    protected function casts(): array
    {
        return [
            'checkout' => 'boolean',
            'maintenance' => 'boolean'
        ];
    }
}
