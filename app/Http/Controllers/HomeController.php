<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Guest;
use App\Models\Meeting;
use App\Models\Restaurant;
use App\Models\RoomType;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        $facilities = Facility::getFacility();
        $header_title = "Carousels";
        $contact = DB::table('contact_details')->get();
        $galleries = DB::table('galleries')->where('status', 1)->get();

        return view('frontend.home.index', compact('carousels', 'galleries', 'contact', 'settings', 'rooms', 'about_us', 'roomTypes', 'facilities', 'header_title'));
    }

    //     public function room(Request $request)
    // {
    //     $data = "Room";
    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
    //     $banner = Banner::where('page_name', 'rooms')->first();
    //     $contact = DB::table('contact_details')->get();

    //     // Get sort and order from the request or set default
    //     $sortBy = $request->get('sort_by', 'price');
    //     $orderBy = $request->get('order_by', 'desc');

    //     // Pass the sort and order to the Room model
    //     $rooms = Room::getRoomFront($sortBy, $orderBy);

    //     return view('frontend.rooms.index', compact('data', 'rooms', 'banner', 'contact', 'settings', 'roomTypes', 'sortBy', 'orderBy'));
    // }



    public function rooms(Request $request)
    {
        $data = "Room";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        $banner = Banner::where('page_name', 'rooms')->first();
        $contact = DB::table('contact_details')->get();

        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $query = Room::query()->where('status', 1)->where('is_deleted', 0);
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        $totalPersons = $adults + $children;
        $sortBy = $request->get('sort_by', 'price');
        $orderBy = $request->get('order_by', 'desc');

        // $query->orderBy($sortBy, $orderBy);
        $query->with(['images', 'roomType']);

        $rooms = $query->paginate(10); // Adjust per page as needed for testing
        $rooms->appends($request->all()); // Append query parameters to pagination links
        return view('frontend.rooms.index', compact('rooms', 'data', 'banner', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children', 'totalPersons', 'sortBy', 'orderBy'));
    }

    // public function rooms(Request $request)
    // {
    //     $data = "Room";
    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
    //     $banner = Banner::where('page_name', 'rooms')->first();
    //     $contact = DB::table('contact_details')->get();

    //     $checkIn = $request->input('check_in');
    //     $checkOut = $request->input('check_out');

    //     $query = Room::query()->where('status', 1)->where('is_deleted', 0);
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $totalPersons = $adults + $children;

    //     $sortOption = $request->get('sort_by', 'default'); // Get sort option from request

    //     // Apply sorting logic
    //     if ($sortOption === 'price_low_high') {
    //         $query->orderBy('price', 'asc'); // Sort by lowest price
    //     } elseif ($sortOption === 'price_high_low') {
    //         $query->orderBy('price', 'desc'); // Sort by highest price
    //     }

    //     $query->with(['images', 'roomType']);

    //     $rooms = $query->paginate(10); // Adjust per page as needed for testing
    //     $rooms->appends($request->all()); // Append query parameters to pagination links

    //     return view('frontend.rooms.index', compact('rooms', 'data', 'banner', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children', 'totalPersons', 'sortOption'));
    // }


    public function roomindex(Request $request)
    {
        $data = "Room Page";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        $banner = Banner::where('page_name', 'rooms')->first();
        $contact = DB::table('contact_details')->get();
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $query = Room::query()->where('status', 1)->where('is_deleted', 0);
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        $totalPersons = $adults + $children;
        // $sortBy = $request->get('sort_by', 'price');
        // $orderBy = $request->get('order_by', 'desc');

        // $query->orderBy($sortBy, $orderBy);
        $query->with(['images', 'roomType']);

        // if ($checkIn && $checkOut) {
        //     $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
        //         $q->where('check_in_date', '<', $checkOut)
        //             ->where('check_out_date', '>', $checkIn);
        //     });
        // } else {
        //     $query->whereDoesntHave('bookings', function ($q) {
        //         $q->where('check_out_date', '>=', now());
        //     });
        // }

        $rooms = $query->paginate(10); // Adjust per page as needed for testing
        $rooms->appends($request->all()); // Append query parameters to pagination links
        return view('frontend.rooms.room', compact('rooms', 'data', 'banner', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children'));
    }

    


    public function food(){
        $data = "Food & Drinks";
        $settings = DB::table('settings')->get();
        $contact = DB::table('contact_details')->get();
        $banner = Banner::where('page_name', 'food')->first();
        $foodItems = Restaurant::all();
        return view('frontend.food.index', compact('data', 'banner', 'contact', 'settings', 'foodItems'));
    }



    // public function filterRooms(Request $request)
    // {
    //     $data = "Room";
    //     $checkIn = $request->input('check_in');
    //     $checkOut = $request->input('check_out');
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $totalPersons = $adults + $children;
    //     $contact = DB::table('contact_details')->get();
    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

    //     // Query for rooms
    //     $query = Room::query()->where('status', 1)->where('is_deleted', 0);
    //     $query->with(['images', 'roomType', 'facilities']);

    //     // Filter by availability for the selected date range
    //     if ($checkIn && $checkOut) {
    //         $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
    //             $q->where('check_in_date', '<', $checkOut)
    //                 ->where('check_out_date', '>', $checkIn);
    //         });
    //     }

    //     // Filter by maximum capacity
    //     $query->where('max_person', '>=', $totalPersons);
    //     // Paginate results
    //     $rooms = $query->paginate(2); // Adjust per page for testing
    //     $rooms->appends($request->all()); // Append query parameters for pagination links

    //     return view('frontend.rooms.room_list', compact('rooms', 'data', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children'));
    // }







    // public function filterRooms(Request $request)
    // {
    //     $data = "Room";
    //     $checkIn = $request->input('check_in');
    //     $checkOut = $request->input('check_out');
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $priceMin = $request->input('price_min', 0); // Default minimum
    //     $priceMax = $request->input('price_max', 100000); // Default maximum
    //     $totalPersons = $adults + $children;

    //     $contact = DB::table('contact_details')->get();
    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::getRoomType();


    //     $query = Room::where('is_deleted', 0)
    //         ->where('status', 1)
    //         ->whereNotIn('id', function ($subQuery) use ($checkIn) {
    //             $subQuery->select('room_id')
    //                 ->from('bookings')
    //                 ->whereNotIn('status', ['Cancelled', 'Checked-Out'])
    //                 ->whereRaw("'$checkIn' BETWEEN check_in_date AND check_out_date");
    //         })
    //         ->with(['images', 'roomType', 'facilities']); // Eager load relationships
    //     // Filter by maximum capacity
    //     $query->where('max_person', '>=', $totalPersons);

    //     // Filter by price range
    //     $query->whereBetween('price', [$priceMin, $priceMax]);

    //     $sortOption = $request->get('sort_by', 'default'); // Get sort option from request

    //     // Apply sorting logic
    //     if ($sortOption === 'price_low_high') {
    //         $query->orderBy('price', 'asc'); // Sort by lowest price
    //     } elseif ($sortOption === 'price_high_low') {
    //         $query->orderBy('price', 'desc'); // Sort by highest price
    //     }

    //     $filteredRoomCount = $query->count();
    //     // Paginate results
    //     $rooms = $query->paginate(10);
    //     $rooms->appends($request->all());

    //     return view('frontend.rooms.room_list', compact('rooms', 'sortOption', 'data', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children', 'filteredRoomCount', 'priceMin', 'priceMax'));
    // }

    // public function filterRooms(Request $request)
    // {
    //     $data = "Room";
    //     $checkIn = $request->input('check_in');
    //     $checkOut = $request->input('check_out');
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $priceMin = $request->input('price_min', 0); // Default minimum
    //     $priceMax = $request->input('price_max', 100000); // Default maximum
    //     $totalPersons = $adults + $children;

    //     $contact = DB::table('contact_details')->get();
    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();


    //     $query = Room::where('is_deleted', 0)
    //         ->where('status', 1)
    //         ->whereNotIn('id', function ($subQuery) use ($checkIn) {
    //             $subQuery->select('room_id')
    //                 ->from('bookings')
    //                 ->whereNotIn('status', ['Cancelled', 'Checked-Out'])
    //                 ->whereRaw("'$checkIn' BETWEEN check_in_date AND check_out_date");
    //         })
    //         ->with(['images', 'roomType', 'facilities']); // Eager load relationships
    //     // Filter by maximum capacity
    //     $query->where('max_person', '>=', $totalPersons);

    //     // Filter by price range
    //     $query->whereBetween('price', [$priceMin, $priceMax]);

    //     $sortOption = $request->get('sort_by', 'default'); // Get sort option from request

    //     // Apply sorting logic
    //     if ($sortOption === 'price_low_high') {
    //         $query->orderBy('price', 'asc'); // Sort by lowest price
    //     } elseif ($sortOption === 'price_high_low') {
    //         $query->orderBy('price', 'desc'); // Sort by highest price
    //     }

    //     $filteredRoomCount = $query->count();
    //     // Paginate results
    //     $rooms = $query->paginate(10);
    //     $rooms->appends($request->all());

    //     return view('frontend.rooms.room_list', compact('rooms', 'sortOption', 'data', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children', 'filteredRoomCount', 'priceMin', 'priceMax'));
    // }

//     public function filterRooms(Request $request)
// {
//     $data = "Room";
//     $checkIn = $request->input('check_in');
//     $checkOut = $request->input('check_out');
//     $adults = $request->input('adults', 0);
//     $children = $request->input('children', 0);
//     $priceMin = $request->input('price_min', 0); // Default minimum
//     $priceMax = $request->input('price_max', 100000); // Default maximum
//     $totalPersons = $adults + $children;

//     $contact = DB::table('contact_details')->get();
//     $settings = DB::table('settings')->get();
//     $roomTypes = RoomType::whereIn('type_name', [
//         'Deluxe Double Room',
//         'Deluxe Twin Room',
//         'Studio Suite Room',
//         'Family 3 bedroom',
//         'Trip Room',
//         'King Room'
//     ])->get();

//     $query = Room::where('is_deleted', 0)
//         ->where('status', 1)
//         ->whereNotIn('id', function ($subQuery) use ($checkIn) {
//             $subQuery->select('room_id')
//                 ->from('booking_rooms') // Join booking_rooms instead of bookings
//                 ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id') // Join bookings for date and status checks
//                 ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
//                 ->whereRaw("'$checkIn' BETWEEN bookings.check_in_date AND bookings.check_out_date");
//         })
//         ->with(['images', 'roomType', 'facilities']); // Eager load relationships

//     // Filter by maximum capacity
//     $query->where('max_person', '>=', $totalPersons);

//     // Filter by price range
//     $query->whereBetween('price', [$priceMin, $priceMax]);

//     $sortOption = $request->get('sort_by', 'default'); // Get sort option from request

//     // Apply sorting logic
//     if ($sortOption === 'price_low_high') {
//         $query->orderBy('price', 'asc'); // Sort by lowest price
//     } elseif ($sortOption === 'price_high_low') {
//         $query->orderBy('price', 'desc'); // Sort by highest price
//     }

//     $filteredRoomCount = $query->count();
//     // Paginate results
//     $rooms = $query->paginate(10);
//     $rooms->appends($request->all());

//     return view('frontend.rooms.room_list', compact(
//         'rooms',
//         'sortOption',
//         'data',
//         'contact',
//         'settings',
//         'roomTypes',
//         'checkIn',
//         'checkOut',
//         'adults',
//         'children',
//         'filteredRoomCount',
//         'priceMin',
//         'priceMax'
//     ));
// }

public function Roomfilter(Request $request)
{
    $data = "Room";
    $checkIn = $request->input('check_in');
    $checkOut = $request->input('check_out');
    $adults = $request->input('adults', 0);
    $children = $request->input('children', 0);
    $priceMin = $request->input('price_min', 0); // Default minimum
    $priceMax = $request->input('price_max', 100000); // Default maximum
    $totalPersons = $adults + $children;

    $contact = DB::table('contact_details')->get();
    $settings = DB::table('settings')->get();
    $roomTypes = RoomType::getRoomType();

    $query = Room::where('is_deleted', 0)
        ->where('status', 1)
        ->whereNotIn('id', function ($subQuery) use ($checkIn) {
            $subQuery->select('room_id')
                ->from('booking_rooms') // Join booking_rooms instead of bookings
                ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id') // Join bookings for date and status checks
                ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
                ->whereRaw("'$checkIn' BETWEEN bookings.check_in_date AND bookings.check_out_date");
        })
        ->with(['images', 'roomType', 'facilities']); // Eager load relationships

    // Filter by maximum capacity
    $query->where('max_person', '>=', $totalPersons);

    // Filter by price range
    $query->whereBetween('price', [$priceMin, $priceMax]);

    $sortOption = $request->get('sort_by', 'default'); // Get sort option from request

    // Apply sorting logic
    if ($sortOption === 'price_low_high') {
        $query->orderBy('price', 'asc'); // Sort by lowest price
    } elseif ($sortOption === 'price_high_low') {
        $query->orderBy('price', 'desc'); // Sort by highest price
    }

    $filteredRoomCount = $query->count();
    // Paginate results
    $rooms = $query->paginate(10);
    $rooms->appends($request->all());

    return view('frontend.rooms.index', compact(
        'rooms',
        'sortOption',
        'data',
        'contact',
        'settings',
        'roomTypes',
        'checkIn',
        'checkOut',
        'adults',
        'children',
        'filteredRoomCount',
        'priceMin',
        'priceMax'
    ));
}

// public function getAvailableRooms(Request $request)
// {
//     $checkIn = $request->input('check_in');
//     $checkOut = $request->input('check_out');
//     $rooms = Room::with(['images', 'roomType'])->get();

//     if (!$checkIn || !$checkOut) {
//         return response()->json(['error' => 'Please provide both check-in and check-out dates.'], 400);
//     }

//     // Query to get available rooms
//     $availableRooms = Room::whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
//         $query->where(function ($q) use ($checkIn, $checkOut) {
//             $q->where('check_in_date', '<', $checkOut)
//               ->where('check_out_date', '>', $checkIn);
//         });
//     })->get();

//     // Render the partial view
//     $html = view('partials.rooms', compact('availableRooms','rooms',''))->render();

//     return response()->json(['html' => $html]);
// }

// public function modalfilter(Request $request)
// {
//     $data = "Room";
//     $settings = DB::table('settings')->get();
//     $roomTypes = RoomType::getRoomType();
//     $banner = Banner::where('page_name', 'rooms')->first();
//     $contact = DB::table('contact_details')->get();

//     $checkIn = $request->input('check_in');
//     $checkOut = $request->input('check_out');
//     $adults = $request->input('adults', 0);
//     $children = $request->input('children', 0);
//     $totalPersons = $adults + $children;
//     $sortBy = $request->get('sort_by', 'price');
//     $orderBy = $request->get('order_by', 'desc');

//     $rooms = Room::where('status', 1)
//              ->where('is_deleted', 0)
//              ->with(['images', 'roomType'])
//              ->paginate(10);

// return view('frontend.booking.filtermodal', compact('rooms', 'checkIn', 'checkOut', 'adults', 'children'));
// }

public function modalfilter(Request $request)
{
    $rooms = Room::with('images', 'roomType')
        ->where('status', 1)
        ->where('is_deleted', 0)
        ->get(); // No need to filter based on query parameters for the modal

    // Return the modal view without passing any query parameters
    return view('frontend.booking.filtermodal', compact('rooms'));
}


// public function bookingPage(Request $request)
// {
//     $rooms = Room::with(['images','roomType']);
//     dd($rooms); // This will dump the content of $rooms
//     return view('frontend.booking.bookings', compact('rooms'));

// }

// public function bookingPage(Request $request)
// {
//     $checkIn = $request->input('check_in');
//     $checkOut = $request->input('check_out');
//     $adults = $request->input('adults');
//     $children = $request->input('children');
    
//     // Pass necessary variables to the view
//     return view('frontend.booking.bookings', compact('rooms','check_in','check_out','children','adults'));
// }



// public function availableRooms(Request $request, $checkin_date)
// {
//     try {
//         $checkOutDate = $request->input('check_out_date');

//         // Validate parameters
//         if (!$checkin_date || !$checkOutDate) {
//             return response()->json(['error' => 'Invalid dates provided.'], 400);
//         }

//         // Query available rooms
//         $availableRooms = DB::table('rooms')
//             ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
//             ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
//             ->where('rooms.is_deleted', 0)
//             ->where('rooms.status', 1)
//             ->whereNotIn('rooms.id', function ($query) use ($checkin_date, $checkOutDate) {
//                 $query->select('room_id')
//                     ->from('booking_rooms')
//                     ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
//                     ->where(function ($query) use ($checkin_date, $checkOutDate) {
//                         $query->whereRaw("'$checkin_date' BETWEEN bookings.check_in_date AND bookings.check_out_date")
//                               ->orWhereRaw("'$checkOutDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
//                               ->orWhereRaw("bookings.check_in_date <= '$checkin_date' AND bookings.check_out_date >= '$checkOutDate'");
//                     });
//             })
//             ->get();

//         return response()->json(['data' => $availableRooms], 200);
//     } catch (\Exception $e) {
//         Log::error('AvailableRooms Error: ' . $e->getMessage());
//         return response()->json(['error' => 'Failed to fetch available rooms.'], 500);
//     }
// }

public function availableRooms(Request $request, $checkin_date)
{
    try {
        $checkOutDate = $request->input('check_out_date');

        // Validate parameters
        if (!$checkin_date || !$checkOutDate) {
            return response()->json(['error' => 'Invalid dates provided.'], 400);
        }

        // Query available rooms
        $availableRooms = DB::table('rooms')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
            ->where('rooms.is_deleted', 0)
            ->where('rooms.status', 1)
            ->whereNotIn('rooms.id', function ($query) use ($checkin_date, $checkOutDate) {
                $query->select('room_id')
                    ->from('booking_rooms')
                    ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
                    ->where(function ($query) use ($checkin_date, $checkOutDate) {
                        $query->whereRaw("'$checkin_date' BETWEEN bookings.check_in_date AND bookings.check_out_date")
                              ->orWhereRaw("'$checkOutDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
                              ->orWhereRaw("bookings.check_in_date <= '$checkin_date' AND bookings.check_out_date >= '$checkOutDate'");
                    });
            })
            ->get();

        return response()->json(['data' => $availableRooms], 200);
    } catch (\Exception $e) {
        Log::error('AvailableRooms Error: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to fetch available rooms.'], 500);
    }
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
    public function reservation()
    {

        $data = "Reservation";
        $settings = DB::table('settings')->get();
        $banner = Banner::where('page_name', 'booking')->first();
        $contact = DB::table('contact_details')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.booking.index', compact('data', 'banner', 'contact', 'settings', 'roomTypes'));
    }
    // public function createBooking(Request $request)
    // {
    //     $request->validate([
    //         'check_in' => 'required|date|before:check_out',
    //         'check_out' => 'required|date|after:check_in',
    //     ]);
    //     $data = "Reservation";
    //     $settings = DB::table('settings')->get();
    //     $banner = Banner::where('page_name', 'booking')->first();
    //     $contact = DB::table('contact_details')->get();
    //     $roomId = $request->input('room_id');
    //     $guest = auth()->guard('guest')->check() ? auth()->guard('guest')->user() : null;

    //     $checkIn = Carbon::parse($request->input('check_in'));
    //     $checkOut = Carbon::parse($request->input('check_out'));
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $totalPersons = $adults + $children;
    //     $nights = $checkIn->diffInDays($checkOut); // Calculate the difference in days
    //     $readonly = $request->input('readonly', false);

    //     // $room = Room::with('bookings')->findOrFail($roomId);
    //     $room = Room::with(['roomType'])->findOrFail($roomId);
    //     $rooms = Room::findOrFail($roomId);
    //     $roomPrice = $rooms->price; // Access the price of the room
    //     // $totalPrice = $roomPrice * $nights; // Calculate the total price
    //     $totalPrice = ($room->special_price ?? $room->price) * $nights;

    //     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

    //     return view('frontend.booking.bookings', compact('data', 'totalPrice', 'guest', 'nights', 'adults', 'readonly', 'children', 'totalPersons', 'room', 'checkIn', 'checkOut', 'banner', 'contact', 'settings', 'rooms', 'roomTypes'));
    // }

//     public function createBooking(Request $request)
// {
//     $request->validate([
//         'check_in' => 'required|date|before:check_out',
//         'check_out' => 'required|date|after:check_in',
//         'rooms' => 'required|array|min:1',
//         'rooms.*' => 'exists:rooms,id',
//     ]);

//     $checkIn = Carbon::parse($request->input('check_in'));
//     $checkOut = Carbon::parse($request->input('check_out'));
//     $adults = $request->input('adults', 0);
//     $children = $request->input('children', 0);
//     $nights = $checkIn->diffInDays($checkOut);

//     $selectedRooms = Room::with('roomType')->whereIn('id', $request->input('rooms'))->get();
//     $totalPrice = $selectedRooms->sum(function ($room) use ($nights) {
//         return ($room->special_price ?? $room->price) * $nights;
//     });

//     return view('frontend.booking.bookings', [
//         'rooms' => $selectedRooms,
//         'totalPrice' => $totalPrice,
//         'nights' => $nights,
//         'checkIn' => $checkIn,
//         'checkOut' => $checkOut,
//         'adults' => $adults,
//         'children' => $children,
//     ]);
// }

// public function createBooking(Request $request)
// {
//      dd($request->all());  // This will dump all parameters and stop execution
//     $request->validate([
//         'check_in' => 'required|date|before:check_out',
//         'check_out' => 'required|date|after:check_in',
//         'room_id' => 'required|array|min:1',
//         'room_id.*' => 'exists:rooms,id',
//     ]);

//     $checkIn = Carbon::parse($request->input('check_in'));
//     $checkOut = Carbon::parse($request->input('check_out'));
//     $adults = $request->input('adults', 0);
//     $children = $request->input('children', 0);
//     $nights = $checkIn->diffInDays($checkOut);

//     $selectedRooms = Room::with('roomType')->whereIn('id', $request->input('room_id'))->get();
//     $totalPrice = $selectedRooms->sum(function ($room) use ($nights) {
//         return ($room->special_price ?? $room->price) * $nights;
//     });

//     return view('frontend.booking.bookings', [
//         'rooms' => $selectedRooms,
//         'totalPrice' => $totalPrice,
//         'nights' => $nights,
//         'checkIn' => $checkIn,
//         'checkOut' => $checkOut,
//         'adults' => $adults,
//         'children' => $children,
//     ]);
// }

public function createBooking(Request $request)
{
    // Parse the rooms string into an array
    $contact = DB::table('contact_details')->get();
    $rooms = explode(',', $request->input('rooms'));

    // Dump data to verify parsing (remove after debugging)
    // dd([
    //     'all' => $request->all(),
    //     'parsed_rooms' => $rooms,
    // ]);

    $request->merge(['rooms' => $rooms]);

    // Validate the request
    $request->validate([
        'check_in' => 'required|date|before:check_out',
        'check_out' => 'required|date|after:check_in',
        'rooms' => 'required|array|min:1',
        'rooms.*' => 'exists:rooms,id',
    ]);

    // Process booking details
    $checkIn = Carbon::parse($request->input('check_in'));
    $checkOut = Carbon::parse($request->input('check_out'));
    $adults = $request->input('adults', 0);
    $children = $request->input('children', 0);
    $nights = $checkIn->diffInDays($checkOut);

    $selectedRooms = Room::with('roomType')->whereIn('id', $rooms)->get();
    $totalPrice = $selectedRooms->sum(function ($room) use ($nights) {
        return ($room->special_price ?? $room->price) * $nights;
    });

    // Return the booking details view
    return view('frontend.booking.bookings', [
        'rooms' => $selectedRooms,
        'totalPrice' => $totalPrice,
        'nights' => $nights,
        'checkIn' => $checkIn,
        'checkOut' => $checkOut,
        'adults' => $adults,
        'children' => $children,
        'contact' => $contact
    ]);
}




    //     public function createBooking(Request $request)
    // {
    //     // Validate input
    //     $request->validate([
    //         'room_id' => 'required|exists:rooms,id',
    //         'check_in' => 'required|date|before:check_out',
    //         'check_out' => 'required|date|after:check_in',
    //     ]);

    //     // Retrieve data from the request
    //     $roomId = $request->input('room_id');
    //     $checkIn = Carbon::parse($request->input('check_in'));
    //     $checkOut = Carbon::parse($request->input('check_out'));
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $nights = $checkIn->diffInDays($checkOut);

    //     // Fetch room and calculate total price
    //     $room = Room::with('roomType')->findOrFail($roomId);
    //     $roomPrice = $room->price;
    //     $totalPrice = $roomPrice * $nights;

    //     // Fetch other necessary data
    //     $settings = DB::table('settings')->get();
    //     $contact = DB::table('contact_details')->get();
    //     $banner = Banner::where('page_name', 'booking')->first();
    //     $guest = auth()->guard('guest')->check() ? auth()->guard('guest')->user() : null;

    //     return view('frontend.booking.bookings', compact(
    //         'guest', 'totalPrice', 'nights', 'adults', 'children', 
    //         'room', 'checkIn', 'checkOut', 'banner', 'contact', 'settings'
    //     ));
    // }

    // public function proceedToPayment(Request $request)
    // {
    //     // Validate input
    //     $request->validate([
    //         'room_id' => 'required|exists:rooms,id',
    //         'check_in' => 'required|date|before:check_out',
    //         'check_out' => 'required|date|after:check_in',
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'mobile' => 'required|string|max:15',
    //     ]);

    //     // Retrieve input data
    //     $roomId = $request->input('room_id');
    //     $checkIn = Carbon::parse($request->input('check_in'));
    //     $checkOut = Carbon::parse($request->input('check_out'));
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $nights = $checkIn->diffInDays($checkOut);

    //     // Create a new booking record
    //     $booking = Booking::create([
    //         'room_id' => $roomId,
    //         'check_in_date' => $checkIn,
    //         'check_out_date' => $checkOut,
    //         'total_adults' => $adults,
    //         'total_children' => $children,
    //         'guest_first_name' => $request->input('first_name'),
    //         'guest_last_name' => $request->input('last_name'),
    //         'guest_email' => $request->input('email'),
    //         'guest_mobile' => $request->input('mobile'),
    //     ]);

    //     // Calculate total price
    //     $room = Room::findOrFail($roomId);
    //     $roomPrice = $room->price;
    //     $totalPrice = $roomPrice * $nights;

    //     // Redirect to checkout page
    //     return redirect()->route('checkout.index', [
    //         'booking_id' => $booking->id,
    //         'room_id' => $roomId,
    //         'check_in' => $checkIn->format('Y-m-d'),
    //         'check_out' => $checkOut->format('Y-m-d'),
    //         'adults' => $adults,
    //         'children' => $children,
    //         'first_name' => $booking->first_name,
    //         'last_name' => $booking->last_name,
    //         'email' => $booking->email,
    //         'mobile' => $booking->mobile,
    //         'total_price' => $totalPrice
    //     ]);
    // }


    public function checkout(Request $request)
    {
        $guestData = [
            'first_name' => $request->query('first_name'),
            'last_name' => $request->query('last_name'),
            'email' => $request->query('email'),
            'mobile' => $request->query('mobile'),
        ];
        $settings = DB::table('settings')->get();

        $contact = DB::table('contact_details')->get();
        $roomId = $request->input('room_id');

        $checkIn = Carbon::parse($request->input('check_in'));
        $checkOut = Carbon::parse($request->input('check_out'));
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        $totalPersons = $adults + $children;
        $nights = $checkIn->diffInDays($checkOut); // Calculate the difference in days
        $readonly = $request->input('readonly', false);
        // $room = Room::with('bookings')->findOrFail($roomId);
        $room = Room::with(['roomType'])->findOrFail($roomId);
        $rooms = Room::findOrFail($roomId);
        $roomPrice = $rooms->price; // Access the price of the room
        $totalPrice = $roomPrice * $nights; // Calculate the total price
        $guest = auth()->guard('guest')->check() ? auth()->guard('guest')->user() : null;
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.payment.index', compact('totalPrice', 'nights', 'adults', 'readonly', 'children', 'totalPersons', 'room', 'checkIn', 'checkOut', 'contact', 'settings', 'rooms', 'roomTypes', 'guestData'));
    }
    


    // public function roomDetail($id, $type_name, Request $request)
    // {
    //     $data = "Details";
    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
    //     // Fetch the room by ID
    //     $banner = Banner::where('page_name', 'rooms')->first();
    //     $rooms = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
    //     $contact = DB::table('contact_details')->get();
    //     $checkInDate = $request->input('check_in_date');
    //     $checkOutDate = $request->input('check_out_date');
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $totalPersons = $adults + $children;

    //     $sortBy = $request->get('sort_by', 'price');
    //     $orderBy = $request->get('order_by', 'desc');
    //     if (Str::slug($rooms->roomType->type_name) !== $type_name) {
    //         return redirect()->route('roomDetail', ['id' => $id, 'type_name' => Str::slug($rooms->roomType->type_name)]);
    //     }
    //     $propertys = Room::where('is_deleted', 0)
    //     ->where('status', 1)
    //     ->whereNotIn('id', function ($subQuery) use ($checkInDate) {
    //         $subQuery->select('room_id')
    //             ->from('bookings')
    //             ->whereNotIn('status', ['cancelled', 'checked-out'])
    //             ->whereRaw("'$checkInDate' BETWEEN check_in_date AND check_out_date");
    //     })
    //         ->when($totalPersons > 0, function ($query) use ($totalPersons) {
    //             $query->where('max_person', '>=', $totalPersons);
    //         })
    //         ->orderBy($sortBy, $orderBy)
    //         ->with(['images', 'roomType', 'facilities'])
    //         ->where('id', '!=', $id) // Exclude the current room
    //         ->limit(5)->get(); // Limit the number of rooms to show
    //     // // Optionally check if the slug matches the room type name (optional for better user experience)
    //     if (Str::slug($rooms->roomType->type_name) !== $type_name) {
    //         return redirect()->route('roomDetail', ['id' => $id, 'type_name' => Str::slug($rooms->roomType->type_name)]);
    //     }
    //     return view('frontend.room_detail.index', compact('rooms','checkInDate', 'checkOutDate', 'adults', 'children', 'contact', 'settings', 'banner', 'data', 'roomTypes', 'propertys'));
    // }

    public function roomDetail($id, $type_name, Request $request)
    {
        $data = "Details";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        $banner = Banner::where('page_name', 'rooms')->first();
        $rooms = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
        $contact = DB::table('contact_details')->get();

        // Retrieve query parameters
        $checkInDate = $request->query('check_in_date');
        $checkOutDate = $request->query('check_out_date');
        $adults = $request->query('adults', 0);
        $children = $request->query('children', 0);
        $totalPersons = $adults + $children;

        if (Str::slug($rooms->roomType->type_name) !== $type_name) {
            return redirect()->route('roomDetail', ['id' => $id, 'type_name' => Str::slug($rooms->roomType->type_name)]);
        }

        // Fetch similar properties
        $propertys = Room::where('is_deleted', 0)
            ->where('status', 1)
            ->whereNotIn('id', function ($subQuery) use ($checkInDate) {
                $subQuery->select('room_id')
                    ->from('bookings')
                    ->whereNotIn('status', ['cancelled', 'checked-out'])
                    ->whereRaw("'$checkInDate' BETWEEN check_in_date AND check_out_date");
            })
            ->when($totalPersons > 0, function ($query) use ($totalPersons) {
                $query->where('max_person', '>=', $totalPersons);
            })
            ->limit(5)
            ->with(['images', 'roomType', 'facilities'])
            ->where('id', '!=', $id)
            ->get();

        return view('frontend.room_detail.index', compact('rooms', 'checkInDate', 'checkOutDate', 'adults', 'children', 'contact', 'settings', 'banner', 'data', 'roomTypes', 'propertys'));
    }




    public function service()
    {
        $data = "Service";
        $settings = DB::table('settings')->get();
        $services = DB::table('services')->where('status', 1)->get();
        $banner = Banner::where('page_name', 'service')->first();
        $contact = DB::table('contact_details')->get();

        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.service.index', compact('data', 'banner', 'services', 'contact', 'settings', 'roomTypes'));
    }

    public function gallery()
    {
        $data = "Gallery";
        $settings = DB::table('settings')->get();
        $galleries = DB::table('galleries')->where('status', 1)->get();
        $banner = Banner::where('page_name', 'gallery')->first();
        // $services = DB::table('services')->where('status', 1)->get();
        $contact = DB::table('contact_details')->get();


        // if (!$banner) {
        //     dd('No banner found for services page.');
        // }

        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.gallery.index', compact('data', 'banner', 'galleries', 'contact', 'settings', 'roomTypes'));
    }


    public function meeting()
    {
        $data = "Meeting";
        $settings = DB::table('settings')->get();
        $meetings = Meeting::with('images')->where('availability', 1)->get();
        $banner = Banner::where('page_name', 'meeting')->first();
        $contact = DB::table('contact_details')->get();


        // if (!$banner) {
        //     dd('No banner found for services page.');
        // }

        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.meeting.index', compact('data', 'banner', 'meetings', 'contact', 'settings', 'roomTypes'));
    }

    public function tour()
    {
        $data = "Restaurant";
        $settings = DB::table('settings')->get();
        $tours = Tour::with('images')->get();
        $banner = Banner::where('page_name', 'meeting')->first();
        $contact = DB::table('contact_details')->get();

        // if (!$banner) {
        //     dd('No banner found for services page.');
        // }

        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.tour.index', compact('data', 'banner', 'contact', 'settings', 'roomTypes', 'tours'));
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

    public function bookstore(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits_between:10,15',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_adults' => 'required|integer|min:1',
            'total_children' => 'nullable|integer|min:0',
            'room_type_id' => 'required|integer|exists:room_types,id',
            'payment_option' => 'required|in:pay_now,skip_payment',
        ]);

        $checkInDate = $validatedData['check_in_date'];
        $checkOutDate = $validatedData['check_out_date'];
        $roomTypeId = $validatedData['room_type_id'];

        // Check for available rooms
        $room = Room::where('room_type_id', $request->input('room_type_id'))
            ->where('is_deleted', 0)
            ->where('status', 1)
            ->whereNotIn('id', function ($subQuery) use ($checkInDate, $checkOutDate) {
                $subQuery->select('room_id')
                    ->from('bookings')
                    ->whereNotIn('status', ['cancelled', 'checked-out'])
                    ->where(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                            ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                            ->orWhere(function ($innerQuery) use ($checkInDate, $checkOutDate) {
                                $innerQuery->where('check_in_date', '<=', $checkInDate)
                                    ->where('check_out_date', '>=', $checkOutDate);
                            });
                    });
            })
            ->with('roomType') // Load the RoomType relationship
            ->first();

        if (!$room) {
            return redirect()->back()->withErrors(['message' => 'No available room for the selected room type and dates.']);
        }
        $totalGuests = $request->input('total_adults') + $request->input('total_children', 0);

        if ($totalGuests > $room->max_person) {
            return redirect()->back()->withErrors(['message' => 'The selected room cannot accommodate more than ' . $room->max_person . ' people.']);
        }

        // Calculate total price
        $roomPrice = $room->price; // Assuming `price` is a column in the Room model
        $days = (new \DateTime($checkInDate))->diff(new \DateTime($checkOutDate))->days;
        $totalPrice = $roomPrice * $days;

        // Create a booking record
        $booking = Booking::create([
            'guest_id' => auth()->guard('guest')->check() ? auth()->guard('guest')->id() : null,
            'room_id' => $room->id,
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'status' => 'pending',
            'payment_status' => $validatedData['payment_option'] === 'pay_now' ? 'pending' : 'not_required',
            'total_adults' => $validatedData['total_adults'],
            'total_children' => $validatedData['total_children'] ?? 0,
        ]);

        // Handle payment redirection or success message
        // if ($validatedData['payment_option'] === 'pay_now') {
        //     return redirect()->route('payment.form', ['totalprice' => $totalPrice, 'bookingId' => $booking->id]);
        // }

        if ($validatedData['payment_option'] === 'pay_now') {
            return redirect()->route('payment.form', [
                'totalprice' => $totalPrice
            ])->with(['bookingId' => $booking->id]);
        }


        return redirect()->route('homepage')->with('success', 'Your booking has been created. Please check your email for further details.');
    }





    // public function bookstore(Request $request)
    // {
    //     // Validate incoming request data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'mobile' => 'required|string|max:15',
    //         'email' => 'required|email',
    //         'address' => 'required|string|max:255',
    //         'check_in_date' => 'required|date',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'room_type_id' => 'required|exists:room_types,id',
    //         'total_adults' => 'required|integer|min:1',
    //         'total_children' => 'nullable|integer|min:0',
    //     ]);

    //     // Retrieve a room with the selected room type ID and load the RoomType relationship
    //     // $room = Room::where('room_type_id', $request->input('room_type_id'))
    //     //     ->with('roomType')  // Load the RoomType relationship
    //     //     ->firstOrFail();
    //     $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
    //     $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));

    //     $room = Room::where('is_deleted', 0)
    //     ->where('status', 1)
    //     ->whereNotIn('id', function ($subQuery) use ($checkInDate) {
    //         $subQuery->select('room_id')
    //             ->from('bookings')
    //             ->whereNotIn('status', ['cancelled', 'checked-out'])
    //             ->whereRaw("'$checkInDate' BETWEEN check_in_date AND check_out_date");
    //     })
    //     ->with(['images', 'roomType', 'facilities']); // Eager load relationships

    //     $roomPrice = $room->price;             // Get room price
    //     $roomTypeName = $room->roomType->type_name; // Get room type name from related RoomType


    //     // Calculate total guests (adults + children)
    //     $totalGuests = $request->input('total_adults') + $request->input('total_children', 0);

    //     // Check if the total number of guests exceeds the room's max capacity
    //     if ($totalGuests > $room->max_person) {
    //         return redirect()->back()->withErrors(['message' => 'The selected room cannot accommodate more than ' . $room->max_person . ' people.']);
    //     }
    //     $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
    //     $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));
    //     $numDays = $checkInDate->diffInDays($checkOutDate);
    //     $totalAmount = $numDays * $roomPrice;

    //     // Create a new booking
    //     $booking = new Booking();
    //     $booking->guest_id = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null;
    //     $booking->room_id = $room->id;  // Assign the correct room ID
    //     $booking->check_in_date = $request->input('check_in_date');
    //     $booking->check_out_date = $request->input('check_out_date');
    //     $booking->total_adults = $request->input('total_adults');
    //     $booking->total_children = $request->input('total_children');
    //     $booking->status = 'confirmed';
    //     $booking->payment_status = 'unpaid';
    //     $booking->save();

    //     $notifications = session()->get('notifications', []);
    //     $id = count($notifications) + 1;

    //     $notifications[] = [
    //         'id' => $id,
    //         'type' => 'user_query',
    //         'message' => 'New booking created by Guest ID: ' . $booking->guest_id . ' for Room ID: ' . $booking->room_id,
    //         'time' => now()->format('Y-m-d H:i:s'),
    //     ];

    //     // Store the updated notifications back in the session
    //     session(['notifications' => $notifications]);

    //     // Redirect to confirmation page with additional room info
    //     return redirect()->route('booking.confirmation', [
    //         'id' => $booking->id,
    //         'totalAmount' => $totalAmount,
    //         'roomType' => $roomTypeName,
    //         'roomPrice' => $roomPrice
    //     ])->withSuccess('Your reservation has been made successfully!');
    // }

    //     public function bookstore(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'mobile' => 'required|string|max:15',
    //         'email' => 'required|email',
    //         'address' => 'required|string|max:255',
    //         'check_in_date' => 'required|date|after_or_equal:today',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'room_type_id' => 'required|exists:room_types,id',
    //         'total_adults' => 'required|integer|min:1',
    //         'total_children' => 'nullable|integer|min:0',
    //     ]);

    //     $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
    //     $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));

    //     // Find available room
    //     $room = Room::where('room_type_id', $request->input('room_type_id'))
    //         ->where('is_deleted', 0)
    //         ->where('status', 1)
    //         ->whereNotIn('id', function ($subQuery) use ($checkInDate, $checkOutDate) {
    //             $subQuery->select('room_id')
    //                 ->from('bookings')
    //                 ->whereNotIn('status', ['cancelled', 'checked-out'])
    //                 ->where(function ($query) use ($checkInDate, $checkOutDate) {
    //                     $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
    //                         ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
    //                         ->orWhere(function ($innerQuery) use ($checkInDate, $checkOutDate) {
    //                             $innerQuery->where('check_in_date', '<=', $checkInDate)
    //                                 ->where('check_out_date', '>=', $checkOutDate);
    //                         });
    //                 });
    //         })
    //         ->first();

    //     if (!$room) {
    //         return redirect()->back()->withErrors(['message' => 'No available room for the selected room type and dates.']);
    //     }

    //     // Calculate total guests
    //     $totalGuests = $request->input('total_adults') + $request->input('total_children', 0);
    //     if ($totalGuests > $room->max_person) {
    //         return redirect()->back()->withErrors(['message' => 'The selected room cannot accommodate more than ' . $room->max_person . ' people.']);
    //     }

    //     $roomPrice = $room->price;
    //     $numDays = $checkInDate->diffInDays($checkOutDate);
    //     $totalAmount = $numDays * $roomPrice;

    //     // Create booking
    //     $booking = Booking::create([
    //         'guest_id' => auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null,
    //         'room_id' => $room->id,
    //         'check_in_date' => $request->input('check_in_date'),
    //         'check_out_date' => $request->input('check_out_date'),
    //         'total_adults' => $request->input('total_adults'),
    //         'total_children' => $request->input('total_children'),
    //         'status' => 'confirmed',
    //         'payment_status' => 'unpaid',
    //     ]);

    //     return redirect()->route('payment.form', ['totalprice' => $totalAmount, 'bookingId' => $booking->id]);
    // }



    public function show($room, Request $request)
    {
        $checkInDate = $request->query('check_in');
        $checkOutDate = $request->query('check_out');

        // Fetch room details
        $roomDetails = Room::findOrFail($room);

        return view('booking.show', [
            'room' => $roomDetails,
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
        ]);
    }
}
