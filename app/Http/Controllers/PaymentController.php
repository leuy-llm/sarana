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
    public function showPaymentForm($bookingId,$totalAmount)
    {
        $settings = DB::table('settings')->get();
        $roomTypes = RoomType::whereIn('type_name', ['Deluxe Double Room', 'Deluxe Twin Room', 'Studio Suite Room', 'Family 3 bedroom', 'Trip Room', 'King Room'])->get();
        return view('frontend.booking.payment', compact('totalAmount', 'settings', 'roomTypes', 'bookingId'));
    }
    


    public function processPayment(Request $request,$totalAmount)

    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create ([
                "amount" => $totalAmount * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,
                
                "description" => "Reservation Payment ." ,
        ]);
        // $totalAmount = $request->input('total_amount');
        Session::flash('success', 'Payment successful!');
        return back();

    }
    
    // public function processPayment(Request $request, $totalAmount)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));
    
    //     try {
    //         Charge::create([
    //             "amount" => $totalAmount * 100, // Convert amount to cents
    //             "currency" => "usd",
    //             "source" => $request->stripeToken,
    //             "description" => "Reservation Payment.",
    //         ]);
    
    //         // Update booking payment status to 'paid'
    //         $booking = Booking::findOrFail($request->id);
    //         $booking->payment_status = 'paid';
    //         $booking->save();
    
    //         Session::flash('success', 'Payment successful!');
    //         return redirect()->route('bookings.index')->with('success', 'Payment successful!');
    //     } catch (\Exception $e) {
    //         Session::flash('error', 'Payment failed: ' . $e->getMessage());
    //         return back();
    //     }
    // }
    






    public function success()
    {
        return view('frontend.booking.success');
    }
}
