<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    use HasFactory;
    protected $fillable = ['booking_id','room_id','total_children','total_adults'];

    public function booking()
    {
        return $this->P(Booking::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
