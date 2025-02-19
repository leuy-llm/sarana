<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingRoom;
use App\Models\Room;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use PDF;

class ReportController extends Controller
{
    //
    public function index()
    {
        $header_title = "Generate Reports";
        return view('back_end.reports.index', compact('header_title'));
    }
    public function showReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch the statistics
        $guestStatistics = Booking::selectRaw('SUM(booking_rooms.total_adults) as total_adults, 
        SUM(booking_rooms.total_children) as total_children, 
        AVG(booking_rooms.total_adults + booking_rooms.total_children) as avg_party_size')
            ->join('booking_rooms', 'booking_rooms.booking_id', '=', 'bookings.id')
            ->whereBetween('bookings.check_in_date', [$startDate, $endDate])
            ->first();

        return view('back_end.reports.index', compact('guestStatistics', 'startDate', 'endDate'));
    }

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

    public function roomReservationReport(Request $request)
    {
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
        // Pass the data to the view
        return view('back_end.reports.room_report', compact('rooms', 'request'));

        // Count bookings based on status
    }
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
        $pdf = PDF::loadView('back_end.reports.reservations_pdf', compact('reservations', 'statusBreakdown', 'totalReservations', 'totalGuests', 'request', 'tatalPaid', 'totalUnpaid'))
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
        // $occupiedRooms = Booking::whereIn('status', ['Reserved', 'Checked-In'])
        //     ->whereHas('rooms', function ($query) {
        //         $query->where('is_deleted', 0);
        //     })
        //     ->count();
        $occupiedRooms = DB::table('booking_rooms')
            ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
            ->join('rooms', 'booking_rooms.room_id', '=', 'rooms.id')
            ->whereIn('bookings.status', ['Reserved', 'Checked-In'])
            ->where('rooms.is_deleted', 0)
            ->distinct('booking_rooms.room_id')
            ->count();


        // Count of occupied rooms
        $vacantRooms = $totalRooms - $occupiedRooms;

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

    public function bookingSourceReport(Request $request)
    {
        $query = DB::table('bookings')
            ->join('booking_rooms', 'bookings.id', '=', 'booking_rooms.booking_id')
            ->join('rooms', 'booking_rooms.room_id', '=', 'rooms.id')
            ->selectRaw('
                bookings.booking_source,
                COUNT(DISTINCT bookings.id) as total_bookings,
                SUM(CASE WHEN bookings.payment_status = "paid" THEN rooms.special_price ELSE 0 END) as total_revenue
            ')
            ->when($request->start_date, function ($q) use ($request) {
                $q->whereDate('bookings.check_in_date', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($q) use ($request) {
                $q->whereDate('bookings.check_out_date', '<=', $request->end_date);
            })
            ->groupBy('bookings.booking_source')
            ->get();

        return view('back_end.reports.booking-analysis', compact('query'));
    }
}
