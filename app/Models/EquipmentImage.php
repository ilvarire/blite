<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentImage extends Model
{
    protected $fillable = [
        'equipment_id',
        'image_url'
    ];
    public function gallery()
    {
        return $this->belongsTo(Equipment::class);
    }
}
