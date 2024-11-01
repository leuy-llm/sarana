<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RoomType;
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
    public function showPaymentForm($totalAmount)
    {
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        return view('frontend.booking.payment', compact('totalAmount','settings','roomTypes'));
    }
    



    // public function processPayment(Request $request, $totalAmount,$reservationId)
    // {
    //     $reservation = Booking::findOrFail($reservationId);
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     try {
    //         // Create a PaymentIntent with the amount and currency
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => $totalAmount * 100, // amount in cents
    //             'currency' => 'usd',
    //             'description' => 'Reservation Payment',
    //             'payment_method' => $request->payment_method,
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //         ]);

           
    //         // Payment succeeded, mark the reservation as paid
    //         if ($paymentIntent->status == 'succeeded') {
    //             $reservation->status = 'paid';
    //             $reservation->save();

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Payment successful!',
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'error' => 'Payment failed!',
    //             ], 500);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ]);
    //     }
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
    //     Session::flash('success', 'Payment successful!');
    //     return back();

    // }
    
    public function processPayment(Request $request, $totalAmount)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        try {
            Charge::create([
                "amount" => $totalAmount * 100, // Convert amount to cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Reservation Payment.",
            ]);
    
            // Update booking payment status to 'paid'
            $booking = Booking::findOrFail($request->id);
            $booking->payment_status = 'paid';
            $booking->save();
    
            Session::flash('success', 'Payment successful!');
            return redirect()->route('bookings.index')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            Session::flash('error', 'Payment failed: ' . $e->getMessage());
            return back();
        }
    }
    






    public function success()
    {
        return view('frontend.booking.success');
    }
}
