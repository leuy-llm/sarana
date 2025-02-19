<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function reservation()
    {
        $data = "Reservation";
        $bookingId = Booking::latest()->first()->id ?? null; // Example of retrieving the latest booking ID
        $settings = DB::table('settings')->get();
        $banner = Banner::where('page_name', 'booking')->first();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        $contact = DB::table('contact_details')->get();
        return view('frontend.booking.index', compact('data', 'contact', 'banner', 'settings', 'roomTypes', 'bookingId'));
    }


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

        // Calculate total guests (adults + children)
        $totalGuests = $request->input('total_adults') + $request->input('total_children', 0);

        // Check if the total number of guests exceeds the room's max capacity
        if ($totalGuests > $room->max_person) {
            return redirect()->back()->withErrors(['message' => 'The selected room cannot accommodate more than ' . $room->max_person . ' people.']);
        }
        $checkInDate = new \Carbon\Carbon($request->input('check_in_date'));
        $checkOutDate = new \Carbon\Carbon($request->input('check_out_date'));
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
        // Add a notification when a new query is created

        $notifications = session()->get('notifications', []);

        // Generate a new ID based on the count of existing notifications
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
            'roomPrice' => $roomPrice
        ])->withSuccess('Your reservation has been made successfully!');
    }
    public function confirmation(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $data = "Booking Confirmed!";
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        // Get total amount, room type, and room price from the route parameters or default values
        $totalAmount = $request->query('totalAmount', 0);
        $roomType = $request->query('roomType', 'Standard');
        $roomPrice = $request->query('roomPrice', 0);
        $contact = DB::table('contact_details')->get();
        // Check if the user is authenticated
        $guest = auth()->guard('guest')->user();

        return view('frontend.booking.success', compact('booking', 'contact', 'data', 'settings', 'roomTypes', 'totalAmount', 'roomType', 'roomPrice', 'guest'));
    }
    public function cancelBooking($id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            // Convert check_in_date to Carbon
            $checkInDate = Carbon::parse($booking->check_in_date);

            // Ensure that cancellation is not allowed within 24 hours of check-in
            if ($checkInDate->diffInHours(now()) < 24) {
                // return redirect()->back()->with('error', 'You cannot cancel a booking within 24 hours of check-in.');
                return redirect()->back()->withErrors(['message' => 'You cannot cancel a booking within 24 hours of check-in.']);
            }

            $booking->status = 'cancelled'; // Update the booking status to cancelled
            $booking->save();

            // Update room status
            $room = Room::find($booking->room_id);
            $room->save();

            return redirect()->route('homepage')->with('success', 'Your booking has been successfully cancelled.');
        } else {
            return redirect()->back()->with('error', 'Booking not found or already cancelled.');
        }
    }
}
