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


    public function rooms(Request $request)
    {
        $data = "Reservation";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::getRoomType();
        $banner = Banner::where('page_name', 'booking')->first(); // Fetch the banner
        $contact = DB::table('contact_details')->get();
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $query = Room::query()->where('status', 1)->where('is_deleted', 0);
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        $totalPersons = $adults + $children;
        $sortBy = $request->get('sort_by', 'price');
        $orderBy = $request->get('order_by', 'desc');
        $query->with(['images', 'roomType', 'facilities']);
        
        $viewTypes = Room::select('view_type')->distinct()->pluck('view_type');

        $rooms = $query->paginate(10); // Adjust per page as needed for testing
        $rooms->appends($request->all()); // Append query parameters to pagination links
        return view('frontend.rooms.index', compact(
            'rooms',
            'data',
            'banner',
            'contact',
            'settings',
            'roomTypes',
            'checkIn',
            'checkOut',
            'adults',
            'children',
            'totalPersons',
            'sortBy',
            'orderBy',
            'viewTypes'
        ));
    }

    public function roomindex(Request $request)
    {
        $data = "Room Page";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::getRoomType();
        $banner = Banner::where('page_name', 'rooms')->first();
        $contact = DB::table('contact_details')->get();
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $query = Room::query()->where('status', 1)->where('is_deleted', 0);
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        $totalPersons = $adults + $children;
        $query->with(['images', 'roomType']);

        $rooms = $query->paginate(10); // Adjust per page as needed for testing
        $rooms->appends($request->all()); // Append query parameters to pagination links
        return view('frontend.rooms.room', compact('rooms', 'data', 'banner', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children'));
    }

    public function food()
    {
        $data = "Food & Drinks";
        $settings = DB::table('settings')->get();
        $contact = DB::table('contact_details')->get();
        $banner = Banner::where('page_name', 'restaurants')->first();
        $foodItems = Restaurant::all();
        return view('frontend.food.index', compact('data', 'banner', 'contact', 'settings', 'foodItems'));
    }

    public function Roomfilter(Request $request)
    {
        try {
        $data = "Experience Luxury Stay";
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $adults = (int) $request->input('adults', 0);
        $children = (int) $request->input('children', 0);
        $priceMin = (int) $request->input('price_min', 50);
        $priceMax = (int) $request->input('price_max', 5000);
        $totalPersons = $adults + $children;
        $banner = Banner::where('page_name', 'booking')->first();
        $contact = DB::table('contact_details')->get();
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::getRoomType();

        $query = Room::where('is_deleted', 0)
            ->where('status', 1)
            ->whereNotIn('id', function ($subQuery) use ($checkIn, $checkOut) {
                $subQuery->select('room_id')
                    ->from('booking_rooms')
                    ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
                    ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
                    ->whereRaw("? BETWEEN bookings.check_in_date AND bookings.check_out_date", [$checkIn]);
            })
            ->where('max_person', '>=', $totalPersons)
            ->whereBetween('price', [$priceMin, $priceMax])
            ->with(['images', 'roomType', 'facilities']);

            if ($request->has('room_type') && $request->room_type != '') {
                $query->whereHas('roomType', function($query) use ($request) {
                    $query->where('type_name', $request->room_type); // Match by type name
                });
            }

            if($request->has('facilities') && $request->facilities != '') {
                $query->whereHas('facilities', function($query) use ($request) {
                    $query->whereIn('id', $request->facilities);
                });
            }

            if ($request->has('view_type') && !empty($request->view_type)) {
                $query->whereIn('view_type', $request->view_type);
            }
            $viewTypes = Room::select('view_type')->distinct()->pluck('view_type');
            if ($request->ajax()) {
                $rooms = $query->paginate(10);
                return view('frontend.rooms.room_list', compact('rooms'));
            }

        $rooms = $query->paginate(10);
        $rooms->appends($request->all());
        return view('frontend.rooms.index', compact(
            'rooms',
            'contact',
            'settings',
            'roomTypes',
            'data',
            'checkIn',
            'checkOut',
            'adults',
            'children',
            'priceMin',
            'priceMax',
            'banner',
            'viewTypes'
        ));
        }catch (\Exception $e) {
            // Log error for debugging
            Log::error('Error in Roomfilter method: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    public function modalfilter(Request $request)
    {
        $rooms = Room::with('images', 'roomType')
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->get(); // No need to filter based on query parameters for the modal

        // Return the modal view without passing any query parameters
        return view('frontend.booking.filtermodal', compact('rooms'));
    }

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
        $data = "Contact Page";
        $settings = DB::table('settings')->get();
        $contact = DB::table('contact_details')->get();
        $banner = Banner::where('page_name', 'contact_details')->first();

        // Debug output to check banner data
        if (!$banner) {
            dd('No banner found for contact page.');
        }
        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::getRoomType();

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
        $contact = DB::table('contact_details')->get();

        // Parse the rooms and decode adults and children JSON strings
        $rooms = explode(',', $request->input('rooms'));
        $adults = json_decode($request->input('adults'), true); // Decode the JSON to associative array
        $children = json_decode($request->input('children'), true); // Decode the JSON to associative array

        $request->merge(['rooms' => $rooms]);

        // Validate the request
        $request->validate([
            'check_in' => 'required|date|before:check_out',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|array|min:1',
            'rooms.*' => 'exists:rooms,id',
        ]);

        $checkIn = Carbon::parse($request->input('check_in'));
        $checkOut = Carbon::parse($request->input('check_out'));
        $nights = $checkIn->diffInDays($checkOut);

        $selectedRooms = Room::with('roomType')->whereIn('id', $rooms)->get();
        $totalPrice = $selectedRooms->sum(function ($room) use ($nights) {
            return ($room->special_price ?? $room->price) * $nights;
        });

        // Attach adults and children to rooms
        $roomDetails = $selectedRooms->map(function ($room) use ($adults, $children) {
            return [
                'room' => $room,
                'adults' => $adults[$room->id] ?? 0,
                'children' => $children[$room->id] ?? 0,
            ];
        });

        return view('frontend.booking.bookings', [
            'rooms' => $roomDetails,
            'totalPrice' => $totalPrice,
            'nights' => $nights,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'adults' => $adults,
            'children' => $children,
            'contact' => $contact,
        ]);
    }


    public function filterRooms(Request $request)
    {
        $query = Room::query();

        // Price Filter
        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        // Room Type Filter
        if ($request->has('roomTypes')) {
            $query->whereIn('room_type', $request->roomTypes);
        }

        // View Filter
        if ($request->has('views')) {
            $query->whereIn('view', $request->views);
        }

        // Facilities Filter
        if ($request->has('facilities')) {
            // Assuming you have a pivot table for facilities or a direct relationship
            $query->whereHas('facilities', function ($q) use ($request) {
                $q->whereIn('facility_id', $request->facilities);
            });
        }
        // Get the filtered rooms
        $rooms = $query->get();

        // Return the updated room listings (this can be a partial view)
        return view('frontend.rooms.room-list', compact('rooms')); // Adjust with your actual view path
    }


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

    public function roomDetail($id, $type_name, Request $request)
    {
        $data = "Room Details";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::getRoomType();
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
        // $propertys = Room::where('is_deleted', 0)
        //     ->where('status', 1)
        //     ->whereNotIn('id', function ($subQuery) use ($checkInDate) {
        //         $subQuery->select('room_id')
        //             ->from('bookings')
        //             ->whereNotIn('status', ['cancelled', 'checked-out'])
        //             ->whereRaw("'$checkInDate' BETWEEN check_in_date AND check_out_date");
        //     })
        //     ->when($totalPersons > 0, function ($query) use ($totalPersons) {
        //         $query->where('max_person', '>=', $totalPersons);
        //     })
        //     ->limit(5)
        $propertys = Room::where('is_deleted', 0)
            ->where('status', 1)
            ->with(['images', 'roomType', 'facilities'])
            ->where('id', '!=', $id)
            ->get();

        return view('frontend.room_detail.index', compact('rooms', 'checkInDate', 'checkOutDate', 'adults', 'children', 'contact', 'settings', 'banner', 'data', 'roomTypes', 'propertys'));
    }




    public function service()
    {
        $data = "Service Page";
        $settings = DB::table('settings')->get();
        $services = DB::table('services')->where('status', 1)->get();
        $banner = Banner::where('page_name', 'service')->first();
        $contact = DB::table('contact_details')->get();

        $roomTypes = RoomType::getRoomType();

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
        $data = "Meeting Page";
        $settings = DB::table('settings')->get();
        $meetings = Meeting::with('images')->where('availability', 1)->get();
        $banner = Banner::where('page_name', 'meetings')->first();
        $contact = DB::table('contact_details')->get();


        // if (!$banner) {
        //     dd('No banner found for services page.');
        // }

        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::getRoomType();

        return view('frontend.meeting.index', compact('data', 'banner', 'meetings', 'contact', 'settings', 'roomTypes'));
    }

    public function tour()
    {
        $data = "Tours Page";
        $settings = DB::table('settings')->get();
        $tours = Tour::with('images')->get();
        $banner = Banner::where('page_name', 'tours')->first();
        $contact = DB::table('contact_details')->get();

        // if (!$banner) {
        //     dd('No banner found for services page.');
        // }

        // Fetch only the specific room types you want to display
        $roomTypes = RoomType::getRoomType();

        return view('frontend.tour.index', compact('data', 'banner', 'contact', 'settings', 'roomTypes', 'tours'));
    }

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
