<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingCalender extends Model
{
    use HasFactory;
    public function showAvailableRooms(Request $request){
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
        return view('frontend.booking.available', compact('rooms', 'data', 'banner', 'contact', 'settings', 'roomTypes', 'checkIn', 'checkOut', 'adults', 'children'));
    }

    public function processReservation(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'address' => 'nullable|string|max:255',
        'check_in_date' => 'required|date|after_or_equal:today',
        'check_out_date' => 'required|date|after:check_in_date',
        'total_adults' => 'required|integer|min:1',
        'total_children' => 'nullable|integer|min:0',
        'payment_option' => 'required|in:pay_now,skip_payment',
    ]);

    // Handle guest creation or retrieval
    $guest = auth()->guard('guest')->check()
        ? auth()->guard('guest')->user()
        : Guest::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'mobile' => $validated['mobile'],
                'address' => $validated['address'],
                'password' => bcrypt(str_random(8)),
            ]
        );

    // Verify room availability
    $room = Room::where('id', $request->room_type_id)
        ->whereDoesntHave('bookings', function ($query) use ($validated) {
            $query->where('check_in_date', '<', $validated['check_out_date'])
                  ->where('check_out_date', '>', $validated['check_in_date']);
        })
        ->first();

    if (!$room) {
        return back()->withErrors(['Room is not available for the selected dates.'])->withInput();
    }

    // Create booking record
    $booking = Booking::create([
        'guest_id' => $guest->id,
        'room_id' => $room->id,
        'check_in_date' => $validated['check_in_date'],
        'check_out_date' => $validated['check_out_date'],
        'total_adults' => $validated['total_adults'],
        'total_children' => $validated['total_children'],
        'status' => 'pending',
        'payment_status' => $validated['payment_option'] === 'pay_now' ? 'unpaid' : 'skipped',
    ]);

    // Redirect based on payment option
    if ($validated['payment_option'] === 'pay_now') {
        return $this->initiatePayment($booking);
    }

    return redirect()->route('booking.confirmation', $booking->id);
}

private function calculateDays($startDate, $endDate)
{
    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);

    return $start->diffInDays($end);
}

private function initiatePayment($booking)
{
    // Use helper method to calculate days
    $amount = $booking->room->price * $this->calculateDays($booking->check_in_date, $booking->check_out_date);

    // Redirect to a payment page with Stripe integration
    return view('frontend.payment.stripe', compact('booking', 'amount'));
}



    
}
