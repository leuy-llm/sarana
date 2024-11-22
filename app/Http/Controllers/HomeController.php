<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Guest;
use App\Models\RoomType;
use Carbon\Carbon;
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
        $rooms = Room::getRoomFront();
        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room','Family 3 bedroom','Trip Room','King Room'])->get();
        $facilities = Facility::getFacility();
        $header_title = "Carousels";
        $contact = DB::table('contact_details')->get();
        

    return view('frontend.home.index', compact('carousels', 'contact', 'settings', 'rooms', 'about_us', 'roomTypes', 'facilities', 'header_title'));
}



public function contact()
{
    $data = "Contact";
    $settings = DB::table('settings')->get();
    $contact = DB::table('contact_details')->get();
    $banner = Banner::where('page_name', 'contact_details')->first();
    
    // Debug output to check banner data
    if (!$banner) {
        dd('No banner found for contact page.');
    }
    
    // Fetch only the specific room types you want to display
    $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

    return view('frontend.contact_detail.index', compact('data', 'banner', 'contact', 'settings', 'roomTypes'));
}


public function reservation(){

    $data = "Reservation";
    $settings = DB::table('settings')->get();
    $banner = Banner::where('page_name', 'booking')->first();
    $contact = DB::table('contact_details')->get();
    $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room','Family 3 bedroom','Trip Room','King Room'])->get();

    return view('frontend.booking.index', compact('data','banner','contact','settings','roomTypes'));
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
    $banner = Banner::where('page_name', 'rooms')->first(); 
    $rooms = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
    $contact = DB::table('contact_details')->get();
    // Optionally check if the slug matches the room type name (optional for better user experience)
    if (Str::slug($rooms->roomType->type_name) !== $type_name) {
        return redirect()->route('roomDetail', ['id' => $id, 'type_name' => Str::slug($rooms->roomType->type_name)]);
    }
    
    return view('frontend.room_detail.index', compact('rooms','contact','settings','banner', 'data','roomTypes'));
}
// public function roomDetail($id, $type_name)
// {
//     $data = "Details";
//     $settings = DB::table('settings')->get();
//     $roomTypes = RoomType::whereIn('type_name', [
//         'Deluxe Double Room', 'Deluxe Twin Room', 
//         'Studio Suite Room', 'Family 3 bedroom', 
//         'Trip Room', 'King Room'
//     ])->get();

//     // Fetch the room by ID
//     $rooms = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
    
//     // Fetch banner specific to the room type
//     $banner = Banner::where('room_type_id', $rooms->room_type_id)->first();

//     $contact = DB::table('contact_details')->get();

//     // Ensure slug matches the room type name
//     if (Str::slug($rooms->roomType->type_name) !== $type_name) {
//         return redirect()->route('roomDetail', [
//             'id' => $id, 
//             'type_name' => Str::slug($rooms->roomType->type_name)
//         ]);
//     }
    
//     return view('frontend.room_detail.index', compact('rooms', 'contact', 'settings', 'banner', 'data', 'roomTypes'));
// }


// public function create(Request $request)
//     {
//         $checkIn = $request->input('check_in_date');
//         $checkOut = $request->input('check_out_date');

//         // Parse dates
//         $checkInDate = Carbon::parse($checkIn);
//         $checkOutDate = Carbon::parse($checkOut);

//         // Fetch rooms that are not booked during the requested dates
//         $availableRooms = Room::whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
//             $query->where(function ($query) use ($checkInDate, $checkOutDate) {
//                 $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
//                       ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
//                       ->orWhere(function($query) use ($checkInDate, $checkOutDate) {
//                           $query->where('check_in_date', '<=', $checkInDate)
//                                 ->where('check_out_date', '>=', $checkOutDate);
//                       });
//             });
//         })->get();

//         return view('frontend.booking.index', compact('availableRooms'));
//     }

//     public function store(Request $request)
//     {
//         // Validate the request
//         $validatedData = $request->validate([
//             'name' => 'required|string|max:255',
//             'mobile' => 'required|numeric',
//             'email' => 'required|email|max:255',
//             'address' => 'required|string|max:255',
//             'check_in_date' => 'required|date|after_or_equal:today',
//             'check_out_date' => 'required|date|after:check_in',
//             'room_id' => 'required|exists:rooms,id',
//             'total_adults' => 'required|integer|min:1',
//             'total_children' => 'required|integer|min:0',
//         ]);

//         // First, create a guest record
//         $guest = Guest::create([
//             'name' => $validatedData['name'],
//             'mobile' => $validatedData['mobile'],
//             'email' => $validatedData['email'],
//             'address' => $validatedData['address'],
//         ]);

//         // Check if the room is available
//         $room = Room::findOrFail($request->input('room_id'));
//         $checkInDate = Carbon::parse($request->input('check_in_date'));
//         $checkOutDate = Carbon::parse($request->input('check_out_date'));

//         $isBooked = $room->bookings()->where(function ($query) use ($checkInDate, $checkOutDate) {
//             $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
//                   ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
//                   ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
//                       $query->where('check_in_date', '<=', $checkInDate)
//                             ->where('check_out_date', '>=', $checkOutDate);
//                   });
//         })->exists();

//         if ($isBooked) {
//             return back()->withErrors('The selected room is not available for the chosen dates.');
//         }

//         // Proceed with booking
//         Booking::create([
//             'guest_id' => $guest->id,
//             'room_id' => $room->id,
//             'check_in_date' => $validatedData['check_in_date'],
//             'check_out_date' => $validatedData['check_out_date'],
//             'total_adults' => $validatedData['total_adults'],
//             'total_children' => $validatedData['total_children'],
//         ]);

//         return redirect()->route('booking.confirm')->with('success', 'Room booked successfully!');
//     }



    
}
