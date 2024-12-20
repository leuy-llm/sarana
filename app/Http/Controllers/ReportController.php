<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    //
    public function index()
    {
        $header_title = "Generate Reports";
        return view('back_end.reports.index', compact('header_title'));
    }

    public function reservationReport(Request $request)
    {
        // Fetch reservations based on the date range, or all if no range provided
        $query = Booking::with(['guest', 'room.roomType'])
            ->whereHas('room', function ($query) {
                $query->where('is_deleted', 0); // Exclude deleted rooms
            })
            ->whereHas('guest', function ($query) {
                $query->where('is_deleted', 0); // Exclude deleted guests
            });

        // Apply date filters if provided
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
        }

        $reservations = $query->get();

        // Pass the data to the view
        return view('back_end.reports.reservations', compact('reservations', 'request'));
    }

    // public function exportReservationReport(Request $request)
    // {
    //     $query = Booking::with(['guest', 'room.roomType'])
    //         ->whereHas('room', function ($query) {
    //             $query->where('is_deleted', 0);
    //         })
    //         ->whereHas('guest', function ($query) {
    //             $query->where('is_deleted', 0);
    //         });

    //     if ($request->start_date && $request->end_date) {
    //         $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
    //     }

    //     $reservations = $query->get();

    //     $pdf = PDF::loadView('back_end.reports.reservations_pdf', compact('reservations'));

    //     return $pdf->download('reservation_report.pdf');
    // }
//     public function exportReservationReport(Request $request)
// {
//     $request->validate([
//         'start_date' => 'nullable|date',
//         'end_date' => 'nullable|date|after_or_equal:start_date',
//     ]);

//     $query = Booking::with(['guest', 'room.roomType'])
//         ->whereHas('room', function ($query) {
//             $query->where('is_deleted', 0);
//         })
//         ->whereHas('guest', function ($query) {
//             $query->where('is_deleted', 0);
//         });

//     if ($request->start_date && $request->end_date) {
//         $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
//     }

//     $reservations = $query->get();

//     try {
//         $pdf = PDF::loadView('back_end.reports.reservations_pdf', compact('reservations'));
//         return $pdf->download('reservation_report.pdf');
//     } catch (\Exception $e) {
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// }

public function exportReservationReport(Request $request)
{

    $query = Booking::with(['guest', 'room.roomType'])
        ->whereHas('room', function ($query) {
            $query->where('is_deleted', 0);
        })
        ->whereHas('guest', function ($query) {
            $query->where('is_deleted', 0);
        });

    if ($request->start_date && $request->end_date) {
        $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
    }

    $reservations = $query->get();

    $pdf = PDF::loadView('back_end.reports.reservations_pdf', compact('reservations'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('reservation_report.pdf');
}


}
