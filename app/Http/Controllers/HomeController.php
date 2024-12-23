<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Guest;
use App\Models\Meeting;
use App\Models\RoomType;
use App\Models\Tour;
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
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        $facilities = Facility::getFacility();
        $header_title = "Carousels";
        $contact = DB::table('contact_details')->get();


        return view('frontend.home.index', compact('carousels', 'contact', 'settings', 'rooms', 'about_us', 'roomTypes', 'facilities', 'header_title'));
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

    public function room(Request $request)
{
    $data = "Room";
    $settings = DB::table('settings')->get();
    $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
    $banner = Banner::where('page_name', 'rooms')->first();
    $contact = DB::table('contact_details')->get();

    // Get filtering and sorting criteria
    $checkInDate = $request->input('check_in_date');
    $checkOutDate = $request->input('check_out_date');
    $adults = $request->input('adults', 0);
    $children = $request->input('children', 0);
    $totalPersons = $adults + $children;

    $sortBy = $request->get('sort_by', 'price');
    $orderBy = $request->get('order_by', 'desc');

    // Filter and sort rooms
    $rooms = Room::where('status', 1)
        ->where('is_deleted', 0)
        ->when($checkInDate && $checkOutDate, function ($query) use ($checkInDate, $checkOutDate) {
            $query->whereDoesntHave('bookings', function ($q) use ($checkInDate, $checkOutDate) {
                $q->where('check_in_date', '<', $checkOutDate)
                  ->where('check_out_date', '>', $checkInDate);
            });
        })
        ->when($totalPersons > 0, function ($query) use ($totalPersons) {
            $query->where('max_person', '>=', $totalPersons);
        })
        ->orderBy($sortBy, $orderBy)
        ->with(['images', 'roomType'])
        ->paginate(6);

    if ($request->ajax()) {
        return response()->json(['rooms' => view('frontend.rooms.room_list', compact('rooms'))->render()]);
    }

    return view('frontend.rooms.index', compact(
        'data',
        'rooms',
        'banner',
        'contact',
        'settings',
        'roomTypes',
        'sortBy',
        'orderBy',
        'checkInDate',
        'checkOutDate',
        'adults',
        'children'
    ));
}

//     public function room(Request $request)
// {
//     $data = "Room";
//     $settings = DB::table('settings')->get();
//     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
//     $banner = Banner::where('page_name', 'rooms')->first();
//     $contact = DB::table('contact_details')->get();

//     // Get filter data from the request
//     $checkInDate = $request->input('check_in_date');
//     $checkOutDate = $request->input('check_out_date');
//     $adults = $request->input('adults', 0);
//     $children = $request->input('children', 0);
//     $totalPersons = $adults + $children;

//     // Ensure dates are in the correct format (YYYY-MM-DD)
//     $checkInDate = \Carbon\Carbon::parse($checkInDate)->format('Y-m-d');
//     $checkOutDate = \Carbon\Carbon::parse($checkOutDate)->format('Y-m-d');

//     // Get sort and order from the request or set default
//     $sortBy = $request->get('sort_by', 'price');
//     $orderBy = $request->get('order_by', 'desc');

//     // Query the filtered and sorted rooms
//     $rooms = Room::where('status', 1)
//         ->where('is_deleted', 0)
//         ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
//             $query->where(function ($subQuery) use ($checkInDate, $checkOutDate) {
//                 $subQuery->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
//                          ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
//                          ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
//                              $query->where('check_in_date', '<', $checkInDate)
//                                    ->where('check_out_date', '>', $checkOutDate);
//                          });
//             });
//         })
//         ->where('max_person', '>=', $totalPersons)
//         ->orderBy($sortBy, $orderBy) // Apply sorting
//         ->with(['images', 'roomType'])
//         ->paginate(3); // Adjust the pagination value as needed

//     // Return the rooms section as part of the AJAX response
//     if ($request->ajax()) {
//         return response()->json(['rooms' => view('frontend.rooms.room_list', compact('rooms'))->render()]);
//     }

