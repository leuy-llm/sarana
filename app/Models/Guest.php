<?php

namespace App\Models;

use DataTables;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'password',
    ];

    // public function scopeNotDeleted($query)
    // {
    //     return $query->where('is_deleted', 0);


    // }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    static public function getGuest()
    {
        $return = self::select('guests.*')
            ->where('is_deleted', '=', 0);

        if (!empty(Request::get('mobile'))) {
            $return = $return->where('mobile', 'like', '%' . Request::get('mobile') . '%');
        }

        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('id', 'desc')
            ->get();
        return $return;
    }
}
