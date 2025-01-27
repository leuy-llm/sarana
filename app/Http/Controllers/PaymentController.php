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
    // Stripe::setApiKey(env('STRIPE_SECRET'));

    // public function processPayment(Request $request)
    // {
    //     Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

    //     // Retrieve the authenticated guest
    //     $guest = auth()->guard('guest')->user();
    //     if (!auth('guest')->check()) {
    //         return redirect()->route('guest-login')->with('error', 'Please log in to complete the checkout.');
    //     }

    //     // Retrieve room and booking details from the request
    //     $room = Room::find($request->input('room_id'));
    //     $bookingData = [
    //         'room_id' => $room->id,
    //         'guest_id' => $guest->id,
    //         'check_in_date' => $request->input('check_in'),
    //         'check_out_date' => $request->input('check_out'),
    //         'total_adults' => $request->input('adults'),
    //         'total_children' => $request->input('children'),
    //         'payment_status' => "Unpaid",
    //         'status' => 'Pending',  // Initially set booking status to 'pending'
    //     ];
    //     // Create the booking record
    //     $booking = Booking::create($bookingData);
    //     try {
    //         // Create a PaymentIntent with the specified amount and currency
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => $request->input('amount') * 100, // Convert to cents
    //             'currency' => 'usd',
    //             'payment_method' => $request->input('stripeToken'),
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //             'customer' => $guest->stripe_id ?? null,
    //             // 'description' => 'Room booking payment for booking #' . $booking->id,
    //             'description' => 'Room booking payment for booking #' . $booking->id,
    //             'return_url' => route('payment.success') // Define a return URL for success
    //         ]);
    //         // Check if the payment was successful
    //         if ($paymentIntent->status === 'succeeded') {
    //             // Update the booking status to 'confirmed' once the payment is successful
    //             $booking->status = 'Reserved';
    //             $booking->payment_status = 'Paid';
    //             $booking->save();
    //             // Create a new payment record
    //             $payment = new Payment();
    //             $payment->guest_id = $guest->id;
    //             $payment->booking_id = $booking->id; // Associate the payment with the booking
    //             $payment->amount = $request->input('amount');
    //             $payment->payment_intent_id = $paymentIntent->id; // Store payment_intent_id in the payment table
    //             $payment->status = $paymentIntent->status;
    //             $payment->currency = 'usd';
    //             $payment->payment_method = 'card';
    //             $payment->save();
    //             Mail::to($guest->email)->send(new BookingStatusMail($booking, $guest, $payment));
    //             $payment->load('guest', 'room.roomType', 'booking');
    //             // Store payment details in the session
    //             session(['payment' => $payment]);
    //             return redirect()->route('payment.success')->with('success', 'Your booking has been submitted successfully. We just sent you a confirmation email to!' . $guest->email);
    //         } else {
    //             return redirect()->back()->with('error', 'Payment failed. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }

    // public function processPayment(Request $request)
    // {
    //     $request->validate([
    //         'room_id' => 'required|exists:rooms,id',
    //         'check_in' => 'required|date|after_or_equal:today',
    //         'check_out' => 'required|date|after:check_in',
    //         'adults' => 'required|integer|min:1',
    //         'children' => 'nullable|integer|min:0',
    //         'amount' => 'required|numeric|min:1',
    //         'stripeToken' => 'required|string',
    //     ]);

    //     if (!auth('guest')->check()) {
    //         return redirect()->route('guest-login')->with('error', 'Please log in to complete the checkout.');
    //     }

    //     $guest = auth()->guard('guest')->user();

    //     try {
    //         DB::transaction(function () use ($bookingData, $request, $guest) {

    //             $paymentIntent = PaymentIntent::create([
    //                 'amount' => $request->input('amount') * 100,
    //                 'currency' => 'usd',
    //                 'payment_method' => $request->input('stripeToken'),
    //                 'confirmation_method' => 'manual',
    //                 'confirm' => true,
    //                 'description' => 'Room booking payment for booking #' . $booking->id,
    //             ]);

    //             if ($paymentIntent->status === 'succeeded') {
    //                 $booking->update(['status' => 'Reserved', 'payment_status' => 'Paid']);
    //                 Payment::create([
    //                     'guest_id' => $guest->id,
    //                     'booking_id' => $booking->id,
    //                     'amount' => $request->input('amount'),
    //                     'payment_intent_id' => $paymentIntent->id,
    //                     'status' => $paymentIntent->status,
    //                     'currency' => 'usd',
    //                     'payment_method' => 'card',
    //                 ]);

    //                 Mail::to($guest->email)->send(new BookingStatusMail($booking, $guest));
    //             } else {
    //                 throw new \Exception('Payment failed.');
    //             }
    //         });

    //         return redirect()->route('payment.success')->with('success', 'Your booking was successful.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }

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

                // Create a payment record in the database
                // Payment::create([
                //     'booking_id' => $booking->id,
                //     'guest_id' => $guest->id, // Associate the payment with the guest_id = $guest->id;
                //     'amount' => $request->input('total_price'),
                //     'payment_intent_id' => $paymentIntent->id,
                //     'status' => $paymentIntent->status,
                //     'currency' => 'usd',
                //     'payment_method' => 'card',

                // ]);
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




    // public function paymentSuccess(Request $request)
    // {
    //     $contact = DB::table('contact_details')->get();
    //     $settings = DB::table('settings')->get();
    //     // Retrieve the payment from the session

    //     return view('frontend.payment.success',compact('contact','settings'));
    // }

    //     public function paymentSuccess(Request $request)
    // {
    //     $contact = DB::table('contact_details')->get();
    //     $settings = DB::table('settings')->get();

    //     // Retrieve the booking details based on the latest payment
    //     $payment = Payment::latest()->first(); // Get the latest payment record

    //     if (!$payment) {
    //         return redirect()->route('home')->with('error', 'Payment record not found.');
    //     }

    //     // Retrieve the booking associated with the payment
    //     $booking = Booking::with(['guest', 'rooms.roomType'])
    //         ->findOrFail($payment->booking_id);

    //     // Extract guest details and other booking info
    //     $data = [
    //         'payment_intent_id' => $payment->payment_intent_id,
    //         'first_name' => $booking->guest->first_name,
    //         'last_name' => $booking->guest->last_name,
    //         'email' => $booking->guest->email,
    //         'mobile' => $booking->guest->mobile,
    //         'room_type' => $booking->rooms->roomType->type_name,
    //         'check_in_date' => $booking->check_in_date,
    //         'check_out_date' => $booking->check_out_date,
    //         'total_adults' => $booking->total_adults,
    //         'total_children' => $booking->total_children,
    //         'amount' => $payment->amount,
    //     ];

    //     return view('frontend.payment.success', compact('contact', 'settings', 'data'));
    // }

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



    // public function create($booking_id)
    // {
    //     $booking = Booking::findOrFail($booking_id);

    //     return view('back_end.payment.create', [
    //         'booking' => $booking,
    //         'total_price' => request()->get('total_price'), // Total price passed from the booking controller

    //     ]);
    // }

    //     public function index($booking_id, Request $request)
    // {
    //     $booking = Booking::with('rooms')->findOrFail($booking_id);
    //     // Retrieve the total_price from the query parameters
    //     $totalPrice = $request->query('total_price');

    //     return view('frontend.payment.checkout', [
    //         'booking' => $booking,
    //         'totalPrice' => $totalPrice,  // Pass total_price to the view
    //     ]);
    // }

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





    // public function store(Request $request)
    // {
    //     // Retrieve the booking details from the request or database
    //     $booking = Booking::findOrFail($request->input('booking_id'));
    //     $totalPrice = $request->input('amount'); // Ensure 'amount' matches the frontend

    //     // Set Stripe API key
    //     \Stripe\Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

    //     try {
    //         // Create a PaymentIntent with a return_url
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
    //             'return_url' => route('payments.confirm'), // Set the return URL here
    //             'description' => 'Room booking payment for booking #' . $booking->id,
    //         ]);

    //         // Handle off-session confirmation
    //         if ($paymentIntent->status === 'requires_action') {
    //             // Redirect the user to the `return_url` for further action
    //             return redirect($paymentIntent->next_action->redirect_to_url->url);
    //         }

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

    //         // Redirect to the success page after successful payment
    //         return redirect()->route('payments.success', ['payment_id' => $payment->id]);
    //     } catch (\Stripe\Exception\CardException $e) {
    //         // Handle card-related errors
    //         return redirect()->route('payments.error', ['error' => $e->getMessage()]);
    //     } catch (\Exception $e) {
    //         // Handle other errors
    //         return redirect()->route('payments.error', ['error' => $e->getMessage()]);
    //     }
    // }

    // public function checkout(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     // Create a new Checkout Session
    //     $session = Session::create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => [[
    //             'price_data' => [
    //                 'currency' => 'usd',
    //                 'product_data' => [
    //                     'name' => 'Hotel Booking Payment',
    //                 ],
    //                 'unit_amount' => $request->amount, // Amount in cents
    //             ],
    //             'quantity' => 1,
    //         ]],
    //         'mode' => 'payment',
    //         'success_url' => route('stripe.success', ['booking_id' => $request->booking_id]),
    //         'cancel_url' => route('stripe.cancel', ['booking_id' => $request->booking_id]),
    //     ]);

    //     return redirect($session->url, 303);
    // }


    // public function confirm(Request $request)
    // {
    //     $paymentIntentId = $request->input('payment_intent');

    //     \Stripe\Stripe::setApiKey("sk_test_51QEuUNCtdzaqHN41Cm2ru7eI8A4bDUa8wOLByP9EvKJ5yOF9J3yg63RZBd0KNRd9c8Hp1ALwNyZRtc0tGQXGdIPm00Id438Bkl");

    //     try {
    //         // Retrieve the PaymentIntent
    //         $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

    //         // Check the status of the PaymentIntent
    //         if ($paymentIntent->status === 'succeeded') {
    //             // Update the payment record in your database
    //             $payment = Payment::where('payment_intent_id', $paymentIntent->id)->first();
    //             if ($payment) {
    //                 $payment->status = 'Approved';
    //                 $payment->save();
    //             }

    //             // Redirect to the success page
    //             return redirect()->route('payments.success', ['payment_id' => $payment->id]);
    //         } else {
    //             // Payment not successful
    //             return redirect()->route('payments.error', ['error' => 'Payment confirmation failed.']);
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->route('payments.error', ['error' => $e->getMessage()]);
    //     }
    // }

    // public function success($payment_id)
    // {
    //     $payment = Payment::findOrFail($payment_id); // Works because of the updated primaryKey in the model
    //     return view('back_end.payment.success', compact('payment'));
    // }

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
