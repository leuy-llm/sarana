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
        $galleries = DB::table('galleries')->where('status', 1)->get();

        return view('frontend.home.index', compact('carousels','galleries','contact', 'settings', 'rooms', 'about_us', 'roomTypes', 'facilities', 'header_title'));
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
        // $sortBy = $request->get('sort_by', 'price');
        // $orderBy = $request->get('order_by', 'desc');

        // $query->orderBy($sortBy, $orderBy);
        $query->with(['images', 'roomType']);

        if ($checkIn && $checkOut) {
            $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where('check_in_date', '<', $checkOut)
                    ->where('check_out_date', '>', $checkIn);
            });
        } else {
            $query->whereDoesntHave('bookings', function ($q) {
                $q->where('check_out_date', '>=', now());
            });
        }

        $rooms = $query->paginate(10); // Adjust per page as needed for testing
        $rooms->appends($request->all()); // Append query parameters to pagination links
        return view('frontend.rooms.index', compact('rooms', 'data', 'banner', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children'));
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
    //     $checkIn = $request->input('check_in');
    //     $checkOut = $request->input('check_out');
    //     $adults = $request->input('adults', 0);
    //     $children = $request->input('children', 0);
    //     $totalPersons = $adults + $children;

    //     $rooms = Room::where('status', 1)
    //         ->where('is_deleted', 0)
    //         ->when($checkIn && $checkOut, function ($query) use ($checkIn, $checkOut) {
    //             $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
    //                 $q->where('check_in_date', '<', $checkOut)
    //                     ->where('check_out_date', '>', $checkIn);
    //             });
    //         })
    //         ->where('max_person', '>=', $totalPersons)
    //         ->with(['images', 'roomType'])
    //         ->get();

    //     return view('frontend.rooms.room_list', compact('rooms'))->render();
    // }





    public function filterRooms(Request $request)
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
    $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

   
    $query = Room::where('is_deleted', 0)
    ->where('status', 1)
    ->whereNotIn('id', function ($subQuery) use ($checkIn) {
        $subQuery->select('room_id')
            ->from('bookings')
            ->whereNotIn('status', ['cancelled', 'checked-out'])
            ->whereRaw("'$checkIn' BETWEEN check_in_date AND check_out_date");
    })
    ->with(['images', 'roomType', 'facilities']); // Eager load relationships



    // Filter by maximum capacity
    $query->where('max_person', '>=', $totalPersons);

    // Filter by price range
    $query->whereBetween('price', [$priceMin, $priceMax]);

    // Paginate results
    $rooms = $query->paginate(10);
    $rooms->appends($request->all());

    return view('frontend.rooms.room_list', compact('rooms', 'data', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children'));
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
    public function createBooking(Request $request)
    {
        $data = "Reservation";
        $settings = DB::table('settings')->get();
        $banner = Banner::where('page_name', 'booking')->first();
        $contact = DB::table('contact_details')->get();
        $roomId = $request->input('room_id');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        $totalPersons = $adults + $children;
        $readonly = $request->input('readonly', false);
        
        // $room = Room::with('bookings')->findOrFail($roomId);
        $room = Room::with(['roomType'])->findOrFail($roomId);
        $rooms = Room::findOrFail($roomId);
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.booking.bookings', compact('data','adults','readonly','children','totalPersons','room','checkIn','checkOut','banner', 'contact', 'settings', 'rooms', 'roomTypes'));
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
    //     $room = Room::where('room_type_id', $request->input('room_type_id'))
    //         ->with('roomType')  // Load the RoomType relationship
    //         ->firstOrFail();

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

    public function bookstore(Request $request)
{
    // Validate incoming request data
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'mobile' => 'required|string|max:15',
    //     'email' => 'required|email',
    //     'address' => 'required|string|max:255',
    //     'check_in_date' => 'required|date',
    //     'check_out_date' => 'required|date|after:check_in_date',
    //     'room_type_id' => 'required|exists:room_types,id',
    //     'total_adults' => 'required|integer|min:1',
    //     'total_children' => 'nullable|integer|min:0',
    // ]);

    $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
        'email' => 'required|email',
        'address' => 'required|string|max:255',
        'check_in_date' => 'required|date|after_or_equal:today',
        'check_out_date' => 'required|date|after:check_in_date',
        'room_type_id' => 'required|exists:room_types,id',
        'total_adults' => 'required|integer|min:1',
        'total_children' => 'nullable|integer|min:0',
    ]);
    

    $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
    $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));

    // Fetch an available room with the selected room type
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

    // If no available room is found, return an error
    if (!$room) {
        return redirect()->back()->withErrors(['message' => 'No available room for the selected room type and dates.']);
    }

    $roomPrice = $room->price;             // Get room price
    $roomTypeName = $room->roomType->type_name; // Get room type name from related RoomType

    // Calculate total guests (adults + children)
    $totalGuests = $request->input('total_adults') + $request->input('total_children', 0);

    // Check if the total number of guests exceeds the room's max capacity
    if ($totalGuests > $room->max_person) {
        return redirect()->back()->withErrors(['message' => 'The selected room cannot accommodate more than ' . $room->max_person . ' people.']);
    }

    // Calculate the number of days and total amount
    $numDays = $checkInDate->diffInDays($checkOutDate);
    $totalAmount = $numDays * $roomPrice;

    // Create a new booking
    $booking = new Booking();
    $booking->guest_id = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null;
    $booking->room_id = $room->id;  // Assign the correct room ID
    $booking->check_in_date = $request->input('check_in_date');
    $booking->check_out_date = $request->input('check_out_date');
    $booking->total_adults = $request->input('total_adults');
    $booking->total_children = $request->input('total_children');
    
    $booking->status = 'confirmed';
    $booking->payment_status = 'unpaid';
    $booking->save();

    // Add a notification for the new booking
    $notifications = session()->get('notifications', []);
    $id = count($notifications) + 1;

    $notifications[] = [
        'id' => $id,
        'type' => 'user_query',
        'message' => 'New booking created by Guest ID: ' . $booking->guest_id . ' for Room ID: ' . $booking->room_id,
        'time' => now()->format('Y-m-d H:i:s'),
    ];

    // Store the updated notifications back in the session
    session(['notifications' => $notifications]);

    // Redirect to confirmation page with additional room info
    return redirect()->route('booking.confirmation', [
        'id' => $booking->id,
        'totalAmount' => $totalAmount,
        'roomType' => $roomTypeName,
        'roomPrice' => $roomPrice,
        'readonly' => $request->has('readonly'), // Set to true if readonly mode is required
    ])->withSuccess('Your reservation has been made successfully!');
}


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


