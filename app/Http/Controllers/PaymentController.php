<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    //
    // public function showPaymentForm($bookingId,$totalAmount)
    // {
    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
    //     return view('frontend.booking.payment', compact('totalAmount', 'settings', 'roomTypes', 'bookingId'));
    // }



    // public function processPayment(Request $request,$totalAmount)

    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     Charge::create ([
    //             "amount" => $totalAmount * 100,

    //             "currency" => "usd",

    //             "source" => $request->stripeToken,

    //             "description" => "Reservation Payment ." ,
    //     ]);
    //     // $totalAmount = $request->input('total_amount');
    //     Session::flash('success', 'Payment successful!');
    //     return back();

    // }



    //     public function showPaymentForm($totalAmount)
    // {
    //     $booking = Booking::find($bookingId);

    //     // if (!$booking) {
    //     //     return redirect()->route('homepage')->with('error', 'Booking not found.');
    //     // }

    //     $settings = DB::table('settings')->get();
    //     $roomTypes = RoomType::all(); // Retrieve all room types
    //     return view('frontend.booking.payment', compact('totalAmount', 'settings', 'roomTypes', 'bookingId'));
    // }

    public function showPaymentForm($totalprice, Request $request)
    {
        $data = "Payment";
        $contact = DB::table('contact_details')->get();
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();

        $bookingId = $request->query('bookingId'); // Retrieve bookingId from the query string
        return view('frontend.booking.payment', compact('totalprice', 'bookingId', 'data', 'contact', 'settings', 'roomTypes'));
    }


    // public function processPayment(Request $request, $totalAmount)
    // {
    //     $bookingId = $request->input('bookingId');
    //     $stripeToken = $request->input('stripeToken');
    //     $totalPrice = $request->input('amount');

    //     try {
    //         Stripe::setApiKey(env('STRIPE_SECRET'));

    //         Charge::create([
    //             "amount" => $totalAmount * 100,
    //             "currency" => "usd",
    //             "source" => $stripeToken,
    //             "description" => "Reservation Payment",
    //         ]);

    //         // Update booking payment status
    //         $booking = Booking::find($bookingId);
    //         $booking->payment_status = 'paid';
    //         $booking->save();

    //         Session::flash('success', 'Payment successful!');
    //         return redirect()->route('homepage')->with('message', 'Reservation confirmed and payment completed.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['message' => 'Payment failed: ' . $e->getMessage()]);
    //     }
    // }

    // ----------------------------------------------------------------Take this code example
    // public function processPayment(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     try {
    //         // Create a PaymentIntent with the specified amount and currency
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => $request->input('amount') * 100, // Convert to cents
    //             'currency' => 'usd',
    //             'payment_method' => $request->input('stripeToken'),
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //             'return_url' => route('payment.success') // Define a return URL for redirection-based payments
    //         ]);


    //         // Check the status of the payment
    //         if ($paymentIntent->status === 'succeeded') {
    //             return redirect()->back()->with('success', 'Payment successful!');
    //         } else {
    //             return redirect()->back()->with('error', 'Payment failed. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }

//     public function processPayment(Request $request)
// {
//     Stripe::setApiKey(env('STRIPE_SECRET'));

//     // Retrieve the authenticated guest
//     $guest = auth()->guard('guest')->user();

//     // Retrieve the room
    

//     try {
//         // Create a PaymentIntent with the specified amount and currency
//         $paymentIntent = PaymentIntent::create([
//             'amount' => $request->input('amount') * 100, // Convert to cents
//             'currency' => 'usd',
//             'payment_method' => $request->input('stripeToken'),
//             'confirmation_method' => 'manual',
//             'confirm' => true,
//             'customer' => $guest->stripe_id ?? null,
//             'description' => 'Room booking payment',
//             'return_url' => route('payment.success') // Define a return URL for success
//         ]);

//         // Check if the payment was successful
//         if ($paymentIntent->status === 'succeeded') {
//             // Create a new payment record
//             $payment = new Payment();
//             $payment->guest_id = $guest->id;
            
//             $payment->amount = $request->input('amount');
//             $payment->payment_intent_id = $paymentIntent->id;
//             $payment->status = $paymentIntent->status;
//             $payment->currency = 'usd';
//             $payment->payment_method = 'card';
//             $payment->save();

//             // Load necessary relationships for the payment
//             $payment->load('guest', 'room.roomType', 'booking');

//             // Store payment details in the session
//             session(['payment' => $payment]);

//             return redirect()->route('payment.success')->with('success', 'Payment successful!');
//         } else {
//             return redirect()->back()->with('error', 'Payment failed. Please try again.');
//         }
//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', $e->getMessage());
//     }
// }

public function processPayment(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Retrieve the authenticated guest
    $guest = auth()->guard('guest')->user();

    // Retrieve room and booking details from the request
    $room = Room::find($request->input('room_id'));
    $bookingData = [
        'room_id' => $room->id,
        'guest_id' => $guest->id,
        'check_in_date' => $request->input('check_in'),
        'check_out_date' => $request->input('check_out'),
        'total_adults' => $request->input('adults'),
        'total_children' => $request->input('children'),
        'status' => 'pending',  // Initially set booking status to 'pending'
    ];

    // Create the booking record
    $booking = Booking::create($bookingData);

    try {
        // Create a PaymentIntent with the specified amount and currency
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->input('amount') * 100, // Convert to cents
            'currency' => 'usd',
            'payment_method' => $request->input('stripeToken'),
            'confirmation_method' => 'manual',
            'confirm' => true,
            'customer' => $guest->stripe_id ?? null,
            'description' => 'Room booking payment for booking #' . $booking->id,
            'return_url' => route('payment.success') // Define a return URL for success
        ]);

        // Check if the payment was successful
        if ($paymentIntent->status === 'succeeded') {
            // Update the booking status to 'confirmed' once the payment is successful
            $booking->status = 'confirmed';
            $booking->save();

            // Create a new payment record
            $payment = new Payment();
            $payment->guest_id = $guest->id;
            $payment->booking_id = $booking->id; // Associate the payment with the booking
            $payment->amount = $request->input('amount');
            $payment->payment_intent_id = $paymentIntent->id; // Store payment_intent_id in the payment table
            $payment->status = $paymentIntent->status;
            $payment->currency = 'usd';
            $payment->payment_method = 'card';
            $payment->save();

            // Load necessary relationships for the payment
            $payment->load('guest', 'room.roomType', 'booking');

            // Store payment details in the session
            session(['payment' => $payment]);

            return redirect()->route('payment.success')->with('success', 'Payment successful and booking confirmed!');
        } else {
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}




    public function paymentSuccess(Request $request)
    {
        // Fetch contact details and settings from the database
        $contact = DB::table('contact_details')->get();
        $settings = DB::table('settings')->get();

        // Retrieve the payment from the session
        $payment = session('payment');

        // Check if payment exists in the session
        if ($payment) {
            return view('frontend.payment.success', compact('contact', 'settings', 'payment'));
        } else {
            return redirect()->route('homepage')->with('error', 'No payment details found.');
        }
    }





    // public function processPayment(Request $request)
    // {
    //     $token = $request->input('stripeToken');
    //     $totalAmount = $request->input('totalAmount');
    //     $bookingId = $request->input('bookingId');
    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); // Use your Stripe Secret Key

    //     try {
    //         // Create the charge
    //         $charge = \Stripe\Charge::create([
    //             'amount' => $totalAmount * 100, // Amount in cents
    //             'currency' => 'usd',
    //             'description' => 'Booking Payment',
    //             'source' => $token,
    //         ]);

    //         $booking = Booking::find($bookingId);
    //         if (!$booking) {
    //             return redirect()->back()->withErrors(['message' => 'Booking not found']);
    //         }

    //         // Update booking payment status
    //         $booking->payment_status = 'paid';
    //         $booking->save();

    //         Session::flash('success', 'Payment successful!');

    //         return redirect()->route('homepage')->with('message', 'Reservation confirmed and payment completed.');
    //     } catch (\Exception $e) {
    //         // Handle payment failure (e.g., display error message)
    //         return redirect()->route('homepage')->with('error', $e->getMessage());
    //     }
    // }





    public function success()
    {
        return view('frontend.booking.success');
    }

    // public function complete(Request $request)
    // {
    //     $validated = $request->validate([
    //         'booking_id' => 'required|exists:bookings,id',
    //         'amount' => 'required|numeric',
    //     ]);

    //     $booking = Booking::findOrFail($validated['booking_id']);

    //     // Process payment via Stripe
    //     try {
    //         $paymentIntent = \Stripe\PaymentIntent::create([
    //             'amount' => $validated['amount'] * 100, // Convert to cents
    //             'currency' => 'usd',
    //             'payment_method' => $request->input('payment_method_id'),
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //         ]);

    //         if ($paymentIntent->status === 'succeeded') {
    //             // Update booking payment status
    //             $booking->update(['payment_status' => 'paid']);

    //             return redirect()->route('booking.confirmation', $booking->id);
    //         }
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['Payment failed: ' . $e->getMessage()]);
    //     }
    // }


}
