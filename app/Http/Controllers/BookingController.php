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
            'status' => 'required|in:comfirmed,cancelled,pending,checked-in,checked-out',
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

        return redirect()->route('bookings.index')->with('success', __('label.bookingCreatedSuccess'));
    }


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

    // public function available_rooms(Request $request, $checkin_date)
    // {
    //     $arooms = DB::table('rooms')
    //         ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //         ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
    //         ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
    //             $query->select('room_id')
    //                 ->from('bookings')
    //                 ->where('status', '!=', 'cancelled') // Exclude only non-canceled bookings
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
            ->where('rooms.is_deleted', '=', 0)
            ->where('rooms.status', '=', 1)
            ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
                $query->select('room_id')
                    ->from('bookings')
                    ->whereNotIn('status', ['cancelled', 'checked-out']) // Exclude only non-cancelled and non-checked-out bookings
                    ->whereRaw("'$checkin_date' BETWEEN check_in_date AND check_out_date");
            })
            ->get();

        return response()->json(['data' => $arooms]);
    }



    public function available_room_types(Request $request, $checkin_date)
    {
        $availableRoomTypes = DB::table('room_types')
            ->join('rooms', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('room_types.id', 'rooms.price', 'room_types.type_name')
            ->where('rooms.is_deleted', '=', 0)  // Filter out deleted rooms
            ->where('rooms.status', '=', 1)
            ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
                $query->select('room_id')
                    ->from('bookings')
                    ->where('status', '!=', 'cancelled') // Exclude only non-canceled bookings
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
            'status' => 'required|in:comfirmed,cancelled,pending,checked-in,checked-out',
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
        return redirect()->route('bookings.index')->with('success', __('label.bookingUpdateSuccess'));
    }

    public function destroy($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if (!empty($booking)) {
            $booking->is_deleted = 1;
            $booking->save();

            return redirect('/bookings')->with('success', __('label.bookingDeleteSuccess'));
            //with('success', 'The Booking was marked as deleted successfully');
        }

        return redirect('/bookings')->with('error', __('label.bookingDeleteError'));
        //with('error', 'Booking not found');
    }


    public function show($id)
{
    $booking = Booking::with(['guest', 'room.roomType', 'payment'])
        ->where('id', $id)
        ->first();

    if (!$booking) {
        return redirect()->route('bookings.index')->with('error', 'Booking not found.');
    }

    return view('back_end.booking.show', compact('booking'));
}



    // public function toggleActive(Request $request, $id)
    // {
    //     // Find the booking by ID
    //     $booking = Booking::findOrFail($id);

    //     // Handle status transitions
    //     if ($booking->status === 'confirmed' && $request->status === 'staying') {
    //         // Change 'confirmed' to 'staying'
    //         $booking->status = 'staying';
    //     } elseif ($booking->status === 'stay' && $request->status === 'staying') {
    //         // Change 'stay' to 'staying'
    //         $booking->status = 'staying';
    //     } elseif ($booking->status === 'staying' && $request->status === 'leave') {
    //         // Change 'staying' to 'leave'
    //         $booking->status = 'leave';
    //     }

    //     // Save the updated status
    //     $booking->save();

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', __('Status updated successfully!'));
    // }

    // public function toggleActive(Request $request, $id)
    // {
    //     // Find the booking by ID
    //     $booking = Booking::findOrFail($id);

    //     // Handle status transitions
    //     if ($booking->status === 'confirmed' && $request->status === 'staying') {
    //         // Change 'confirmed' to 'staying'
    //         $booking->status = 'staying';
    //     } elseif ($booking->status === 'stay' && $request->status === 'staying') {
    //         // Change 'stay' to 'staying'
    //         $booking->status = 'staying';
    //     } elseif ($booking->status === 'staying' && $request->status === 'leave') {
    //         // Change 'staying' to 'leave'
    //         $booking->status = 'leave';
    //     } elseif ($booking->status === 'leave') {
    //         // Transition to 'check_out' (no actual action, just prevent interaction)
    //         $booking->status = 'check_out';
    //     }

    //     // Save the updated status
    //     $booking->save();

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', __('Status updated successfully!'));
    // }

    // public function toggleActive(Request $request, $id)
    // {
    //     // Find the booking by ID
    //     $booking = Booking::findOrFail($id);

    //     // Define valid transitions
    //     $transitions = [
    //         'confirmed' => 'checked-in',
    //         'checked-in' => 'checked-out',
    //     ];

    //     // Check if the requested status is a valid transition
    //     if (isset($transitions[$booking->status]) && $transitions[$booking->status] === $request->status) {
    //         $booking->status = $request->status;
    //         $booking->save();

    //         return redirect()->back()->with('success', __('Status updated successfully!'));
    //     }

    //     // If invalid transition, redirect with an error
    //     return redirect()->back()->with('error', __('Invalid status transition!'));
    // }

    // public function toggleActive(Request $request, $id)
    // {
    //     // Find the booking by ID
    //     $booking = Booking::findOrFail($id);

    //     // Define valid transitions
    //     $transitions = [
    //         'confirmed' => 'checked-in',
    //         'checked-in' => 'checked-out',
    //         'confirmed' => 'cancelled', // Allow cancelling from 'confirmed'
    //     ];

    //     // Check if the requested status is a valid transition
    //     if (isset($transitions[$booking->status]) && $transitions[$booking->status] === $request->status) {
    //         $booking->status = $request->status;
    //         $booking->save();

    //         return redirect()->back()->with('success', __('Status updated successfully!'));
    //     }
    //     // If invalid transition, redirect with an error
    //     return redirect()->back()->with('error', __('Invalid status transition!'));
    // }
    public function toggleActive(Request $request, $id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Define valid transitions
        $transitions = [
            'confirmed' => ['checked-in', 'cancelled'], // 'confirmed' can transition to 'checked-in' or 'cancelled'
            'checked-in' => ['checked-out'],           // 'checked-in' can only transition to 'checked-out'
        ];

        // Check if the current status has a valid transition to the requested status
        if (isset($transitions[$booking->status]) && in_array($request->status, $transitions[$booking->status])) {
            $booking->status = $request->status;
            $booking->save();

            return redirect()->back()->with('success', __('Status updated successfully!'));
        }

        // If invalid transition, redirect with an error
        return redirect()->back()->with('error', __('Invalid status transition!'));
    }


    /**
     * Update the status of a booking.
     *
     * @param int $id
     * @param string $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus($id, $status)
    {
        // Validate the provided status
        $validStatuses = ['Pending', 'Approved', 'Checked-In', 'Checked-Out', 'Completed', 'Cancelled'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status provided.');
        }

        // Find the booking
        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Update the status
        $booking->status = $status;
        $booking->save();

        // Log the status change for audit purposes (optional)
        Log::info("Booking ID {$id} status updated to {$status} by user ID " . auth()->id());

        // Handle additional logic based on the status
        if ($status === 'Checked-In') {
            // Perform actions related to check-in
            $this->handleCheckIn($booking);
        } elseif ($status === 'Checked-Out') {
            // Perform actions related to check-out
            $this->handleCheckOut($booking);
        } elseif ($status === 'Completed') {
            // Perform actions related to booking completion
            $this->handleCompletion($booking);
        } elseif ($status === 'Cancelled') {
            // Handle cancellation (e.g., refund payment)
            $this->handleCancellation($booking);
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    /**
     * Handle actions for Checked-In status.
     *
     * @param \App\Models\Booking $booking
     * @return void
     */
    protected function handleCheckIn(Booking $booking)
    {
        // Example: Mark the room as occupied
        if ($booking->room) {
            $booking->room->update(['is_occupied' => true]);
        }

        // Add any additional logic for check-in
    }

    /**
     * Handle actions for Checked-Out status.
     *
     * @param \App\Models\Booking $booking
     * @return void
     */
    protected function handleCheckOut(Booking $booking)
    {
        // Example: Mark the room as available
        if ($booking->room) {
            $booking->room->update(['is_occupied' => false]);
        }

        // Add any additional logic for check-out
    }

    /**
     * Handle actions for Completed status.
     *
     * @param \App\Models\Booking $booking
     * @return void
     */
    protected function handleCompletion(Booking $booking)
    {
        // Example: Generate an invoice or summary report
        // Add any additional logic for booking completion
    }

    /**
     * Handle actions for Cancelled status.
     *
     * @param \App\Models\Booking $booking
     * @return void
     */
    protected function handleCancellation(Booking $booking)
    {
        // Example: Process refund if payment has been made
        if ($booking->payment) {
            $this->processRefund($booking->payment);
        }

        // Add any additional logic for cancellation
    }

    /**
     * Process refund for a payment (example method).
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    protected function processRefund($payment)
    {
        // Example logic for refunding a payment using Stripe
        try {
            \Stripe\Refund::create([
                'payment_intent' => $payment->payment_intent_id,
                'amount' => $payment->amount,
            ]);
        } catch (\Exception $e) {
            Log::error("Refund failed for payment ID {$payment->id}: " . $e->getMessage());
        }
    }
}
