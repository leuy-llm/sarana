<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingCalenderController extends Controller
{
    //
    public function index(){
        $bookings = Booking::with(['guest', 'rooms.roomType'])->where('status', '=', 'Reserved')->get(); 
        $header_title = "Booking Calender";
        return view('back_end.calender.index',compact('header_title','bookings'));
    }
}
