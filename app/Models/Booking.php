<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['guest_id', 'room_id', 'check_in_date', 'check_out_date', 'total_adults', 'total_children', 'status', 'payment_status'];

    protected $casts = [
        'check_in_date' => 'datetime',
        'check_out_date' => 'datetime',
    ];
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }


    public static function getBooking()
    {
        $return  = self::with(['guest', 'room']);
        // ->where('is_deleted', '=', 0);

        $return = $return->orderBy('id', 'desc')
            ->get();
        return $return;
           
    }
    
}
