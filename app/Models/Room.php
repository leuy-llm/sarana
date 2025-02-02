<?php

namespace App\Models;

use App\Models\Facility;
use App\Models\RoomType;
use App\Models\RoomImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    protected $fillable = ['room_type_id', 'room_number', 'floor', 'status', 'description', 'price','is_deleted','max_person','view_type','bed_type','room_size','rating','special_price','extra_bed_capacity'];
    use HasFactory;
        public function images()
    {
        return $this->hasMany(RoomImage::class, 'room_id');
    }


    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_rooms')
        ->withPivot('total_adults', 'total_children');
    }


    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_facilities');
    }


    static public function getRoom()
    {
        $return  = self::select('rooms.*')
        ->where('is_deleted', '=', 0);
        if (!empty(Request::get('room_id'))) {
            $return = $return->where('id', '=', Request::get('room_id'));
        }
        if (!empty(Request::get('room_type_id'))) {
            $return = $return->where('room_type_id', '=', Request::get('room_type_id'));
        }
        if (!empty(Request::get('roomNumber'))) {
            $return = $return->where('room_number', '=', Request::get('roomNumber'));
        }
        if (!empty(Request::get('floor'))) {
            $return = $return->where('floor', '=', Request::get('floor'));
        }
        if (!empty(Request::get('price'))) {
            $return = $return->where('price', 'like', '%' . Request::get('price') . '%');
        }
        if (Request::has('status')) {
            $return = $return->where('status', '=', Request::get('status'));
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('id', 'desc')->get();
        return $return;
    }

//     static public function getRoomFront($sortBy = 'price', $orderBy = 'desc')
// {
//     $return = self::select('rooms.*')
//         ->where('is_deleted', '=', 0)
//         ->where('status', '=', 1)

//         ->orderBy($sortBy, $orderBy) // Apply dynamic sorting
//         ->paginate(3);

//     return $return;
// }

static public function getRoomFront($sortBy = 'price', $orderBy = 'desc')
{
    // Ensure valid sort columns
    $validSortColumns = ['price', 'created_at', 'updated_at']; // Add more fields here if needed

    if (!in_array($sortBy, $validSortColumns)) {
        $sortBy = 'price'; // Default fallback
    }

    // Dynamically apply sorting and pagination
    $return = self::select('rooms.*')
        ->where('is_deleted', '=', 0)
        ->where('status', '=', 1)
        ->orderBy($sortBy, $orderBy)  // Apply dynamic sorting
        ->paginate(3);  // Paginate rooms (limit per page)

    return $return;
}




}
