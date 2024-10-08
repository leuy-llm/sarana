<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        $carousels = DB::table('carousels')->get();
        $settings = DB::table('settings')->get();
        $about_us = DB::table('about_us')->get();
        $rooms = Room::getRoom();
        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room','Family 3 bedroom','Trip Room','King Room'])->get();
        $facilities = Facility::getFacility();
        $header_title = "Carousels";

    return view('frontend.home.index', compact('carousels', 'settings', 'rooms', 'about_us', 'roomTypes', 'facilities', 'header_title'));
}



public function contact()
{
    $data = "Contact";
    $settings = DB::table('settings')->get();
    $contact = DB::table('contact_details')->get();
   // Fetch only the specific room types you want to display
   $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room','Family 3 bedroom','Trip Room','King Room'])->get();

    return view('frontend.contact_detail.index', compact('data', 'contact', 'settings', 'roomTypes'));
}


// public function roomDetail($id)
// {
//     $data = "Details";
//     $settings = DB::table('settings')->get();
//     $rooms = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
//     // Fetch only the specific room types you want to display
//     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room','Family 3 bedroom','Trip Room','King Room'])->get();

//     return view('frontend.room_detail.index', compact('rooms', 'settings', 'data', 'roomTypes'));
// }

public function roomDetail($id, $type_name)
{
    $data = "Details";
    $settings = DB::table('settings')->get();
    $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room','Family 3 bedroom','Trip Room','King Room'])->get();
    // Fetch the room by ID
    $rooms = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
    
    // Optionally check if the slug matches the room type name (optional for better user experience)
    if (Str::slug($rooms->roomType->type_name) !== $type_name) {
        return redirect()->route('roomDetail', ['id' => $id, 'type_name' => Str::slug($rooms->roomType->type_name)]);
    }
    
    return view('frontend.room_detail.index', compact('rooms', 'settings', 'data','roomTypes'));
}


    
}
