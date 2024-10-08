<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'icon'];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_facilities');
    }

    static public function getFacility(){
        
        $return  = self::select('facilities.*')
                ->where('is_deleted', '=', 0);
        
        $return = $return->orderBy('id', 'desc')->get();
        return $return;
    }
}