//     // For regular requests, return the full view
//     return view('frontend.rooms.index', compact('data', 'rooms', 'banner', 'contact', 'settings', 'roomTypes', 'sortBy', 'orderBy'));
// }
    

    // public function filterRooms(Request $request)
    // {
    //     $checkInDate = $request->input('check_in_date');
    //     $checkOutDate = $request->input('check_out_date');
    //     $adults = $request->input('adults');
    //     $children = $request->input('children');

    //     $totalPersons = $adults + $children;

    //     $rooms = Room::where('status', 1)
    //         ->where('is_deleted', 0)
    //         ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
    //             $query->where('check_in_date', '<', $checkOutDate)
    //                   ->where('check_out_date', '>', $checkInDate);
    //         })
    //         ->where('max_person', '>=', $totalPersons)
    //         ->with(['images', 'roomType'])
    //         ->get();

    //     if ($request->ajax()) {
    //         return view('frontend.rooms.room_list', compact('rooms'))->render();
    //     }

    //     $settings = DB::table('settings')->get();
    //     $contact = DB::table('contact_details')->get();

    //     return view('frontend.rooms.index', compact(
    //         'rooms', 
    //         'checkInDate', 
    //         'checkOutDate', 
    //         'adults', 
    //         'children', 
    //         'settings', 
    //         'contact'
    //     ));
    // }

    // public function filterRooms(Request $request)
    // {
    //     $checkInDate = $request->input('check_in_date');
    //     $checkOutDate = $request->input('check_out_date');
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);

    //     $totalPersons = $adults + $children;

    //     // Validate the date inputs to avoid null values in the query
    //     if (!$checkInDate || !$checkOutDate) {
    //         return response()->json(['error' => 'Both check-in and check-out dates are required'], 400);
    //     }

    //     try {
    //         $rooms = Room::where('status', 1)
    //             ->where('is_deleted', 0)
    //             ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
    //                 $query->where('check_in_date', '<', $checkOutDate)
    //                     ->where('check_out_date', '>', $checkInDate);
    //             })
    //             ->where('max_person', '>=', $totalPersons)
    //             ->with(['images', 'roomType'])
    //             ->get();

    //         if ($request->ajax()) {
    //             return view('frontend.rooms.room_list', compact('rooms'))->render();
    //         }

    //         $settings = DB::table('settings')->get();
    //         $contact = DB::table('contact_details')->get();

    //         return view('frontend.rooms.index', compact(
    //             'rooms',
    //             'checkInDate',
    //             'checkOutDate',
    //             'adults',
    //             'children',
    //             'settings',
    //             'contact'
    //         ));
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function filterRooms(Request $request)
{
    $checkInDate = $request->input('check_in_date');
    $checkOutDate = $request->input('check_out_date');
    $adults = $request->input('adults', 0);
    $children = $request->input('children', 0);
    $totalPersons = $adults + $children;

    $rooms = Room::where('status', 1)
        ->where('is_deleted', 0)
        ->when($checkInDate && $checkOutDate, function ($query) use ($checkInDate, $checkOutDate) {
            $query->whereDoesntHave('bookings', function ($q) use ($checkInDate, $checkOutDate) {
                $q->where('check_in_date', '<', $checkOutDate)
                  ->where('check_out_date', '>', $checkInDate);
            });
        })
        ->where('max_person', '>=', $totalPersons)
        ->with(['images', 'roomType'])
        ->paginate(6);

    return view('frontend.rooms.room_list', compact('rooms'))->render();
}

public function sortRooms(Request $request)
{
    $sortBy = $request->get('sort_by', 'price');
    $orderBy = $request->get('order_by', 'asc');

    $rooms = Room::where('status', 1)
        ->where('is_deleted', 0)
        ->orderBy($sortBy, $orderBy)
        ->with(['images', 'roomType'])
        ->paginate(6);

    return response()->json([
        'rooms' => view('frontend.rooms.room_list', compact('rooms'))->render()
    ]);
}













    // public function filterRooms(Request $request)
    // {
    //     $checkInDate = $request->input('check_in_date');
    //     $checkOutDate = $request->input('check_out_date');
    //     $adults = (int) $request->input('adults', 0);
    //     $children = (int) $request->input('children', 0);

    //     $totalPersons = $adults + $children;

    //     // Validate the date inputs to ensure no null values
    //     if (empty($checkInDate) || empty($checkOutDate)) {
    //         return response()->json([
    //             'error' => 'Both check-in and check-out dates are required'
    //         ], 400);
    //     }

    //     try {
    //         // Fetch available rooms
    //         $rooms = Room::where('status', 1)
    //             ->where('is_deleted', 0)
    //             ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
    //                 $query->where('check_in_date', '<', $checkOutDate)
    //                       ->where('check_out_date', '>', $checkInDate);
    //             })
    //             ->where('max_person', '>=', $totalPersons)
    //             ->with([
    //                 'images',
    //                 'roomType',
    //                 'bookings' => function ($query) use ($checkInDate, $checkOutDate) {
    //                     $query->where('check_in_date', '<', $checkOutDate)
    //                           ->where('check_out_date', '>', $checkInDate);
    //                 }
    //             ])
    //             ->get();

    //         if ($request->ajax()) {
    //             return view('frontend.rooms.room_list', compact('rooms'))->render();
    //         }

    //         $settings = DB::table('settings')->get();
    //         $contact = DB::table('contact_details')->get();

    //         return view('frontend.rooms.index', compact(
    //             'rooms',
    //             'checkInDate',
    //             'checkOutDate',
    //             'adults',
    //             'children',
    //             'settings',
    //             'contact'
    //         ));
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'An unexpected error occurred: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }







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

    public function roomDetail($id, $type_name)
    {
        $data = "Details";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        // Fetch the room by ID
        $banner = Banner::where('page_name', 'rooms')->first();
        $rooms = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
        $contact = DB::table('contact_details')->get();
        // Optionally check if the slug matches the room type name (optional for better user experience)
        if (Str::slug($rooms->roomType->type_name) !== $type_name) {
            return redirect()->route('roomDetail', ['id' => $id, 'type_name' => Str::slug($rooms->roomType->type_name)]);
        }

        return view('frontend.room_detail.index', compact('rooms', 'contact', 'settings', 'banner', 'data', 'roomTypes'));
    }


    public function service()
    {
        $data = "Service";
        $settings = DB::table('settings')->get();
        $services = DB::table('services')->where('status', 1)->get();
        $banner = Banner::where('page_name', 'service')->first();
        $contact = DB::table('contact_details')->get();


        // if (!$banner) {
        //     dd('No banner found for services page.');
        // }

        // Fetch only the specific room types you want to display
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
}
