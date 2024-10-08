<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingCalenderController extends Controller
{
    //

    public function index(){

        $bookings = Booking::with(['guest', 'room.roomType'])->get(); 
        $header_title = "Booking Calender";
        return view('back_end.calender.index',compact('header_title','bookings'));
    }
}
