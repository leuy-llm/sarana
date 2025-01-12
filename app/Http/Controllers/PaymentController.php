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
                // 'description' => 'Room booking payment for booking #' . $booking->id,
                'description' => 'Room booking payment for booking #' . $booking->id,
                'return_url' => route('payment.success') // Define a return URL for success
            ]);

            // Check if the payment was successful
            if ($paymentIntent->status === 'succeeded') {
                // Update the booking status to 'confirmed' once the payment is successful
                $booking->status = 'approved';
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

                // After creating the payment record and saving the data

                Mail::to($guest->email)->send(new BookingStatusMail($booking, $guest, $payment));

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



    // public function success()
    // {
    //     $data = "Payment";
    //     return view('back_end.payment======', compact('data'));
    // }

    /* ============== Payment ============== */
    public function payment()
    {
        $data = "Payment";
        $payments = Payment::with(['booking.guest', 'booking.room.roomType'])->get();

        return view('back_end.payment.index', compact('data', 'payments'));
    }

    public function create($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        return view('back_end.payment.create', [
            'booking' => $booking,
            'total_price' => request()->get('total_price'), // Total price passed from the booking controller

        ]);
    }



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'booking_id' => 'required|exists:bookings,id',
    //         'guest_id' => 'required|exists:guests,id',
    //         'amount' => 'required|numeric',
    //         'currency' => 'required|string',
    //         'payment_method' => 'required|string',
    //     ]);

    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    //     try {
    //         $paymentIntent = \Stripe\PaymentIntent::create([
    //             'amount' => $request->amount * 100, // Convert to cents
    //             'currency' => $request->currency,
    //             'payment_method' => $request->payment_method,
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //         ]);

    //         $payment = new Payment();
    //         $payment->booking_id = $request->booking_id;
    //         $payment->guest_id = $request->guest_id;
    //         $payment->amount = $request->amount;
    //         $payment->currency = $request->currency;
    //         $payment->status = $paymentIntent->status;
    //         $payment->payment_intent_id = $paymentIntent->id;
    //         $payment->payment_method = $paymentIntent->payment_method;
    //         $payment->save();

    //         return redirect()->route('bookings.index')->with('success', 'Payment successful!');
    //     } catch (\Stripe\Exception\CardException $e) {
    //         return back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }
    // public function store(Request $request)
    // {
    //     // Retrieve the booking details from the request or database
    //     $booking = Booking::findOrFail($request->input('booking_id'));
    //     $totalPrice = $request->input('amount'); // Ensure 'amount' field matches the frontend

    //     // Set Stripe API keys
    //     Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

    //     try {
    //         // Create PaymentIntent with the total price for the booking
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => $totalPrice * 100,
    //             'currency' => 'usd',
    //             'payment_method' => $request->input('stripeToken'),
    //             'confirm' => true, // Automatically confirm
    //         ]);
    //         // Store payment details in the database
    //         $payment = new Payment();
    //         $payment->booking_id = $booking->id;
    //         $payment->guest_id = $booking->guest_id;
    //         $payment->amount = $totalPrice;
    //         $payment->currency = 'USD';
    //         $payment->payment_intent_id = $paymentIntent->id;
    //         $payment->payment_method = 'card';
    //         $payment->status = 'Approved';
    //         $payment->save();
            
    //         Log::info('Stripe Token: ' . $request->input('stripeToken'));

    //         // Redirect to a success page after successful payment
    //         return redirect()->route('payments.success', ['payment_id' => $payment->id]);
    //     } catch (\Exception $e) {
    //         // Handle errors during the payment process
    //         return redirect()->route('payments.error', ['error' => $e->getMessage()]);
    //     }
    // }

//     public function store(Request $request)
// {
//     // Retrieve the booking details from the request or database
//     $booking = Booking::findOrFail($request->input('booking_id'));
//     $totalPrice = $request->input('amount'); // Ensure 'amount' matches the frontend

//     // Set Stripe API key
//     \Stripe\Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

//     try {
//         // Create a PaymentIntent
//         $paymentIntent = \Stripe\PaymentIntent::create([
//             'amount' => $totalPrice * 100, // Convert to cents
//             'currency' => 'usd',
//             'payment_method_data' => [
//                 'type' => 'card',
//                 'card' => [
//                     'token' => $request->input('stripeToken'), // Pass the token here
//                 ],
//             ],
//             'confirmation_method' => 'manual',
//             'confirm' => true,
//             'description' => 'Room booking payment for booking #' . $booking->id,
//             'return_url' => route('payments.success') // Define a return URL for success
//         ]);

//         // Store payment details in the database
//         $payment = new Payment();
//         $payment->booking_id = $booking->id;
//         $payment->guest_id = $booking->guest_id;
//         $payment->amount = $totalPrice;
//         $payment->currency = 'USD';
//         $payment->payment_intent_id = $paymentIntent->id;
//         $payment->payment_method = 'card';
//         $payment->status = $paymentIntent->status === 'succeeded' ? 'Approved' : 'Pending';
//         $payment->save();

//         // Redirect to a success page after successful payment
//         return redirect()->route('payments.success', ['payment_id' => $payment->id]);
//     } catch (\Stripe\Exception\CardException $e) {
//         // Handle card-related errors
//         return redirect()->route('payments.error', ['error' => $e->getMessage()]);
//     } catch (\Exception $e) {
//         // Handle other errors
//         return redirect()->route('payments.error', ['error' => $e->getMessage()]);
//     }
// }

public function store(Request $request)
{
    // Retrieve the booking details from the request or database
    $booking = Booking::findOrFail($request->input('booking_id'));
    $totalPrice = $request->input('amount'); // Ensure 'amount' matches the frontend

    // Set Stripe API key
    \Stripe\Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

    try {
        // Create a PaymentIntent with a return_url
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $totalPrice * 100, // Convert to cents
            'currency' => 'usd',
            'payment_method_data' => [
                'type' => 'card',
                'card' => [
                    'token' => $request->input('stripeToken'), // Pass the token here
                ],
            ],
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('payments.confirm'), // Set the return URL here
            'description' => 'Room booking payment for booking #' . $booking->id,
        ]);

        // Handle off-session confirmation
        if ($paymentIntent->status === 'requires_action') {
            // Redirect the user to the `return_url` for further action
            return redirect($paymentIntent->next_action->redirect_to_url->url);
        }

        // Store payment details in the database
        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->guest_id = $booking->guest_id;
        $payment->amount = $totalPrice;
        $payment->currency = 'USD';
        $payment->payment_intent_id = $paymentIntent->id;
        $payment->payment_method = 'card';
        $payment->status = $paymentIntent->status === 'succeeded' ? 'Approved' : 'Pending';
        $payment->save();

        // Redirect to the success page after successful payment
        return redirect()->route('payments.success', ['payment_id' => $payment->id]);
    } catch (\Stripe\Exception\CardException $e) {
        // Handle card-related errors
        return redirect()->route('payments.error', ['error' => $e->getMessage()]);
    } catch (\Exception $e) {
        // Handle other errors
        return redirect()->route('payments.error', ['error' => $e->getMessage()]);
    }
}

public function confirm(Request $request)
{
    $paymentIntentId = $request->input('payment_intent');

    \Stripe\Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

    try {
        // Retrieve the PaymentIntent
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

        // Check the status of the PaymentIntent
        if ($paymentIntent->status === 'succeeded') {
            // Update the payment record in your database
            $payment = Payment::where('payment_intent_id', $paymentIntent->id)->first();
            if ($payment) {
                $payment->status = 'Approved';
                $payment->save();
            }

            // Redirect to the success page
            return redirect()->route('payments.success', ['payment_id' => $payment->id]);
        } else {
            // Payment not successful
            return redirect()->route('payments.error', ['error' => 'Payment confirmation failed.']);
        }
    } catch (\Exception $e) {
        return redirect()->route('payments.error', ['error' => $e->getMessage()]);
    }
}





public function success($payment_id)
{
    $payment = Payment::findOrFail($payment_id); // Works because of the updated primaryKey in the model
    return view('back_end.payment.success', compact('payment'));
}

    public function error(Request $request)
{
    $errorMessage = $request->query('error', 'An error occurred.');
    return view('back_end.payment.error', compact('errorMessage'));
}

}
