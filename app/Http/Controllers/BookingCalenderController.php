<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingCalenderController extends Controller
{
    public function index(Request $request)
{
    $query = Booking::with(['guest', 'rooms.roomType'])
        ->where('status', '=', 'Reserved')
        ->where('booking_source', '=', 'website');

    if ($request->has('check_in_date') && $request->get('check_in_date') != null) {
        $query->whereDate('check_in_date', '>=', $request->get('check_in_date'));
    }

    if ($request->has('check_out_date') && $request->get('check_out_date') != null) {
        $query->whereDate('check_out_date', '<=', $request->get('check_out_date'));
    }

    $bookings = $query->get();

    $header_title = "Booking Calendar";
    return view('back_end.calender.index', compact('header_title', 'bookings'));
}

}
