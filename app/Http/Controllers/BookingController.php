<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use Carbon\Carbon;
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


    // public function store(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'guest_id' => 'required|exists:guests,id',
    //             'room_id' => 'required|exists:rooms,id',
    //             'check_in_date' => 'required|date|after_or_equal:today',
    //             'check_out_date' => 'required|date|after:check_in_date',
    //             'total_adults' => 'required|integer|min:1',
    //             'total_children' => 'nullable|integer|min:0',
    //             'payment_status' => 'required|in:Unpaid,Paid',

    //             'status' => 'required|in:Reserved,Cancelled,Pending,Checked-In,Checked-Out,Completed',
    //         ],
    //     );

    //     $booking = new Booking();
    //     $booking->guest_id = $request->guest_id;
    //     $booking->room_id = $request->room_id;
    //     $booking->check_in_date = $request->check_in_date;
    //     $booking->check_out_date = $request->check_out_date;
    //     $booking->payment_status = $request->payment_status;
    //     $booking->quantity = $request->quantity;
    //     $booking->total_adults = $request->total_adults;
    //     $booking->total_children = $request->total_children;
    //     $booking->status = $request->status;
    //     $booking->save();
    //     return redirect()->route('bookings.index')->with('success', __('label.bookingCreatedSuccess'));

    // }

    //     public function store(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'guest_id' => 'required|exists:guests,id',
    //             'room_id' => 'required|exists:rooms,id',
    //             'check_in_date' => 'required|date|after_or_equal:today',
    //             'check_out_date' => 'required|date|after:check_in_date',
    //             'total_adults' => 'required|integer|min:1',
    //             'total_children' => 'nullable|integer|min:0',
    //             'payment_status' => 'required|in:Unpaid,Paid',
    //             'status' => 'required|in:Reserved,Cancelled,Pending,Checked-In,Checked-Out,Completed',
    //             'quantity' => 'required|integer|min:1',
    //         ]
    //     );

    //     // Check if enough rooms are available
    //     $availableRooms = DB::table('rooms')
    //         ->where('id', $request->room_id)
    //         ->where('status', 1)
    //         ->whereNotIn('id', function ($query) use ($request) {
    //             $query->select('room_id')
    //                 ->from('bookings')
    //                 ->whereNotIn('status', ['Cancelled', 'Checked-Out'])
    //                 ->whereRaw("'" . $request->check_in_date . "' BETWEEN check_in_date AND check_out_date");
    //         })
    //         ->count();

    //     if ($availableRooms < $request->quantity) {
    //         return redirect()->route('bookings.index')->with('error','Not enough rooms available')->withInput();
    //     }

    //     // Save the booking
    //     $booking = new Booking();
    //     $booking->guest_id = $request->guest_id;
    //     $booking->room_id = $request->room_id;
    //     $booking->check_in_date = $request->check_in_date;
    //     $booking->check_out_date = $request->check_out_date;
    //     $booking->quantity = $request->quantity;
    //     $booking->total_adults = $request->total_adults;
    //     $booking->total_children = $request->total_children;
    //     $booking->payment_status = $request->payment_status;
    //     $booking->status = $request->status;
    //     $booking->save();

    //     return redirect()->route('bookings.index')->with('success', __('label.bookingCreatedSuccess'));
    // }

    // public function store(Request $request)
    // {
    //     // Validate the form inputs
    //     $request->validate([
    //         'guest_id' => 'required|exists:guests,id',
    //         'check_in_date' => 'required|date|after_or_equal:today',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'room_id' => 'required|array|min:1', // Ensure at least one room is selected
    //         'room_id.*' => 'exists:rooms,id',
    //         'total_adults' => 'required|array|min:1',
    //         'total_adults.*' => 'integer|min:1',
    //         'total_children.*' => 'nullable|integer|min:0',
    //         'payment_status' => 'required|in:Paid,Unpaid',
    //         'status' => 'required|in:Reserved,Cancelled,Pending,Checked-In,Checked-Out',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         // Create the booking
    //         $bookingId = DB::table('bookings')->insertGetId([
    //             'guest_id' => $request->guest_id,
    //             'check_in_date' => $request->check_in_date,
    //             'check_out_date' => $request->check_out_date,
    //             'payment_status' => $request->payment_status,
    //             'status' => $request->status,
    //         ]);

    //         // Loop through the rooms and insert data into booking_rooms
    //         foreach ($request->room_id as $index => $roomId) {

    //             $isRoomAvailable = DB::table('bookings')
    //                 ->where('room_id', $roomId)
    //                 ->whereNotIn('status', ['Cancelled', 'Checked-Out'])
    //                 ->where(function ($query) use ($request) {
    //                     $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
    //                         ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
    //                         ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$request->check_in_date])
    //                         ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$request->check_out_date]);
    //                 })
    //                 ->exists();

    //             if ($isRoomAvailable) {
    //                 return back()->withErrors(["room_id.$index" => "Room $roomId is unavailable for the selected dates."])->withInput();
    //             }

    //             // Insert data into booking_rooms table
    //             DB::table('booking_rooms')->insert([
    //                 'booking_id' => $bookingId,
    //                 'room_id' => $roomId,
    //                 'total_adults' => $request->total_adults[$index],
    //                 'total_children' => $request->total_children[$index] ?? 0,

    //             ]);
    //         }

    //         DB::commit();

    //         return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Log the error for debugging
    //         Log::error('Booking Store Error: ', ['error' => $e->getMessage()]);

    //         return back()->withErrors(['error' => 'An error occurred while saving the booking. Please try again.'])->withInput();
    //     }
    // }

    // public function store(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'guest_id' => 'required|exists:guests,id',
    //         'check_in_date' => 'required|date',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'room_id' => 'required|array|min:1', // Ensure at least one room is selected
    //         'room_id.*' => [
    //             'required',
    //             'exists:rooms,id',
    //             function ($attribute, $value, $fail) use ($request) {
    //                 // Validate room availability
    //                 $isRoomAvailable = DB::table('booking_rooms')
    //                     ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
    //                     ->where('booking_rooms.room_id', $value)
    //                     ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
    //                     ->where(function ($query) use ($request) {
    //                         $query->whereBetween('bookings.check_in_date', [$request->check_in_date, $request->check_out_date])
    //                             ->orWhereBetween('bookings.check_out_date', [$request->check_in_date, $request->check_out_date])
    //                             ->orWhere(function ($query) use ($request) {
    //                                 $query->where('bookings.check_in_date', '<=', $request->check_in_date)
    //                                     ->where('bookings.check_out_date', '>=', $request->check_out_date);
    //                             });
    //                     })
    //                     ->exists();

    //                 if ($isRoomAvailable) {
    //                     $fail("Room ID $value is not available for the selected dates.");
    //                 }
    //             },
    //         ],
    //         'total_adults' => 'required|array|min:1',
    //         'total_adults.*' => 'required|integer|min:1',
    //         'total_children' => 'nullable|array',
    //         'total_children.*' => 'nullable|integer|min:0',
    //         'status' => 'required|in:Approved,Cancelled,Pending,Checked-In,Checked-Out',
    //         'payment_status' => 'required|in:Unpaid,Paid',
    //     ]);


    //     try {
    //         // Create the booking
    //         $booking = Booking::create([
    //             'guest_id' => $request->guest_id,
    //             'check_in_date' => $request->check_in_date,
    //             'check_out_date' => $request->check_out_date,
    //             'status' => $request->status,
    //             'payment_status' => $request->payment_status,
    //         ]);

    //         // Attach rooms
    //         foreach ($request->room_id as $index => $roomId) {
    //             $booking->rooms()->attach($roomId, [
    //                 'total_adults' => $request->total_adults[$index],
    //                 'total_children' => $request->total_children[$index] ?? 0,
    //             ]);
    //         }

    //         DB::commit();

    //         return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Booking Store Error: ' . $e->getMessage());
    //         return redirect()->back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'rooms' => 'required|array|min:1',
            'rooms.*' => 'exists:rooms,id',
            'total_adults' => 'required|array|min:1',
            'total_adults.*' => 'required|integer|min:1',
            'total_children' => 'nullable|array',
            'total_children.*' => 'nullable|integer|min:0',
            'status' => 'required|in:Approved,Cancelled,Pending,Checked-In,Checked-Out',
            'payment_status' => 'required|in:Paid,Unpaid',
        ]);

        try {
            DB::beginTransaction();

            // Create the booking
            $booking = Booking::create([
                'guest_id' => $validated['guest_id'],
                'check_in_date' => $validated['check_in_date'],
                'check_out_date' => $validated['check_out_date'],
                'status' => $validated['status'],
                'payment_status' => $validated['payment_status'],
            ]);

            // Process room data and create booking_rooms records
            foreach ($validated['rooms'] as $index => $roomId) {
                $room = Room::find($roomId);

                // Calculate total persons for this room
                $totalPersons = $validated['total_adults'][$index] + ($validated['total_children'][$index] ?? 0);

                if ($totalPersons > $room->max_person) {
                    return redirect()->back()->withErrors([
                        "rooms.$index" => "The total number of persons exceeds the maximum capacity for room {$room->roomType->type_name}."
                    ])->withInput();
                }

                // Create booking_rooms entry for each room
                $booking->rooms()->attach($room->id, [
                    'total_adults' => $validated['total_adults'][$index],
                    'total_children' => $validated['total_children'][$index] ?? 0,
                ]);
            }

            DB::commit();

            // Redirect to the bookings page with success message
            return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error creating booking: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withErrors('An error occurred while creating the booking. Please try again.');
        }
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


    //កូដដែលយកពិតប្រាកដ
    // public function available_rooms(Request $request, $checkin_date)
    // {
    //     $arooms = DB::table('rooms')
    //         ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //         ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
    //         ->where('rooms.is_deleted', '=', 0)
    //         ->where('rooms.status', '=', 1)
    //         ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
    //             $query->select('room_id')
    //                 ->from('bookings')
    //                 ->whereNotIn('status', ['Cancelled', 'Checked-Out']) // Exclude only non-cancelled and non-checked-out bookings
    //                 ->whereRaw("'$checkin_date' BETWEEN check_in_date AND check_out_date");
    //         })
    //         ->get();

    //     return response()->json(['data' => $arooms]);
    // }

    //     public function available_rooms(Request $request, $checkin_date)
    // {
    //     DB::enableQueryLog();
    // $arooms = DB::table('rooms')
    //     ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //     ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
    //     ->where('rooms.is_deleted', '=', 0)
    //     ->where('rooms.status', '=', 1)
    //     ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
    //         $query->select('room_id')
    //             ->from('booking_rooms')
    //             ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
    //             ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
    //             ->whereRaw("'$checkin_date' BETWEEN bookings.check_in_date AND bookings.check_out_date");
    //     })
    //     ->get();
    // dd(DB::getQueryLog());
    // public function available_rooms(Request $request, $checkin_date)
    // {
    //     $arooms = DB::table('rooms')
    //         ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //         ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
    //         ->where('rooms.is_deleted', '=', 0)
    //         ->where('rooms.status', '=', 1)
    //         ->whereNotIn('rooms.id', function ($query) use ($checkin_date) {
    //             $query->select('room_id')
    //                 ->from('booking_rooms') // Use the pivot table `booking_rooms`
    //                 ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id') // Join with `bookings` table
    //                 ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out']) // Exclude only non-cancelled and non-checked-out bookings
    //                 ->whereRaw("'$checkin_date' BETWEEN bookings.check_in_date AND bookings.check_out_date");
    //         })
    //         ->get();

    //     return response()->json(['data' => $arooms]);
    // }
    public function available_rooms(Request $request, $checkin_date)
    {
        try {
            $checkout_date = $request->check_out_date; // Get the check-out date from the request

            // Ensure both check-in and check-out dates are provided
            if (!$checkout_date) {
                return response()->json(['error' => 'Check-out date is required.'], 400);
            }

            // $arooms = DB::table('rooms')
            //     ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            //     ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
            //     ->where('rooms.is_deleted', '=', 0) // Ensure room is not deleted
            //     ->where('rooms.status', '=', 1)    // Ensure room is active
            //     ->whereNotIn('rooms.id', function ($query) use ($checkin_date, $checkout_date) {
            //         $query->select('room_id')
            //             ->from('booking_rooms')
            //             ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
            //             ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
            //             ->where(function ($query) use ($checkin_date, $checkout_date) {
            //                 // Check if room is booked during the selected period
            //                 $query->whereRaw("'$checkin_date' BETWEEN bookings.check_in_date AND bookings.check_out_date")
            //                     ->orWhereRaw("'$checkout_date' BETWEEN bookings.check_in_date AND bookings.check_out_date")
            //                     ->orWhereRaw("bookings.check_in_date <= '$checkin_date' AND bookings.check_out_date >= '$checkout_date'");
            //             });
            //     })
            //     ->get();

            $arooms = Room::where('is_deleted', 0)
                ->where('status', 1)
                ->whereDoesntHave('bookings', function ($query) use ($checkin_date, $checkout_date) {
                    $query->whereNotIn('status', ['Cancelled', 'Checked-Out'])
                        ->where(function ($query) use ($checkin_date, $checkout_date) {
                            $query->whereBetween('check_in_date', [$checkin_date, $checkout_date])
                                ->orWhereBetween('check_out_date', [$checkin_date, $checkout_date])
                                ->orWhere(function ($query) use ($checkin_date, $checkout_date) {
                                    $query->where('check_in_date', '<=', $checkin_date)
                                        ->where('check_out_date', '>=', $checkout_date);
                                });
                        });
                })
                ->get();


            return response()->json(['data' => $arooms], 200);
        } catch (\Exception $e) {
            Log::error('Available Rooms Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to fetch available rooms. Please try again later.'], 500);
        }
    }


    //     public function available_rooms(Request $request, $checkin_date)
    // {
    //     try {
    //         $checkout_date = $request->check_out_date;

    //         if (!$checkout_date) {
    //             return response()->json(['error' => 'Check-out date is required.'], 400);
    //         }

    //         $arooms = DB::table('rooms')
    //             ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //             ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
    //             ->where('rooms.is_deleted', '=', 0)
    //             ->where('rooms.status', '=', 1)
    //             ->whereNotIn('rooms.id', function ($query) use ($checkin_date, $checkout_date) {
    //                 $query->select('room_id')
    //                     ->from('booking_rooms')
    //                     ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
    //                     ->whereNotIn('bookings.status', ['Cancelled', 'Checked-Out'])
    //                     ->where(function ($query) use ($checkin_date, $checkout_date) {
    //                         $query->whereRaw("'$checkin_date' BETWEEN bookings.check_in_date AND bookings.check_out_date")
    //                             ->orWhereRaw("'$checkout_date' BETWEEN bookings.check_in_date AND bookings.check_out_date")
    //                             ->orWhereRaw("bookings.check_in_date <= '$checkin_date' AND bookings.check_out_date >= '$checkout_date'");
    //                     });
    //             })
    //             ->get();

    //         return response()->json($arooms, 200);
    //     } catch (\Exception $e) {
    //         Log::error('Available Rooms Error: ', ['error' => $e->getMessage()]);
    //         return response()->json(['error' => 'Failed to fetch available rooms. Please try again later.'], 500);
    //     }
    // }




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
                    ->where('status', '!=', 'Cancelled') // Exclude only non-canceled bookings
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

    // public function edit($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     $rooms  = Room::getRoom();
    //     $guests = Guest::getGuest();
    //     $header_title = "Edit Booking";
    //     $bookedDates = DB::table('bookings')
    //         ->select('check_in_date', 'check_out_date')
    //         ->get();

    //     return view("back_end.booking.edit", compact('rooms', 'booking', 'guests', 'header_title', 'bookedDates'));
    // }
    // public function edit($id)
    // {
    //     $header_title = "Edit Bookings";
    //     $booking = Booking::with('rooms')->findOrFail($id); // Fetch booking with related rooms
    //     $guests = Guest::getGuest(); // Fetch all guests
    //     $rooms = Room::with('roomType')->get(); // Fetch all rooms with their types

    //     // return view('bookings.edit', compact('booking', 'guests', 'rooms'));
    //     return view("back_end.booking.edit", compact('rooms', 'booking', 'guests', 'header_title'));
    // }


    public function getBookedDates()
    {
        $bookedDates = DB::table('bookings')
            ->select('check_in_date', 'check_out_date')
            ->get();

        return response()->json(['bookedDates' => $bookedDates]);
    }

    // public function update(Request $request, $id)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'guest_id' => 'required|exists:guests,id',
    //         'room_id' => 'required|exists:rooms,id',
    //         'check_in_date' => 'required|date|after_or_equal:today',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'total_adults' => 'required|integer|min:1',
    //         'total_children' => 'nullable|integer|min:0',
    //         'payment_status' => 'required|in:Unpaid,Paid',
    //         'quantity' => 'required|integer|min:1',
    //         'status' => 'required|in:Reserved,Cancelled,Pending,Checked-In,Checked-Out,Completed',
    //     ]);
    //     // Find the booking by ID
    //     $booking = Booking::findOrFail($id);
    //     // Update the booking details
    //     $booking->guest_id = $request->guest_id;
    //     $booking->room_id = $request->room_id;
    //     $booking->check_in_date = $request->check_in_date;
    //     $booking->check_out_date = $request->check_out_date;
    //     $booking->total_adults = $request->total_adults;
    //     $booking->total_children = $request->total_children;
    //     $booking->status = $request->status;

    //     // Save the updated booking
    //     $booking->save();

    //     // Redirect to a relevant page (e.g., bookings index) with a success message
    //     return redirect()->route('bookings.index')->with('success', __('label.bookingUpdateSuccess'));
    // }

    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         // Get the current booking
    //         $booking = Booking::findOrFail($id);

    //         // Check if check-in or check-out date has been changed
    //         $checkInDateRule = 'nullable|date';
    //         $checkOutDateRule = 'nullable|date|after:' . $booking->check_in_date;

    //         // Only require the dates if they have been changed
    //         if ($request->filled('check_in_date') && $request->check_in_date !== $booking->check_in_date) {
    //             $checkInDateRule = 'required|date';
    //         }

    //         if ($request->filled('check_out_date') && $request->check_out_date !== $booking->check_out_date) {
    //             $checkOutDateRule = 'required|date|after:' . $request->check_in_date;
    //         }

    //         // Validate the incoming data
    //         $validatedData = $request->validate([
    //             'check_in_date' => $checkInDateRule,
    //             'check_out_date' => $checkOutDateRule,
    //             'room_id' => 'required|array',
    //             'room_id.*' => 'exists:rooms,id', // Ensure room IDs are valid
    //             'total_adults' => 'required|array',
    //             'total_adults.*' => 'integer|min:1',
    //             'total_children' => 'nullable|array',
    //             'total_children.*' => 'integer|min:0',
    //         ]);

    //         // Update the booking details (check-in and check-out dates)
    //         $booking->update([
    //             'check_in_date' => $validatedData['check_in_date'] ?? $booking->check_in_date,
    //             'check_out_date' => $validatedData['check_out_date'] ?? $booking->check_out_date,
    //         ]);

    //         // Update or create the pivot table (booking_rooms) for the rooms
    //         foreach ($validatedData['room_id'] as $index => $roomId) {
    //             // Find the room
    //             $room = Room::findOrFail($roomId);

    //             // Check if the room is already associated with the booking
    //             if ($room->bookings->contains($booking->id)) {
    //                 // Update the pivot table with the selected room, adults, and children count
    //                 $booking->rooms()->updateExistingPivot($room->id, [
    //                     'total_adults' => $validatedData['total_adults'][$index],
    //                     'total_children' => $validatedData['total_children'][$index] ?? 0,
    //                 ]);
    //             } else {
    //                 // Add a new room to the pivot table
    //                 $booking->rooms()->attach($room->id, [
    //                     'total_adults' => $validatedData['total_adults'][$index],
    //                     'total_children' => $validatedData['total_children'][$index] ?? 0,
    //                 ]);
    //             }
    //         }

    //         DB::commit();

    //         // Return success response
    //         return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Log the error
    //         Log::error('Booking Update Error: ', ['error' => $e->getMessage()]);

    //         // Return error response
    //         return back()->withErrors(['error' => 'Failed to update the booking. Please try again later.']);
    //     }
    // }

    //     public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         // Get the current booking
    //         $booking = Booking::findOrFail($id);

    //         // Check if check-in or check-out date has been changed
    //         $checkInDateRule = 'nullable|date';
    //         $checkOutDateRule = 'nullable|date|after:' . $booking->check_in_date;

    //         // Only require the dates if they have been changed
    //         if ($request->filled('check_in_date') && $request->check_in_date !== $booking->check_in_date) {
    //             $checkInDateRule = 'required|date';
    //         }

    //         if ($request->filled('check_out_date') && $request->check_out_date !== $booking->check_out_date) {
    //             $checkOutDateRule = 'required|date|after:' . $request->check_in_date;
    //         }

    //         // Validate the incoming data
    //         $validatedData = $request->validate([
    //             'check_in_date' => $checkInDateRule,
    //             'check_out_date' => $checkOutDateRule,
    //             'room_id' => 'required|array',
    //             'room_id.*' => 'exists:rooms,id', // Ensure room IDs are valid
    //             'total_adults' => 'required|array',
    //             'total_adults.*' => 'integer|min:1',
    //             'total_children' => 'nullable|array',
    //             'total_children.*' => 'integer|min:0',
    //         ]);

    //         // Update the booking details (check-in and check-out dates)
    //         $booking->update([
    //             'check_in_date' => $validatedData['check_in_date'] ?? $booking->check_in_date,
    //             'check_out_date' => $validatedData['check_out_date'] ?? $booking->check_out_date,
    //         ]);

    //         // Sync the pivot table (booking_rooms) with the new rooms
    //         $roomsData = [];
    //         foreach ($validatedData['room_id'] as $index => $roomId) {
    //             $roomsData[$roomId] = [
    //                 'total_adults' => $validatedData['total_adults'][$index],
    //                 'total_children' => $validatedData['total_children'][$index] ?? 0,
    //             ];
    //         }

    //         // Sync the rooms to the booking (this will remove any rooms not in the new request)
    //         $booking->rooms()->sync($roomsData);

    //         DB::commit();

    //         // Return success response
    //         return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Log the error
    //         Log::error('Booking Update Error: ', ['error' => $e->getMessage()]);

    //         // Return error response
    //         return back()->withErrors(['error' => 'Failed to update the booking. Please try again later.']);
    //     }
    // }
    // Helper method to check room availability

    // public function edit($id)
    // {
    //     $guests = Guest::getGuest();
    //     $booking = Booking::with('rooms')->findOrFail($id);
    //     $rooms = Room::getRoom(); // Get all rooms to show as options
    //     return view("back_end.booking.edit", compact('rooms', 'booking', 'guests'));
    // }
    public function edit($id)
    {
        $guests = Guest::getGuest();
        $booking = Booking::with('rooms')->findOrFail($id);
        // Get the IDs of rooms already booked for this booking
        $bookedRoomIds = $booking->rooms->pluck('id')->toArray();

        // Get available rooms excluding those already booked within the selected dates
        $availableRooms = Room::where('status', 1)  // Only active rooms
            ->where('is_deleted', 0)  // Only rooms that are not deleted
            ->whereNotIn('id', function ($query) use ($booking) {
                $query->select('booking_rooms.room_id')
                    ->from('booking_rooms')
                    ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
                    ->where('bookings.id', '!=', $booking->id) // Exclude the current booking
                    ->where(function ($q) use ($booking) {
                        $q->whereBetween('bookings.check_in_date', [$booking->check_in_date, $booking->check_out_date])
                            ->orWhereBetween('bookings.check_out_date', [$booking->check_in_date, $booking->check_out_date])
                            ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$booking->check_in_date])
                            ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$booking->check_out_date]);
                    });
            })
            ->whereNotIn('id', $bookedRoomIds)  // Exclude rooms already selected in this booking
            ->get();

        return view('back_end.booking.edit', compact('booking', 'availableRooms', 'guests', 'rooms'));
    }






    // public function edit($id)
    // {
    //     $header_title = "Edit Bookings";
    //     $booking = Booking::with('rooms')->findOrFail($id); // Fetch booking with related rooms
    //     $guests = Guest::getGuest(); // Fetch all guests
    //     $rooms = Room::with('roomType')->get(); // Fetch all rooms with their types

    //     // return view('bookings.edit', compact('booking', 'guests', 'rooms'));
    //     return view("back_end.booking.edit", compact('rooms', 'booking', 'guests', 'header_title'));
    // }
    // public function update(Request $request, $id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     $validatedData = $request->validate([
    //         'check_in_date' => 'required|date',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'room_id' => 'required|array',
    //         'room_id.*' => 'exists:rooms,id',
    //         'total_adults' => 'required|array',
    //         'total_adults.*' => 'integer|min:1',
    //         'total_children' => 'nullable|array',
    //         'total_children.*' => 'integer|min:0',
    //     ]);

    //     // Update the booking details (check-in and check-out dates)
    //     $booking->update([
    //         'check_in_date' => $validatedData['check_in_date'],
    //         'check_out_date' => $validatedData['check_out_date'],
    //     ]);

    //     // Update the pivot table (booking_rooms) for the rooms
    //     $booking->rooms()->detach();  // Remove all previously associated rooms

    //     foreach ($validatedData['room_id'] as $index => $roomId) {
    //         $room = Room::findOrFail($roomId);
    //         $booking->rooms()->attach($room->id, [
    //             'total_adults' => $validatedData['total_adults'][$index],
    //             'total_children' => $validatedData['total_children'][$index] ?? 0,
    //         ]);
    //     }

    //     return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guest_id' => 'required',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'rooms' => 'required|array',
            'total_adults.*' => 'required|integer|min:1',
            'total_children.*' => 'nullable|integer|min:0',
            'status' => 'required',
            'payment_status' => 'required',
        ]);

        $booking = Booking::findOrFail($id);

        // Check availability before updating
        foreach ($request->rooms as $roomId) {
            $isRoomBooked = DB::table('booking_rooms')
                ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
                ->where('booking_rooms.room_id', $roomId)
                ->where('bookings.id', '!=', $id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('bookings.check_in_date', [$request->check_in_date, $request->check_out_date])
                        ->orWhereBetween('bookings.check_out_date', [$request->check_in_date, $request->check_out_date])
                        ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$request->check_in_date])
                        ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$request->check_out_date]);
                })
                ->exists();

            if ($isRoomBooked) {
                return redirect()->back()->withErrors(['rooms' => 'One or more selected rooms are not available for the chosen dates.']);
            }
        }

        $booking->update($request->only(['guest_id', 'check_in_date', 'check_out_date', 'status', 'payment_status']));

        $roomData = [];
        foreach ($request->rooms as $index => $roomId) {
            $roomData[$roomId] = [
                'total_adults' => $request->total_adults[$index],
                'total_children' => $request->total_children[$index] ?? 0,
            ];
        }
        $booking->rooms()->sync($roomData);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }






    //     public function availableRooms(Request $request, $checkInDate)
    // {
    //     try {
    //         $checkOutDate = $request->check_out_date;
    //         $bookingId = $request->booking_id;
    //         $excludeDefaultRooms = $request->exclude_default_rooms; // New flag
    //         $defaultRoomIds = $request->default_room_ids; // Default rooms

    //         $arooms = DB::table('rooms')
    //             ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //             ->select('rooms.id', 'rooms.room_number', 'room_types.type_name')
    //             ->where('rooms.is_deleted', '=', 0)
    //             ->where('rooms.status', '=', 1)
    //             ->when($excludeDefaultRooms, function ($query) use ($defaultRoomIds) {
    //                 // Exclude default rooms only if flag is true
    //                 $query->whereNotIn('rooms.id', $defaultRoomIds);
    //             })
    //             ->whereNotIn('rooms.id', function ($query) use ($checkInDate, $checkOutDate, $bookingId) {
    //                 $query->select('room_id')
    //                     ->from('booking_rooms')
    //                     ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
    //                     ->where(function ($query) use ($checkInDate, $checkOutDate) {
    //                         $query->whereRaw("'$checkInDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
    //                               ->orWhereRaw("'$checkOutDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
    //                               ->orWhereRaw("bookings.check_in_date <= '$checkInDate' AND bookings.check_out_date >= '$checkOutDate'");
    //                     })
    //                     ->where('bookings.id', '!=', $bookingId);
    //             })
    //             ->get();

    //         return response()->json(['data' => $arooms], 200);
    //     } catch (\Exception $e) {
    //         Log::error('Available Rooms Error: ', ['error' => $e->getMessage()]);
    //         return response()->json(['error' => 'Failed to fetch available rooms. Please try again later.'], 500);
    //     }
    // }

    public function availableRooms(Request $request, $checkInDate)
    {
        try {
            $checkOutDate = $request->check_out_date;
            $bookingId = $request->booking_id;
            $excludeDefaultRooms = $request->exclude_default_rooms; // New flag
            $defaultRoomIds = $request->default_room_ids; // Default rooms

            $arooms = DB::table('rooms')
                ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
                ->select('rooms.id', 'rooms.room_number', 'room_types.type_name', 'rooms.max_person') // Include max_person
                ->where('rooms.is_deleted', '=', 0)
                ->where('rooms.status', '=', 1)
                ->when($excludeDefaultRooms, function ($query) use ($defaultRoomIds) {
                    // Exclude default rooms only if flag is true
                    $query->whereNotIn('rooms.id', $defaultRoomIds);
                })
                ->whereNotIn('rooms.id', function ($query) use ($checkInDate, $checkOutDate, $bookingId) {
                    $query->select('room_id')
                        ->from('booking_rooms')
                        ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
                        ->where(function ($query) use ($checkInDate, $checkOutDate) {
                            $query->whereRaw("'$checkInDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
                                ->orWhereRaw("'$checkOutDate' BETWEEN bookings.check_in_date AND bookings.check_out_date")
                                ->orWhereRaw("bookings.check_in_date <= '$checkInDate' AND bookings.check_out_date >= '$checkOutDate'");
                        })
                        ->where('bookings.id', '!=', $bookingId);
                })
                ->get();

            return response()->json(['data' => $arooms], 200);
        } catch (\Exception $e) {
            Log::error('Available Rooms Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to fetch available rooms. Please try again later.'], 500);
        }
    }


    // public function getAvailableRooms(Request $request)
    // {
    //     $checkInDate = $request->query('check_in_date');
    //     $checkOutDate = $request->query('check_out_date');

    //     // Query the booking_rooms pivot table to find booked rooms
    //     $bookedRooms = Booking::where(function ($query) use ($checkInDate, $checkOutDate) {
    //         $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
    //               ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
    //               ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
    //                   $query->where('check_in_date', '<=', $checkInDate)
    //                         ->where('check_out_date', '>=', $checkOutDate);
    //               });
    //     })
    //     ->with('rooms') // Eager load rooms for the booking
    //     ->get()
    //     ->flatMap(function ($booking) {
    //         return $booking->rooms; // Flatten the array of rooms from the bookings
    //     })
    //     ->pluck('id'); // Get the IDs of the booked rooms (flattened)

    //     // Get available rooms (those not booked) with the room type
    //     $availableRooms = Room::with('roomType') // Eager load the roomType relationship
    //         ->whereNotIn('id', $bookedRooms)
    //         ->get();

    //     // Return the rooms along with room_number and type_name
    //     return response()->json($availableRooms->map(function ($room) {
    //         return [
    //             'id' => $room->id,
    //             'room_number' => $room->room_number,
    //             'type_name' => $room->roomType ? $room->roomType->type_name : null, // Safely access type_name
    //         ];
    //     }));
    // }


    public function getAvailableRooms(Request $request)
    {
        $checkInDate = $request->query('check_in');
        $checkOutDate = $request->query('check_out');

        $availableRooms = Room::whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
            $query->where(function ($q) use ($checkInDate, $checkOutDate) {
                $q->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                    ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkInDate])
                    ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkOutDate]);
            });
        })
            ->with('roomType') // Ensure roomType relationship is loaded
            ->get();

        return response()->json($availableRooms->map(function ($room) {
            return [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'type_name' => $room->roomType ? $room->roomType->type_name : null, // Safely access type_name
            ];
        }));
    }











    // BookingController.php
    public function editBookingRooms($booking_id)
    {
        $booking = Booking::with('rooms')->find($booking_id);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        // Fetch already selected room IDs
        $selectedRooms = $booking->rooms->pluck('id')->toArray();

        // Fetch all available rooms that don't overlap with other bookings
        $availableRooms = Room::whereNotIn('id', function ($query) use ($booking) {
            $query->select('room_id')
                ->from('bookings')
                ->where('id', '!=', $booking->id)
                ->where(function ($query) use ($booking) {
                    $query->where('check_in_date', '<=', $booking->check_out_date)
                        ->where('check_out_date', '>=', $booking->check_in_date);
                });
        })->get();

        return response()->json([
            'booking' => $booking,
            'selectedRooms' => $selectedRooms,
            'availableRooms' => $availableRooms,
        ]);
    }
    public function updateBookingRooms(Request $request, $booking_id)
    {
        $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'rooms' => 'required|array',
            'rooms.*' => 'exists:rooms,id',
        ]);

        $booking = Booking::find($booking_id);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        // Update booking details
        $booking->check_in_date = $request->input('check_in_date');
        $booking->check_out_date = $request->input('check_out_date');
        $booking->save();

        // Sync the rooms
        $booking->rooms()->sync($request->input('rooms'));

        return response()->json(['success' => 'Booking updated successfully']);
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

        try {
            \Stripe\Refund::create([
                'payment_intent' => $payment->payment_intent_id,
                'amount' => $payment->amount,
            ]);
        } catch (\Exception $e) {
            Log::error("Refund failed for payment ID {$payment->id}: " . $e->getMessage());
        }
    }


    // Your Controller
    //     public function checkAvailability(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'room_id' => 'required|exists:rooms,id',
    //             'check_in_date' => 'required|date',
    //             'check_out_date' => 'required|date|after_or_equal:check_in_date',
    //         ]);

    //         $roomId = $validated['room_id'];
    //         $checkInDate = $validated['check_in_date'];
    //         $checkOutDate = $validated['check_out_date'];

    //         $isAvailable = !Booking::whereHas('rooms', function($query) use ($roomId, $checkInDate, $checkOutDate) {
    //             $query->where('room_id', $roomId)
    //                 ->where(function ($query) use ($checkInDate, $checkOutDate) {
    //                     $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
    //                           ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
    //                           ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
    //                               $query->where('check_in_date', '<=', $checkInDate)
    //                                     ->where('check_out_date', '>=', $checkOutDate);
    //                           });
    //                 });
    //         })->exists();

    //         return response()->json(['is_available' => $isAvailable]);
    //     } catch (\Exception $e) {
    //         Log::error('Check Availability Error: ', ['error' => $e->getMessage()]);
    //         return response()->json(['error' => $e->getMessage()], 422);
    //     }
    // }

    public function checkAvailability(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'room_id' => 'required|exists:rooms,id',
                'check_in_date' => 'required|date',
                'check_out_date' => 'required|date|after_or_equal:check_in_date',
                'total_adults' => 'required|array',
                'total_children' => 'nullable|array',
            ]);

            $roomId = $validated['room_id'];
            $checkInDate = $validated['check_in_date'];
            $checkOutDate = $validated['check_out_date'];
            $totalAdults = array_sum($validated['total_adults']);
            $totalChildren = array_sum($validated['total_children'] ?? [0]);

            // Get the room's max capacity
            $room = Room::findOrFail($roomId);
            $maxPerson = $room->max_person;

            // Check if the total number of people exceeds the room's max_person
            if (($totalAdults + $totalChildren) > $maxPerson) {
                return response()->json(['error' => 'The total number of people exceeds the room capacity.'], 422);
            }

            // Check if the room is available for the selected dates
            $isAvailable = !Booking::whereHas('rooms', function ($query) use ($roomId, $checkInDate, $checkOutDate) {
                $query->where('room_id', $roomId)
                    ->where(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                            ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                            ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                                $query->where('check_in_date', '<=', $checkInDate)
                                    ->where('check_out_date', '>=', $checkOutDate);
                            });
                    });
            })->exists();

            return response()->json(['is_available' => $isAvailable]);
        } catch (\Exception $e) {
            Log::error('Check Availability Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function checkRoomAvailability(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        $availableRooms = Room::where('status', 1)  // Active rooms only
            ->where('is_deleted', 0)  // Not deleted rooms
            ->whereNotIn('id', function ($query) use ($checkIn, $checkOut) {
                $query->select('booking_rooms.room_id')
                    ->from('booking_rooms')
                    ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
                    ->where(function ($q) use ($checkIn, $checkOut) {
                        $q->whereBetween('bookings.check_in_date', [$checkIn, $checkOut])
                            ->orWhereBetween('bookings.check_out_date', [$checkIn, $checkOut])
                            ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$checkIn])
                            ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$checkOut]);
                    });
            })
            ->get();

        return response()->json([
            'availableRooms' => $availableRooms->map(function ($room) {
                return [
                    'id' => $room->id,
                    'room_number' => $room->room_number,
                    'room_type' => $room->roomType->type_name,
                ];
            }),
        ]);
    }


    // public function proceedToCheckout(Request $request)
    // {
    //     // Validate the incoming request
    //     $validatedData = $request->validate([
    //         'rooms' => 'required|array',
    //         'check_in' => 'required|date',
    //         'check_out' => 'required|date',
    //         'adults' => 'required|array',
    //         'children' => 'required|array',
    //     ]);

    //     // Create a new booking entry
    //     $booking = Booking::create([
    //         'guest_id' => auth()->guard('guest')->id(),
    //         'check_in_date' => $validatedData['check_in'],
    //         'check_out_date' => $validatedData['check_out'],
    //         'status' => 'Pending',
    //         'payment_status' => 'Unpaid',
    //     ]);
    //     // Attach rooms to the booking
    //     foreach ($validatedData['rooms'] as $roomId) {
    //         $booking->rooms()->attach($roomId, [
    //             'total_adults' => $validatedData['adults'][$roomId],
    //             'total_children' => $validatedData['children'][$roomId],
    //         ]);
    //     }

        

    //     // Redirect to checkout page with booking ID
    //     return redirect()->route('checkout', ['booking_id' => $booking->id]);
    // }

    public function proceedToCheckout(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'rooms' => 'required|array',
        'check_in' => 'required|date',
        'check_out' => 'required|date',
        'adults' => 'required|array',
        'children' => 'required|array',
        'total_price' => 'required|numeric',  // Validate total_price
    ]);

    // Create a new booking entry
    $booking = Booking::create([
        'guest_id' => auth()->guard('guest')->id(),
        'check_in_date' => $validatedData['check_in'],
        'check_out_date' => $validatedData['check_out'],
        'status' => 'Pending',
        'payment_status' => 'Unpaid',
    ]);

    // Attach rooms to the booking
    foreach ($validatedData['rooms'] as $roomId) {
        $booking->rooms()->attach($roomId, [
            'total_adults' => $validatedData['adults'][$roomId],
            'total_children' => $validatedData['children'][$roomId],
        ]);
    }

    // Now that we have total_price, pass it to the checkout page
    return redirect()->route('checkout', ['booking_id' => $booking->id, 'total_price' => $validatedData['total_price']]);
}

}
