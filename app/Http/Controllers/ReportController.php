<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
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

    // public function reservationReport(Request $request)
    // {
    //     // Fetch reservations based on the date range, or all if no range provided
    //     $query = Booking::with(['guest', 'rooms.roomType'])
    //         ->whereHas('rooms', function ($query) {
    //             $query->where('is_deleted', 0); // Exclude deleted rooms
    //         })
    //         ->whereHas('guest', function ($query) {
    //             $query->where('is_deleted', 0); // Exclude deleted guests
    //         });

    //     // Apply date filters if provided
    //     if ($request->start_date && $request->end_date) {
    //         $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
    //     }

    //     $reservations = $query->get();

    //     // Pass the data to the view
    //     return view('back_end.reports.reservations', compact('reservations', 'request'));
    // }

    public function reservationReport(Request $request)
    {
        // Fetch reservations with relationships
        $query = Booking::with(['guest', 'rooms.roomType'])
            ->whereHas('rooms', function ($query) {
                $query->where('is_deleted', 0);
            })
            ->whereHas('guest', function ($query) {
                $query->where('is_deleted', 0);
            });

        // Apply date filters if provided
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
        }

        // Execute the query
        $reservations = $query->get();

        // Count bookings based on status *after applying date range*
        $statusBreakdown = [
            'Reserved' => $reservations->where('status', 'Reserved')->count(),
            'Pending' => $reservations->where('status', 'Pending')->count(),
            'Cancelled' => $reservations->where('status', 'Cancelled')->count(),
            'Checked-In' => $reservations->where('status', 'Checked-In')->count(),
            'Checked-Out' => $reservations->where('status', 'Checked-Out')->count(),
            'Completed' => $reservations->where('status', 'Completed')->count(),
            'Total' => $reservations->count(),
        ];

        // Pass the data to the view
        return view('back_end.reports.reservations', compact('reservations', 'statusBreakdown', 'request'));
    }

    public function roomReservationReport(Request $request){
        $query = Room::with(['roomType', 'bookings.guest'])
            ->whereHas('bookings', function ($query) {
                $query->where('is_deleted', 0);
            });

        if ($request->start_date && $request->end_date) {
            $query->whereHas('bookings', function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
            });
        }

        $rooms = $query->get();
        // Log the rooms data for debugging
        // Log::info('Available rooms:', $rooms->toArray());

        // Pass the data to the view
        return view('back_end.reports.room_report', compact('rooms', 'request'));

        // Count bookings based on status

    }


    // public function exportReservationReport(Request $request)
    // {
    //     $query = Booking::with(['guest', 'rooms.roomType'])
    //         ->whereHas('rooms', function ($query) {
    //             $query->where('is_deleted', 0);
    //         })
    //         ->whereHas('guest', function ($query) {
    //             $query->where('is_deleted', 0);
    //         });

    //     if ($request->start_date && $request->end_date) {
    //         $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
    //     }
    //     $reservations = $query->get();

    //     // Count bookings based on status
    //     $statusBreakdown = [
    //         'Reserved' => $reservations->where('status', 'Reserved')->count(),
    //         'Pending' => $reservations->where('status', 'Pending')->count(),
    //         'Cancelled' => $reservations->where('status', 'Cancelled')->count(),
    //         'Checked-In' => $reservations->where('status', 'Checked-In')->count(),
    //         'Checked-Out' => $reservations->where('status', 'Checked-Out')->count(),
    //         'Completed' => $reservations->where('status', 'Completed')->count(),
    //         'Total' => $reservations->count(),
    //     ];

    //     // Load PDF view with reservations and status breakdown
    //     $pdf = PDF::loadView('back_end.reports.reservations_pdf', compact('reservations', 'statusBreakdown', 'request'))
    //         ->setPaper('a4', 'landscape');
    //     $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
    //     $pdf->getDomPDF()->getOptions()->set('isRemoteEnabled', true);

    //     return $pdf->download('reservation_report.pdf');
    // }

    public function exportReservationReport(Request $request)
{
    $query = Booking::with(['guest', 'rooms.roomType'])
        ->whereHas('rooms', function ($query) {
            $query->where('is_deleted', 0);
        })
        ->whereHas('guest', function ($query) {
            $query->where('is_deleted', 0);
        });

    if ($request->start_date && $request->end_date) {
        $query->whereBetween('check_in_date', [$request->start_date, $request->end_date]);
    }
    
    $reservations = $query->get();

    // Count bookings based on status
    $statusBreakdown = [
        'Reserved' => $reservations->where('status', 'Reserved')->count(),
        'Pending' => $reservations->where('status', 'Pending')->count(),
        'Cancelled' => $reservations->where('status', 'Cancelled')->count(),
        'Checked-In' => $reservations->where('status', 'Checked-In')->count(),
        'Checked-Out' => $reservations->where('status', 'Checked-Out')->count(),
        'Completed' => $reservations->where('status', 'Completed')->count(),
        'Total' => $reservations->count(),
    ];

    // Calculate total reservations and total guests
    $totalReservations = $reservations->count();
    $totalGuests = $reservations->pluck('guest_id')->unique()->count(); // Unique guests
    $tatalPaid = $reservations->where('payment_status', 'Paid')->count();
    $totalUnpaid = $reservations->where('payment_status', 'Unpaid')->count();
    
    
    // Load PDF view with all necessary data
    $pdf = PDF::loadView('back_end.reports.reservations_pdf', compact('reservations','statusBreakdown', 'totalReservations', 'totalGuests', 'request','tatalPaid','totalUnpaid'))
        ->setPaper('a4', 'landscape');
    $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
    $pdf->getDomPDF()->getOptions()->set('isRemoteEnabled', true);

    return $pdf->download('reservation_report.pdf');
}


public function exportRoomOccupancyReport(Request $request)
{
    // Get total rooms and count occupied rooms
    $totalRooms = Room::where('is_deleted', 0)
    ->where('status', 1)
    ->count();
    $occupiedRooms = Booking::whereIn('status', ['Reserved', 'Checked-In'])
                            ->whereHas('rooms', function ($query) {
                                $query->where('is_deleted', 0);
                            })
                            ->count();  // Count of occupied rooms
    
    $vacantRooms = $totalRooms - $occupiedRooms;  // Vacant rooms
    $occupancyRate = $totalRooms > 0 ? ($occupiedRooms / $totalRooms) * 100 : 0;  // Occupancy rate

    // Get room details
    $rooms = Room::with(['bookings' => function ($query) {
        $query->whereIn('status', ['Reserved', 'Checked-In']);
    }])->where('is_deleted', 0)->get();

    // Load PDF view with room occupancy data
    $pdf = PDF::loadView('back_end.reports.room_occupancy_pdf', compact('rooms', 'totalRooms', 'occupiedRooms', 'vacantRooms', 'occupancyRate'))
              ->setPaper('a4', 'landscape');
    $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
    $pdf->getDomPDF()->getOptions()->set('isRemoteEnabled', true);

    return $pdf->download('room_occupancy_report.pdf');
}

}
