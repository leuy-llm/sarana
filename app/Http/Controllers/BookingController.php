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
    //     public function store(Request $request)
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

    //     DB::transaction(function () use ($request) {
    //         $booking = new Booking();
    //         $booking->guest_id = $request->guest_id;
    //         $booking->room_id = $request->room_id;
    //         $booking->check_in_date = $request->check_in_date;
    //         $booking->check_out_date = $request->check_out_date;
    //         $booking->total_adults = $request->total_adults;
    //         $booking->total_children = $request->total_children;
    //         $booking->status = $request->status;
    //         $booking->save();

    //         // Update room status based on booking status
    //         $room = Room::find($request->room_id);
    //         if ($request->status == 'confirmed') {
    //             $room->status = 'Booked';
    //         } elseif ($request->status == 'canceled') {
    //             $room->status = 'Available';
    //         }
    //         $room->save();
    //     });

    //     return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    // }


    // function available_rooms(Request $request,$checkin_date){

    //     $arooms = DB::select("Select * From rooms Where id NOT IN(Select room_id From bookings 
    //     Where '$checkin_date' BETWEEN check_in_date AND check_out_date)");

    //     return response()->json(['data'=>$arooms]);
    // }
    // public function available_rooms(Request $request, $checkin_date)
    // {
    //     $arooms = DB::table('rooms')
    //         ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //         ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
    //         ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
    //             $query->select('room_id')
    //                 ->from('bookings')
    //                 ->whereRaw("'$checkin_date' BETWEEN check_in_date AND check_out_date");
    //         })
    //         ->get();

    //     return response()->json(['data' => $arooms]);
    // }

    public function available_rooms(Request $request, $checkin_date)
    {
        $arooms = DB::table('rooms')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
            ->where('rooms.is_deleted', '=', 0)  // Add this condition to filter out deleted rooms
            ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
                $query->select('room_id')
                    ->from('bookings')
                    ->whereRaw("'$checkin_date' BETWEEN check_in_date AND check_out_date");
            })
            ->get();

        return response()->json(['data' => $arooms]);
    }


    public function checkDate($date)
    {
        $isBooked = Booking::where('check_in_date', $date)
            ->orWhere('check_out_date', $date)
            ->exists();

        return response()->json(['isBooked' => $isBooked]);
    }

    /*========= Check Booked date */
    // public function getBookedDates(Request $request)
    // {
    //     // Fetch all booked dates
    //     $bookedDates = Booking::select('check_in_date', 'check_out_date')
    //         ->where('room_id', $request->room_id)
    //         ->where('id', '!=', $request->booking_id) // Exclude current booking
    //         ->get();

    //     // Debugging: Log or return raw data
    //     Log::info('Booked Dates Query:', ['data' => $bookedDates]);

    //     // Create an array of booked dates
    //     $dates = [];
    //     foreach ($bookedDates as $booking) {
    //         $period = new \DatePeriod(
    //             new \DateTime($booking->check_in_date),
    //             new \DateInterval('P1D'),
    //             (new \DateTime($booking->check_out_date))->modify('+1 day')
    //         );

    //         foreach ($period as $date) {
    //             $dates[] = $date->format('Y-m-d');
    //         }
    //     }

    //     \Log::info('Booked Dates:', ['dates' => $dates]);

    //     return response()->json($dates);
    // }


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

            return redirect('/roomtypes')->with('success', 'The Booking was marked as deleted successfully');
        }

        return redirect('/roomtypes')->with('error', 'Booking not found');
    }


    public function show($id) {}

    public function changeRoomPartway(Request $request, $bookingId)
    {
        $request->validate([
            'new_room_id' => 'required|exists:rooms,id',
            'new_check_in_date' => 'required|date|after_or_equal:today',
            'new_check_out_date' => 'required|date|after:new_check_in_date',
        ]);

        DB::transaction(function () use ($request, $bookingId) {
            // Find the original booking
            $originalBooking = Booking::findOrFail($bookingId);

            // Ensure the new check-in date is after the original booking's check-in date
            if (strtotime($request->new_check_in_date) <= strtotime($originalBooking->check_in_date)) {
                throw ValidationException::withMessages([
                    'new_check_in_date' => 'New check-in date must be after the original check-in date.',
                ]);
            }


            // Adjust the original booking's check-out date
            $originalBooking->check_out_date = date('Y-m-d', strtotime('-1 day', strtotime($request->new_check_in_date)));
            $originalBooking->save();

            // Set the status of the original room back to "Available" if needed
            if ($originalBooking->status == 'confirmed') {
                $oldRoom = Room::find($originalBooking->room_id);
                $this->resetRoomStatus($oldRoom, $originalBooking->check_in_date, $originalBooking->check_out_date);
            }

            // Create a new booking for the remaining days in the new room
            $newBooking = new Booking();
            $newBooking->guest_id = $originalBooking->guest_id;
            $newBooking->room_id = $request->new_room_id;
            $newBooking->check_in_date = $request->new_check_in_date;
            $newBooking->check_out_date = $request->new_check_out_date;
            $newBooking->total_adults = $originalBooking->total_adults;
            $newBooking->total_children = $originalBooking->total_children;
            $newBooking->status = $originalBooking->status;
            $newBooking->save();

            // Update the new room's status to "Booked"
            $newRoom = Room::find($request->new_room_id);
            if ($newBooking->status == 'confirmed') {
                $this->updateRoomStatus($newRoom, $newBooking->check_in_date, $newBooking->check_out_date);
            }
        });

        return redirect()->route('bookings.index')->with('success', 'Room change completed successfully');
    }



}
