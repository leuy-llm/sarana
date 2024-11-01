<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    //
    // function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function reservation()
    {

        $data = "Reservation";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.booking.index', compact('data', 'settings', 'roomTypes'));
    }

    // public function store(Request $request)
    // {
    //     // Step 1: Validate the request data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'mobile' => 'required|string|max:15',
    //         'address' => 'required|string|max:255',
    //         'room_type_id' => 'required|integer',
    //         'check_in_date' => 'required|date|after_or_equal:today',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'total_adults' => 'required|integer|min:1',
    //         'total_children' => 'nullable|integer|min:0',
    //     ]);

    //     // Step 2: Create or find the guest using their details
    //     // $guest = Guest::firstOrCreate(
    //     //     ['email' => $request->input('email')], // Search by email to prevent duplicates
    //     //     [
    //     //         'name' => $request->input('name'),
    //     //         'mobile' => $request->input('mobile'),
    //     //         'address' => $request->input('address')
    //     //     ]
    //     // );

    //     // Log::info('Guest created or found: ', ['guest_id' => $guest->id]);
    //     // // Step 2.1: Store guest details in the session
    //     // // session([
    //     // //     'name' => $guest->name,          // Use $guest->name to ensure it's correctly saved
    //     // //     'email' => $guest->email,
    //     // //     'mobile' => $guest->mobile,       // Assuming the correct key is 'mobile'
    //     // //     'address' => $guest->address
    //     // // ]);
    //     // Log::info('Guest information stored in session.');

    //     // Step 3: Get the selected room type and check-in/check-out dates
    //     $roomTypeId = $request->input('room_type_id');
    //     $checkInDate = $request->input('check_in_date');
    //     $checkOutDate = $request->input('check_out_date');

    //     // Step 4: Find the first available room of the selected type
    //     $room = DB::table('rooms')
    //         ->where('room_type_id', $roomTypeId)
    //         ->where('is_deleted', '=', 0)
    //         ->whereNotIn('id', function ($query) use ($checkInDate, $checkOutDate) {
    //             $query->select('room_id')
    //                 ->from('bookings')
    //                 ->whereRaw("'$checkInDate' BETWEEN check_in_date AND check_out_date")
    //                 ->orWhereRaw("'$checkOutDate' BETWEEN check_in_date AND check_out_date");
    //         })
    //         ->first();

    //     if (!$room) {
    //         Log::error('No available rooms for the selected dates', [
    //             'room_type_id' => $roomTypeId,
    //             'check_in_date' => $checkInDate,
    //             'check_out_date' => $checkOutDate,
    //         ]);
    //         return redirect()->back()->with('error', 'No available rooms for the selected dates.');
    //     }

    //     Log::info('Room found for booking: ', ['room_id' => $room->id]);

    //     // Step 5: Proceed to create the booking with the assigned room and guest information
    //     try {
    //         $booking = Booking::create([
    //             'guest_id' => $guest->id, // Use the guest's ID here
    //             'room_id' => $room->id,
    //             'check_in_date' => $checkInDate,
    //             'check_out_date' => $checkOutDate,
    //             'total_adults' => $request->input('total_adults'),
    //             'total_children' => $request->input('total_children'),
    //             'status' => 'pending',
    //             'payment_status' => 'unpaid',
    //         ]);

    //         Log::info('Booking created successfully: ', ['booking_id' => $booking->id]);
    //     } catch (\Exception $e) {
    //         Log::error('Error creating the booking: ', ['error' => $e->getMessage()]);
    //         return redirect()->back()->with('error', 'Error creating the booking: ' . $e->getMessage());
    //     }

    //     return redirect()->route('reservation')->with('success', 'Booking created successfully.')->withInput();
    // }
    // public function store(Request $request)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'mobile' => 'required|numeric',
    //         'email' => 'required|email',
    //         'address' => 'required|string',
    //         'check_in_date' => 'required|date',
    //         'check_out_date' => 'required|date',
    //         'room_type_id' => 'required|integer',
    //         'total_adults' => 'required|integer',
    //         'total_children' => 'required|integer'
    //     ]);

    //     // Store reservation data
    //     $reservation = Booking::create($validatedData);

    //     // Redirect to the payment form with totalAmount
    //     $totalAmount = $this->calculateTotalAmount($validatedData['room_type_id'], $validatedData['check_in_date'], $validatedData['check_out_date']);

    //     return redirect()->route('payment.process', $totalAmount);
    // }

    // // Assuming you have a room price logic in place
    // private function calculateTotalAmount($roomTypeId, $checkIn, $checkOut)
    // {
    //     // Example logic for calculating the total amount
    //     $roomPrice = 100; // Fetch room price from database based on $roomTypeId
    //     $days = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
    //     return $roomPrice * $days;
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'guest_id' => 'required|exists:guests,id',
    //         'room_id' => 'required|exists:rooms,id',
    //         'check_in_date' => 'required|date|after_or_equal:today',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'total_adults' => 'required|integer|min:1',
    //         'total_children' => 'nullable|integer|min:0',
    //         'status' => 'required',
    //     ]);


    //     $booking = new Booking();
    //     $booking->guest_id = auth()->guard('guest')->id();
    //     $booking->room_id = $request->room_id;
    //     $booking->check_in_date = $request->check_in_date;
    //     $booking->check_out_date = $request->check_out_date;
    //     $booking->total_adults = $request->total_adults;
    //     $booking->total_children = $request->total_children;
    //     $booking->status = "pending";
    //     $booking->payment_status = "unpaid";  // Default value for unpaid reservations
    //     $booking->save();

    //     return redirect()->route('reservation')->with('success', 'Booking created successfully');

    // }
    // public function store(Request $request,$totalAmount)
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

    //     // Create a new booking
    //     $booking = new Booking();
    //     $booking->guest_id = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null; // Assign guest ID if logged in
    //     $booking->room_id = $request->input('room_type_id'); // Assuming room_id here refers to room_type_id
    //     $booking->check_in_date = $request->input('check_in_date');
    //     $booking->check_out_date = $request->input('check_out_date');
    //     $booking->total_adults = $request->input('total_adults');
    //     $booking->total_children = $request->input('total_children');
    //     $booking->status = 'pending';  // Initial booking status
    //     $booking->payment_status = 'unpaid'; // Mark as unpaid initially
    //     $booking->save();

    //     // Redirect back or to the booking confirmation page
    //     // Redirect back to confirmation page with total amount
    //     return redirect()->route('booking.confirmation', ['id' => $booking->id, 'totalAmount' => $totalAmount])
    // ->with('success', 'Your reservation has been made, and you can complete payment later.');
    // }
    //     public function store(Request $request)
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

    // // Get the room price based on the room type ID
    // $roomPrice = Room::findOrFail($request->input('room_type_id'))->price; // Assuming RoomType has the price field

    // // Create Carbon instances for check-in and check-out dates
    // $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
    // $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));

    // // Calculate the number of days between check-in and check-out dates
    // $numDays = $checkInDate->diffInDays($checkOutDate); // This will return the correct number of days

    // // Calculate the total amount
    // $totalAmount = $numDays > 0 ? ceil($numDays * $roomPrice) : 0; // Use ceil if necessary

    //     // Create a new booking
    //     $booking = new Booking();
    //     $booking->guest_id = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null; // Assign guest ID if logged in
    //     $booking->room_id = $request->input('room_type_id'); // Assuming room_id here refers to room_type_id
    //     $booking->check_in_date = $request->input('check_in_date');
    //     $booking->check_out_date = $request->input('check_out_date');
    //     $booking->total_adults = $request->input('total_adults');
    //     $booking->total_children = $request->input('total_children');
    //     $booking->status = 'pending';  // Initial booking status
    //     $booking->payment_status = 'unpaid'; // Mark as unpaid initially
    //     $booking->save();

    //     // Redirect back to the booking confirmation page with total amount
    //     return redirect()->route('booking.confirmation', ['id' => $booking->id, 'totalAmount' => $totalAmount])
    //         ->with('success', 'Your reservation has been made, and you can complete payment later.');
    // }
    // public function store(Request $request)
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

    //     // Calculate the total amount based on room price and number of days
    //     $room = Room::where('room_type_id', $request->input('room_type_id'))->firstOrFail();
    //     $roomPrice = $room->price; // Get room price
    //     $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
    //     $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));
    //     $numDays = $checkInDate->diffInDays($checkOutDate); // Calculate number of days

    //     // Calculate total amount
    //     $totalAmount = $numDays * $roomPrice; 
    //     // Create a new booking
    //     $booking = new Booking();
    //     $booking->guest_id = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null; // Assign guest ID if logged in
    //     $booking->room_id = $room->id; // Set the room ID
    //     $booking->check_in_date = $request->input('check_in_date');
    //     $booking->check_out_date = $request->input('check_out_date');
    //     $booking->total_adults = $request->input('total_adults');
    //     $booking->total_children = $request->input('total_children');
    //     $booking->status = 'pending';  // Initial booking status
    //     $booking->payment_status = 'unpaid'; // Mark as unpaid initially
    //     $booking->save();

    //     // Redirect to the booking confirmation page with total amount
    //     return redirect()->route('booking.confirmation', ['id' => $booking->id, 'totalAmount' => $totalAmount])
    //         ->with('success', 'Your reservation has been made, and you can complete payment later.');
    // }

    // public function store(Request $request)
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
    //         'total_amount' => 'required|numeric|min:0', // New validation for total amount
    //     ]);

    //     // Create a new booking
    //     $booking = new Booking();
    //     $booking->guest_id = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null;
    //     $booking->room_id = $request->input('room_type_id');
    //     $booking->check_in_date = $request->input('check_in_date');
    //     $booking->check_out_date = $request->input('check_out_date');
    //     $booking->total_adults = $request->input('total_adults');
    //     $booking->total_children = $request->input('total_children');
    //     $booking->status = 'pending';
    //     $booking->payment_status = 'unpaid';
    //     $booking->save();

    //     // Redirect to confirmation page with additional room info and use the total amount from the form
    //     return redirect()->route('booking.confirmation', [
    //         'id' => $booking->id,
    //         'totalAmount' => $request->input('total_amount'), // Pass the form total amount
    //         'roomType' => $booking->room->roomType->type_name,
    //         'roomPrice' => $booking->room->price,
    //     ])->with('success', 'Your reservation has been made, and you can complete payment later.');
    // }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'room_type_id' => 'required|exists:room_types,id',
            'total_adults' => 'required|integer|min:1',
            'total_children' => 'nullable|integer|min:0',
        ]);

        // Retrieve a room with the selected room type ID and load the RoomType relationship
        $room = Room::where('room_type_id', $request->input('room_type_id'))
            ->with('roomType')  // Load the RoomType relationship
            ->firstOrFail();

        $roomPrice = $room->price;             // Get room price
        $roomTypeName = $room->roomType->type_name; // Get room type name from related RoomType

        // Convert check-in and check-out dates to Carbon instances
        $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
        $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));

        // Calculate the number of days between check-in and check-out
        $numDays = $checkInDate->diffInDays($checkOutDate);

        // Calculate total amount based on number of days and room price
        $totalAmount = $numDays * $roomPrice;

        // Create a new booking
        $booking = new Booking();
        $booking->guest_id = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null;
        $booking->room_id = $room->id;  // Assign the correct room ID
        $booking->check_in_date = $request->input('check_in_date');
        $booking->check_out_date = $request->input('check_out_date');
        $booking->total_adults = $request->input('total_adults');
        $booking->total_children = $request->input('total_children');
        $booking->status = 'pending';
        $booking->payment_status = 'unpaid';
        $booking->save();

        // Redirect to confirmation page with additional room info
        return redirect()->route('booking.confirmation', [
            'id' => $booking->id,
            'totalAmount' => $totalAmount,
            'roomType' => $roomTypeName,
            'roomPrice' => $roomPrice
        ])->with('success', 'Your reservation has been made, and you can complete payment later.');
    }








    public function confirmation(Request $request, $id)
{
    $booking = Booking::findOrFail($id);
    $data = "Booking Confirmed!";
    $settings = DB::table('settings')->get();
    $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

    // Retrieve total amount and room details from the request
    $totalAmount = $request->get('totalAmount');
    $roomType = $request->get('roomType');
    $roomPrice = $request->get('roomPrice');

    // Check if the user is authenticated
    $guest = auth()->guard('guest')->user(); // Get the authenticated guest user, or null if not authenticated

    return view('frontend.booking.success', compact('booking', 'data', 'settings', 'roomTypes', 'totalAmount', 'roomType', 'roomPrice', 'guest'));
}

}
