<?php

namespace App\Models;

use DataTables;
use App\Models\Booking;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guest extends Authenticatable implements MustVerifyEmail
{
    // use HasFactory;
    use \Illuminate\Auth\MustVerifyEmail;
    use Notifiable;
    // Guest.php model
    protected $fillable = ['first_name', 'last_name', 'email', 'mobile', 'address', 'password','email_verified_at','zip','country','city'];


    protected $hidden = [
        'password',
        'remember_token',
    ];
    // public function scopeNotDeleted($query)
    // {
    //     return $query->where('is_deleted', 0);


    // }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function getEmailForVerification()
    {
        return $this->email;
    }
    public function sendEmailVerificationNotification()
{
    $this->notify(new CustomVerifyEmail);
}


    // static public function getGuest()
    // {
    //     $return = self::select('guests.*')
    //         ->where('is_deleted', '=', 0);

    //     if (!empty(Request::get('mobile'))) {
    //         $return = $return->where('mobile', 'like', '%' . Request::get('mobile') . '%');
    //     }

    //     if (!empty(Request::get('name'))) {
    //         $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
    //     }

    //     if (!empty(Request::get('email'))) {
    //         $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
    //     }
    //     if (!empty(Request::get('date'))) {
    //         $return = $return->whereDate('created_at', '=', Request::get('date'));
    //     }
    //     $return = $return->orderBy('id', 'desc')
    //         ->get();
    //     return $return;
    // }
    static public function getGuest($additionalFilters = null)
{
    $query = self::select('guests.*')
        ->where('is_deleted', '=', 0);

    if (!empty(Request::get('mobile'))) {
        $query = $query->where('mobile', 'like', '%' . Request::get('mobile') . '%');
    }

    if (!empty(Request::get('name'))) {
        $query = $query->where('name', 'like', '%' . Request::get('name') . '%');
    }

    if (!empty(Request::get('email'))) {
        $query = $query->where('email', 'like', '%' . Request::get('email') . '%');
    }

    if (!empty(Request::get('date'))) {
        $query = $query->whereDate('created_at', '=', Request::get('date'));
    }

    // Apply additional filters if provided
    if ($additionalFilters) {
        $query = $query->where($additionalFilters);
    }

    return $query->orderBy('id', 'desc')->get();
}

}
