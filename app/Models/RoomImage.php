<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomImage extends Model
{
    protected $fillable = ['room_id', 'image']; // Add image_path and room_id to fillable
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    use HasFactory;
}
