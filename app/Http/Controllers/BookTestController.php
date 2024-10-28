<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookTestController extends Controller
{
    //
    public function checkRoomAvailability()
    {
        $availableRooms = Room::select('room_type', DB::raw('count(*) as total'))
                              ->where('is_available', true)
                              ->groupBy('room_type')
                              ->get();
                              
        return response()->json($availableRooms);
    }

}
