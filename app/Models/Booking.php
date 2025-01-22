<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_id',
        'check_in_date',
        'check_out_date',
        'status',
        'payment_status',
    ];

    protected $casts = [
        'check_in_date' => 'datetime',
        'check_out_date' => 'datetime',
    ];
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
//     public function rooms()
// {
//     return $this->belongsToMany(Room::class, 'booking_rooms');
// }

public function rooms()
{
    return $this->belongsToMany(Room::class, 'booking_rooms', 'booking_id', 'room_id')
                ->withPivot('total_children', 'total_adults'); // Include pivot data if needed
}

    // App\Models\Booking.php
        // public function rooms()
        // {
        //     return $this->belongsToMany(Room::class, 'booking_rooms', 'booking_id', 'room_id')
        //                 ->withPivot(['total_adults', 'total_children'])
        //                 ->withTimestamps();
        // }

    

    // public function payment()
    // {
    //     return $this->belongsTo(Payment::class);
    // }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    // public static function getBooking()
    // {
    //     $return = self::with(['guest', 'rooms']) // Use 'rooms' instead of 'room'
    //         ->orderBy('id', 'desc')
    //         ->get();

    //     return $return;
    // }
    public static function getBooking()
    {
        $return = self::with(['guest', 'rooms.roomType']) // Include related data
            ->orderBy('id', 'desc')
            ->get();

        return $return;
    }

    private function checkRoomAvailability($room, $checkInDate, $checkOutDate)
{
    $bookings = Booking::whereHas('rooms', function($query) use ($room) {
        $query->where('rooms.id', $room->id);
    })
    ->where(function ($query) use ($checkInDate, $checkOutDate) {
        $query->whereRaw("'$checkInDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
              ->orWhereRaw("'$checkOutDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
              ->orWhereRaw("bookings.check_in_date <= '$checkInDate' AND bookings.check_out_date >= '$checkOutDate'");
    })
    ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
    ->exists();

    return !$bookings; // Return true if the room is available
}

}
