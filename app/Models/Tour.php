<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'duration',
        'location',
        'is_featured',
    ];

    // Relationship: A Tour has many images
    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    
    use HasFactory;
}
