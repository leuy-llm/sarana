<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
class RoomType extends Model
{
    use HasFactory;

    protected $fillable = ['type_name','description', 'max_persons', 'base_price', 'amenities'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    static public function getRoomType(){

        $return  = self::select('room_types.*')
                ->where('is_deleted', '=', 0);
        
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('id', 'desc')->get();
        return $return;
    }
}
