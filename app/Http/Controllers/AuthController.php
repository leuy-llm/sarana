<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use App\Models\UserQuery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function Auth()
    {
        return view('auth.login');
    }
    public function logindash(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        // Check if "Remember Me" is checked
        $remember = $request->has('remember');

        // Attempt login with Remember Me
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password], $remember)) {
            // Store name and password in cookies if "Remember Me" is checked
            if ($remember) {
                Cookie::queue('remember_name', $request->name, 43200); // Store for 30 days (43200 minutes)
                Cookie::queue('remember_password', $request->password, 43200); // Store for 30 days
            } else {
                Cookie::queue(Cookie::forget('remember_name'));
                Cookie::queue(Cookie::forget('remember_password'));
            }

            return redirect()->route('app'); // Redirect to dashboard
        } else {
            return redirect()->back()->withErrors(['name' => 'Invalid username or password.']);
        }
    }

    // // Helper method to get booking count with optional status filter
    private function getBookingCount($startDate, $status = null)
    {
        $query = Booking::query();

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($status) {
            $query->where('status', $status); // Assuming status column is 'confirmed' or 'cancelled'
        }

        return $query->count();
    }

    // // Helper method to get guest count
    private function getGuestCount($startDate, $previous = false)
    {
        $query = Guest::getGuest();

        if ($startDate) {
            if ($previous) {
                $query->whereBetween('created_at', [now()->subDays(2 * $startDate->diffInDays()), $startDate]);
            } else {
                $query->where('created_at', '>=', $startDate);
            }
        }
        return $query->count();
    }

    // // Helper method to get user queries count based on the time range
    private function getQueriesCount($startDate)
    {
        $query = UserQuery::getUserQuery();
        // If a startDate is provided, filter the queries based on the created_at field
        if ($startDate) {
            $query->where('created_at', '>=', $startDate);  // Filter by date range
        }

        // Return the count of user queries in the selected time range
        return $query->count();
    }

    public function dashboards(Request $request)
    {
        // Get the selected time range for bookings and queries
        $timeRange = request('time_range', '30'); // Default to "Past 30 Days" for bookings if not set
        $timeRanges = request('time_ranges', '30'); // Default to "Past 30 Days" for queries if not set

        // Determine the date range based on filter
        $filter = $request->query('filter', 'today');
        $filter = $request->query('filter', 'all_time');
        $startDate = null;
        $endDate = Carbon::now();
        switch ($filter) {
            case 'today':
                $startDate = Carbon::now()->startOfDay();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday()->endOfDay();
                break;
            case 'last_week':
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'all_time':
            default:
                // No date filter, show all records
                $startDate = null;
                $endDate = null;
                break;
        }

        // // Determine the start date based on the selected booking time range
        $bookingStartDate = $this->getStartDate($timeRange);
        $queryStartDate = $this->getStartDate($timeRanges);
        // Fetch analytics based on the selected time range
        $currentBookings = $this->getBookingCount($bookingStartDate);
        $currentQueries = $this->getQueriesCount($queryStartDate);

        $currentGuests = $this->getGuestCount($queryStartDate); // Booking time range

        $confirmedBookings = $this->getBookingCount($bookingStartDate, 'Reservied'); // Book
        $cancelledBookings = $this->getBookingCount($bookingStartDate, 'Cancelled');
        $pendingBookings = $this->getBookingCount($bookingStartDate, 'Pending');

        $currentRooms = Room::count();
        $currentRoomTypes = RoomType::count();
        $currentUsers = User::count();
        $header_title =   __('label.dashboard');

        $guestsStayingToday = Booking::where('status', 'Checked-In')
            ->whereDate('check_in_date', '<=', Carbon::today())
            ->whereDate('check_out_date', '>=', Carbon::today())
            ->count();

        $checkInsToday = Booking::where('status', 'Checked-In')
            ->whereDate('check_in_date', Carbon::today())
            ->count();

        // Count checked-out today
        $checkOutsToday = Booking::where('status', 'Checked-Out')
            ->whereDate('check_out_date', Carbon::today())
            ->count();

        $roomTypeBookings = Booking::join('booking_rooms', 'bookings.id', '=', 'booking_rooms.booking_id') // Join with booking_rooms pivot table
            ->join('rooms', 'booking_rooms.room_id', '=', 'rooms.id') // Use room_id from booking_rooms
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id') // Join with room_types
            ->select('room_types.type_name as room_type', DB::raw('COUNT(bookings.id) as bookings_count'))
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('bookings.created_at', [$startDate, $endDate]);
            })
            ->groupBy('room_types.type_name')
            ->get();
        //Monthly Booking Report Groups by YEAR(check_in_date) and MONTH(check_in_date), meaning it counts bookings per month 📆.
        $monthlyBookings = Booking::selectRaw('YEAR(check_in_date) as year, MONTH(check_in_date) as month, COUNT(*) as total_bookings')
            ->where('status', 'Reserved') // You can adjust this condition based on your needs
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                $monthName = Carbon::createFromDate($item->year, $item->month)->format('M');
                return [$monthName => $item->total_bookings];
            });

        $startDate = $request->query('start_date', Carbon::now()->subMonth());
        $endDate = $request->query('end_date', Carbon::now());

        // Occupancy Report Groups by DATE(check_in_date), meaning it counts bookings per day 📅.
        $occupancyReport = Booking::selectRaw('DATE(check_in_date) as date, COUNT(*) as occupied_rooms')
            ->whereBetween('check_in_date', [$startDate, $endDate])
            ->groupBy('date')
            ->get();
        $monthlyBookingss = $occupancyReport->pluck('occupied_rooms', 'date')->toArray();

        // Booking Source Analysis
        $bookingSourceData = Booking::selectRaw("booking_source, COUNT(*) as count")
            ->groupBy('booking_source')
            ->pluck('count', 'booking_source')
            ->toArray();
        $bookingStatusCounts = Booking::selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Define all possible statuses
        $statuses = ['Pending', 'Reserved', 'Checked-In', 'Checked-Out', 'Completed', 'Cancelled'];

        $bookingData = [];
        foreach ($statuses as $status) {
            $bookingData[$status] = $bookingStatusCounts[$status] ?? 0; // Default to 0 if status is missing
        }

        // dd($bookingData);
        return view('dashboard', compact(
            'bookingData',
            'currentBookings',
            'currentQueries',
            'timeRange',
            'timeRanges',
            'currentGuests',
            'currentRooms',
            'currentRoomTypes',
            'currentUsers',
            'confirmedBookings',
            'pendingBookings',
            'cancelledBookings',
            'checkInsToday',
            'guestsStayingToday',
            'checkOutsToday',
            'roomTypeBookings',
            'filter',
            'monthlyBookings',
            'monthlyBookingss',
            'header_title',
            'bookingSourceData',
            'occupancyReport'  // Assuming occupancyReport is a collection of Booking objects with 'check_in_date' and 'total_rooms' fields  // You can adjust this according to your database structure  // Add more fields as needed to create a complete occupancy report  // Use Carbon::now()->startOfMonth() and Carbon::now()->endOfMonth() if you want to show the report for the current month by default  // Use Carbon::now()->subMonth

        ));
    }
    // Helper method to get start date based on the selected range
    private function getStartDate($range)
    {
        switch ($range) {
            case '30':
                return now()->subDays(30);
            case 'all':
            default:
                return null; // No date filter for "All Time"
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/logindash');
    }
}
