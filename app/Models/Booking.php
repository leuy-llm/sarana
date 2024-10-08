<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['c', 'event_start_date', 'event_end_date'];
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
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
