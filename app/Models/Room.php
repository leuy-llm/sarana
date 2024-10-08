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
    protected $fillable = ['room_type_id', 'room_number', 'floor', 'status', 'description', 'price'];
    use HasFactory;
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_facilities');
    }


    static public function getRoom()
    {
        $return  = self::select('rooms.*')
            ->where('is_deleted', '=', 0);

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
        if (!empty(Request::get('status'))) {
            $return = $return->where('status', '=', Request::get('status'));
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('id', 'desc')->get();
        return $return;
    }
}
