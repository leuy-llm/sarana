<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'image',
        'is_primary',
    ];

     // Relationship: A TourImage belongs to a Tour
     public function tour()
     {
         return $this->belongsTo(Tour::class);
     }
}
