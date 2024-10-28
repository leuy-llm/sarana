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
    public function reservation()
    {

        $data = "Reservation";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        return view('frontend.booking.index', compact('data', 'settings', 'roomTypes'));
    }

    public function store(Request $request)
    {
        // Step 1: Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'room_type_id' => 'required|integer',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_adults' => 'required|integer|min:1',
            'total_children' => 'nullable|integer|min:0',
        ]);

        // Step 2: Create or find the guest using their details
        $guest = Guest::firstOrCreate(
            ['email' => $request->input('email')], // Search by email to prevent duplicates
            [
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'address' => $request->input('address')
            ]
        );
       
        Log::info('Guest created or found: ', ['guest_id' => $guest->id]);

        // Step 2.1: Store guest details in the session
    session([
        'guest_name' => $guest->name,          // Use $guest->name to ensure it's correctly saved
        'guest_email' => $guest->email,
        'guest_phone' => $guest->mobile,       // Assuming the correct key is 'mobile'
        'guest_address' => $guest->address
    ]);
    Log::info('Guest information stored in session.');

        // Step 3: Get the selected room type and check-in/check-out dates
        $roomTypeId = $request->input('room_type_id');
        $checkInDate = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');

        // Step 4: Find the first available room of the selected type
        $room = DB::table('rooms')
            ->where('room_type_id', $roomTypeId)
            ->where('is_deleted', '=', 0)
            ->whereNotIn('id', function ($query) use ($checkInDate, $checkOutDate) {
                $query->select('room_id')
                    ->from('bookings')
                    ->whereRaw("'$checkInDate' BETWEEN check_in_date AND check_out_date")
                    ->orWhereRaw("'$checkOutDate' BETWEEN check_in_date AND check_out_date");
            })
            ->first();

        if (!$room) {
            Log::error('No available rooms for the selected dates', [
                'room_type_id' => $roomTypeId,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
            ]);
            return redirect()->back()->with('error', 'No available rooms for the selected dates.');
        }

        Log::info('Room found for booking: ', ['room_id' => $room->id]);

        // Step 5: Proceed to create the booking with the assigned room and guest information
        try {
            $booking = Booking::create([
                'guest_id' => $guest->id, // Use the guest's ID here
                'room_id' => $room->id,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'total_adults' => $request->input('total_adults'),
                'total_children' => $request->input('total_children'),
                'status' => 'confirmed'
            ]);

            Log::info('Booking created successfully: ', ['booking_id' => $booking->id]);
        } catch (\Exception $e) {
            Log::error('Error creating the booking: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error creating the booking: ' . $e->getMessage());
        }

        return redirect()->route('reservation')->with('success', 'Booking created successfully.')->withInput();
    }
}
