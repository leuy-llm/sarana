<?php

namespace App\Http\Controllers;

use App\Mail\BookingStatusMail;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showPaymentForm($totalprice, Request $request)
    {
        $data = "Payment";
        $contact = DB::table('contact_details')->get();
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        $bookingId = $request->query('bookingId'); // Retrieve bookingId from the query string
        return view('frontend.booking.payment', compact('totalprice', 'bookingId', 'data', 'contact', 'settings', 'roomTypes'));
    }

    public function processPayment(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'total_price' => 'required|numeric|min:1',
            'stripeToken' => 'required|string',
            'booking_id' => 'required|exists:bookings,id', // Ensure the booking exists
        ]);
        // Retrieve the booking based on the booking_id passed in the request
        $booking = Booking::findOrFail($request->input('booking_id'));
        if (!auth('guest')->check()) {
            return redirect()->route('guest-login')->with('error', 'Please log in to complete the checkout.');
        }

        $guest = auth()->guard('guest')->user();

        // Set up Stripe for the payment
        Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

        try {
            // Create a payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->input('total_price') * 100, // Convert to cents
                'currency' => 'usd', // Or another currency depending on your use case
                'payment_method' => $request->input('stripeToken'),
                'confirmation_method' => 'manual',
                'confirm' => true,
                'description' => 'Payment for booking #' . $booking->id,
                'return_url' => route('payment.success'), // URL to redirect to after payment authentication
            ]);
            // Check if the payment succeeded
            if ($paymentIntent->status === 'succeeded') {
                // Update booking status to "Paid"
                $booking->update(['status' => 'Reserved', 'payment_status' => 'Paid']);
                $payment = new Payment();
                $payment->guest_id = $guest->id;
                $payment->booking_id = $booking->id; // Associate the payment with the booking
                $payment->amount = $request->input('total_price');
                $payment->payment_intent_id = $paymentIntent->id; // Store payment_intent_id in the payment table
                $payment->status = $paymentIntent->status;
                $payment->currency = 'usd';
                $payment->payment_method = 'card';
                $payment->save();
                Mail::to($guest->email)->send(new BookingStatusMail($booking, $guest, $payment));


                // Redirect to success page with a success message
                return redirect()->route('payment.success')->with('success', 'Payment was successful. Your booking is confirmed.');
            } else {
                // Handle unsuccessful payment
                throw new \Exception('Payment failed.');
            }
        } catch (\Exception $e) {
            // Handle any errors, such as payment failure or invalid Stripe token
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function paymentSuccess(Request $request)
    {
        $contact = DB::table('contact_details')->get();
        $settings = DB::table('settings')->get();

        // Retrieve the latest payment record
        $payment = Payment::latest()->first();

        if (!$payment) {
            return redirect()->route('home')->with('error', 'Payment record not found.');
        }

        // Retrieve the booking associated with the payment
        $booking = Booking::with(['guest', 'rooms.roomType'])->findOrFail($payment->booking_id);

        // Extract room types
        $roomTypes = $booking->rooms->map(function ($room) {
            return $room->roomType->type_name; // Access the room type for each room
        })->toArray();

        // Prepare the data
        $data = [
            'payment_intent_id' => $payment->payment_intent_id,
            'first_name' => $booking->guest->first_name,
            'last_name' => $booking->guest->last_name,
            'email' => $booking->guest->email,
            'mobile' => $booking->guest->mobile,
            'room_types' => $roomTypes, // Array of room types
            'check_in_date' => $booking->check_in_date,
            'check_out_date' => $booking->check_out_date,
            'total_adults' => $booking->rooms->sum('pivot.total_adults'), // Sum of adults from pivot
            'total_children' => $booking->rooms->sum('pivot.total_children'), // Sum of children from pivot
            'amount' => $payment->amount,
        ];

        return view('frontend.payment.success', compact('contact', 'settings', 'data'));
    }
    /* ============== Payment ============== */
    public function payment()
    {
        $data = "Payment";
        $payments = Payment::with(['booking.guest', 'booking.rooms.roomType'])->get();

        return view('back_end.payment.index', compact('data', 'payments'));
    }

    public function destroy($paymentId)
{
    try {
        // Ensure the payment exists before attempting to delete
        $payment = Payment::findOrFail($paymentId);
        
        // Delete the payment record
        $payment->delete();

        return redirect()->route('payments.index')->with('success', __('label.DeleteSuccess'));
    } catch (\Exception $e) {
        // Handle error if deletion fails
        return redirect()->route('payments.index')->with('error', __('label.DeleteError'));
    }
}



    public function index($booking_id, Request $request)
    {
        // Retrieve the booking with related rooms and guest
        $contact = DB::table('contact_details')->get();
        $booking = Booking::with(['rooms.roomType', 'rooms', 'guest'])->findOrFail($booking_id);

        // Retrieve the total_price from the query parameters
        $totalPrice = $request->query('total_price');

        return view('frontend.payment.checkout', [
            'booking' => $booking,
            'totalPrice' => $totalPrice,
            'contact' => $contact, // Pass contact details to the view
        ]);
    }

    public function success(Request $request)
    {
        // Mark the booking as paid
        $booking = Booking::findOrFail($request->booking_id);
        $booking->status = 'Reserved'; // Change the booking status to confirmed after payment is successful
        $booking->payment_status = 'Paid';
        $booking->save();

        return view('frontend.payment.success', ['booking' => $booking]);
    }

    public function error(Request $request)
    {
        $errorMessage = $request->query('error', 'An error occurred.');
        return view('back_end.payment.error', compact('errorMessage'));
    }
}
