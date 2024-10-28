<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    //
    public function index()
    {

        $bookings = Booking::getBooking();
        $header_title = "Manage Booking";

        return view('back_end.booking.index', compact('header_title', 'bookings'));
    }


    public function create()
    {

        $rooms  = Room::getRoom();
        $guests = Guest::getGuest();
        $header_title = "Create Booking";

        return view("back_end.booking.create", compact('rooms', 'guests', 'header_title'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_adults' => 'required|integer|min:1',
            'total_children' => 'nullable|integer|min:0',
            'status' => 'required',
        ]);


        $booking = new Booking();
        $booking->guest_id = $request->guest_id;
        $booking->room_id = $request->room_id;
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->total_adults = $request->total_adults;
        $booking->total_children = $request->total_children;
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    }


    public function available_rooms(Request $request, $checkin_date)
    {
        $arooms = DB::table('rooms')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
            ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
                $query->select('room_id')
                    ->from('bookings')
                    ->whereRaw("'$checkin_date' BETWEEN check_in_date AND check_out_date");
            })
            ->get();

        return response()->json(['data' => $arooms]);
    }

    public function available_room_types(Request $request, $checkin_date)
    {
        $availableRoomTypes = DB::table('room_types')
            ->join('rooms', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('room_types.id','rooms.price', 'room_types.type_name')
            ->where('rooms.is_deleted', '=', 0)  // Filter out deleted rooms
            ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
                $query->select('room_id')
                    ->from('bookings')
                    ->whereRaw("'$checkin_date' BETWEEN check_in_date AND check_out_date");
            })
            ->distinct() // Ensures only unique room types are returned
            ->get();

        return response()->json(['data' => $availableRoomTypes]);
    }

    public function checkDate($date)
    {
        $isBooked = Booking::where('check_in_date', $date)
            ->orWhere('check_out_date', $date)
            ->exists();

        return response()->json(['isBooked' => $isBooked]);
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $rooms  = Room::getRoom();
        $guests = Guest::getGuest();
        $header_title = "Edit Booking";
        $bookedDates = DB::table('bookings')
            ->select('check_in_date', 'check_out_date')
            ->get();

        return view("back_end.booking.edit", compact('rooms', 'booking', 'guests', 'header_title', 'bookedDates'));
    }


    public function getBookedDates()
    {
        $bookedDates = DB::table('bookings')
            ->select('check_in_date', 'check_out_date')
            ->get();

        return response()->json(['bookedDates' => $bookedDates]);
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'total_adults' => 'required|integer|min:1',
            'total_children' => 'required|integer|min:0',
            'status' => 'required|in:confirmed,canceled,pending',
        ]);

        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Update the booking details
        $booking->guest_id = $request->guest_id;
        $booking->room_id = $request->room_id;
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->total_adults = $request->total_adults;
        $booking->total_children = $request->total_children;
        $booking->status = $request->status;

        // Save the updated booking
        $booking->save();

        // Redirect to a relevant page (e.g., bookings index) with a success message
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully');
    }

    public function destroy($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if (!empty($booking)) {
            $booking->is_deleted = 1;
            $booking->save();

            return redirect('/bookings')->with('success', 'The Booking was marked as deleted successfully');
        }

        return redirect('/bookings')->with('error', 'Booking not found');
    }


    public function show($id) {}
}
