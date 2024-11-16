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
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function Auth()
    {

        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            return redirect()->route('app');
        } else {
            return redirect()->back()->withErrors(['name' => 'Invalid name or password.']);
        }
    }


    // public function dashboard()
    // {
    //     // Get the selected time range from the request
    //     $timeRange = request('time_range', '30'); // Default to "Past 30 Days" if not set

    //     // Determine the start date based on the selected range
    //     switch ($timeRange) {
    //         case '30':
    //             $startDate = now()->subDays(30);
    //             break;
    //         case '90':
    //             $startDate = now()->subDays(90);
    //             break;
    //         case '365':
    //             $startDate = now()->subDays(365);
    //             break;
    //         case 'all':
    //         default:
    //             $startDate = null; // No date filter for "All Time"
    //             break;
    //     }

    //     // Fetch current counts based on the selected time range
    //     $currentGuests = $this->getGuestCount($startDate);
    //     $currentBookings = $this->getBookingCount($startDate);
    //     $currentRooms = Room::count();
    //     $currentRoomTypes = RoomType::count();
    //     $currentUsers = User::getUser()->count();

    //     // Fetch previous counts (for growth percentage calculation)
    //     $previousGuests = $this->getGuestCount($startDate, true);
    //     $previousBookings = $this->getBookingCount($startDate, true);

    //     // Calculate growth percentages
    //     $guestGrowth = $this->calculatePercentageChange($previousGuests, $currentGuests);
    //     $bookingGrowth = $this->calculatePercentageChange($previousBookings, $currentBookings);

    //     return view('dashboard', compact(
    //         'currentGuests', 'currentBookings','currentUsers', 'currentRooms', 'currentRoomTypes',
    //         'guestGrowth', 'bookingGrowth', 'timeRange'
    //     ));
    // }

    // Helper method to get guest count
    // private function getGuestCount($startDate, $previous = false)
    // {
    //     $query = Guest::getGuest();

    //     if ($startDate) {
    //         if ($previous) {
    //             $query->whereBetween('created_at', [now()->subDays(2 * $startDate->diffInDays()), $startDate]);
    //         } else {
    //             $query->where('created_at', '>=', $startDate);
    //         }
    //     }

    //     return $query->count();
    // }

    // // Helper method to get booking count
    // private function getBookingCount($startDate, $previous = false)
    // {
    //     $query = Booking::query();

    //     if ($startDate) {
    //         if ($previous) {
    //             $query->whereBetween('created_at', [now()->subDays(2 * $startDate->diffInDays()), $startDate]);
    //         } else {
    //             $query->where('created_at', '>=', $startDate);
    //         }
    //     }

    //     return $query->count();
    // }

    // // Percentage calculation method
    // private function calculatePercentageChange($previous, $current)
    // {
    //     if ($previous == 0) {
    //         return $current > 0 ? 100 : 0;
    //     }
    //     return round((($current - $previous) / $previous) * 100, 2);
    // }



    // public function dashboard()
    // {
    //     // Get the selected time range for bookings and queries
    //     $timeRange = request('time_range', '30'); // Default to "Past 30 Days" for bookings if not set
    //     $timeRanges = request('time_ranges', '30'); // Default to "Past 30 Days" for queries if not set
    //     $header_title = "Dashboard for";
    //     // Determine the start date based on the selected booking time range
    //     switch ($timeRange) {
    //         case '30':
    //             $bookingStartDate = now()->subDays(30);
    //             break;
    //         case '90':
    //             $bookingStartDate = now()->subDays(90);
    //             break;
    //         case '365':
    //             $bookingStartDate = now()->subDays(365);
    //             break;
    //         case 'all':
    //         default:
    //             $bookingStartDate = null; // No date filter for "All Time"
    //             break;
    //     }

    //     // Determine the start date based on the selected query time range
    //     switch ($timeRanges) {
    //         case '30':
    //             $queryStartDate = now()->subDays(30);
    //             break;
    //         case '90':
    //             $queryStartDate = now()->subDays(90);
    //             break;
    //         case '365':
    //             $queryStartDate = now()->subDays(365);
    //             break;
    //         case 'all':
    //         default:
    //             $queryStartDate = null; // No date filter for "All Time"
    //             break;
    //     }

    //     // Fetch current counts based on the selected time range
    //     $currentGuests = $this->getGuestCount($bookingStartDate); // Booking time range
    //     $currentBookings = $this->getBookingCount($bookingStartDate);
    //     $currentQueries = $this->getQueriesCount($queryStartDate); // Query time range
    //     $currentNewRegistrations = $this->getNewRegistrationsCount($queryStartDate);
    //     $currentRooms = Room::count();
    //     $currentRoomTypes = RoomType::count();
    //     $currentUsers = User::count();

    //     // Fetch booking analytics (Confirmed, Cancelled, Pending)
    //     $confirmedBookings = $this->getBookingCount($bookingStartDate, 'confirmed');
    //     $cancelledBookings = $this->getBookingCount($bookingStartDate, 'cancelled');
    //     $pendingBookings = $this->getBookingCount($bookingStartDate, 'pending');

    //     // Calculate growth percentages
    //     $previousGuests = $this->getGuestCount($bookingStartDate, true);
    //     $previousBookings = $this->getBookingCount($bookingStartDate, true);
    //     $previousQueries = $this->getQueriesCount($queryStartDate); // Get previous queries count for comparison
    //     $previousRegistrations = $this->getNewRegistrationsCount($queryStartDate, true);

    //     $guestGrowth = $this->calculatePercentageChange($previousGuests, $currentGuests);
    //     $bookingGrowth = $this->calculatePercentageChange($previousBookings, $currentBookings);
    //     $queriesGrowth = $this->calculatePercentageChange($previousQueries, $currentQueries); // Growth for queries

    //     return view('dashboard', compact(
    //         'currentGuests',
    //         'currentBookings',
    //         'confirmedBookings',
    //         'pendingBookings',
    //         'cancelledBookings',
    //         'currentUsers',
    //         'currentRooms',
    //         'currentQueries',
    //         'currentRoomTypes',
    //         'guestGrowth',
    //         'bookingGrowth',
    //         'queriesGrowth',
    //         'timeRange',
    //         'timeRanges',
    //         'header_title',
    //         'currentNewRegistrations'
    //     ));
    // }

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


    private function getNewRegistrationsCount($startDate, $previous = false)
    {
        $query = Guest::getGuest();

        if ($startDate) {
            if ($previous) {
                $query->whereBetween('created_at', [now()->subDays(2 * $startDate->diffInDays()), $startDate]);
            } else {
                $query->where('created_at', '>=', $startDate);
            }
        }
    }



    // // Helper method to calculate percentage change
    // private function calculatePercentageChange($previous, $current)
    // {
    //     if ($previous == 0) {
    //         return $current > 0 ? 100 : 0;
    //     }
    //     return round((($current - $previous) / $previous) * 100, 2);
    // }

    public function dashboard(Request $request)
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

        // Determine the start date based on the selected booking time range
        $bookingStartDate = $this->getStartDate($timeRange);
        $queryStartDate = $this->getStartDate($timeRanges);

        // Fetch analytics based on the selected time range
        $currentBookings = $this->getBookingCount($bookingStartDate);
        $currentQueries = $this->getQueriesCount($queryStartDate);
        $currentNewRegistrations = $this->getNewRegistrationsCount($queryStartDate);
        $currentGuests = $this->getGuestCount($queryStartDate); // Booking time range

        $confirmedBookings = $this->getBookingCount($bookingStartDate, 'confirmed');
        $cancelledBookings = $this->getBookingCount($bookingStartDate, 'cancelled');
        $pendingBookings = $this->getBookingCount($bookingStartDate, 'pending');
        $currentRooms = Room::count();
        $currentRoomTypes = RoomType::count();
        $currentUsers = User::count();
        $header_title = "Dashboard";

        // $roomTypeBookings = Booking::join('rooms', 'bookings.room_id', '=', 'rooms.id')
        // ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
        // ->select('room_types.type_name as room_type',DB::raw('COUNT(bookings.id) as bookings_count'))
        // ->groupBy('room_types.type_name')
        // ->get();
         // Fetch bookings data based on the selected date range
         $roomTypeBookings = Booking::join('rooms', 'bookings.room_id', '=', 'rooms.id')
         ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
         ->select('room_types.type_name as room_type',DB::raw('COUNT(bookings.id) as bookings_count'))
         ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
             return $query->whereBetween('bookings.created_at', [$startDate, $endDate]);
         })
         ->groupBy('room_types.type_name')
         ->get();

        //  $bookingStatusCounts = Booking::select('status',DB::raw('count(*) as total'))
        //  ->groupBy('status')
        //  ->pluck('total', 'status')
        //  ->toArray();
 

        // Fetch the number of bookings per month for the current year
    $monthlyBookings = Booking::selectRaw('YEAR(check_in_date) as year, MONTH(check_in_date) as month, COUNT(*) as total_bookings')
    ->where('status', 'confirmed') // You can adjust this condition based on your needs
    ->groupBy('year', 'month')
    ->orderBy('year')
    ->orderBy('month')
    ->get()
    ->mapWithKeys(function ($item) {
        $monthName = Carbon::createFromDate($item->year, $item->month)->format('M');
        return [$monthName => $item->total_bookings];
    });



        return view('dashboard', compact(
            'currentBookings',
            'currentQueries',
            'currentNewRegistrations',
            'timeRange',
            'timeRanges',
            'currentGuests',
            'currentRooms',
            'currentRoomTypes',
            'currentUsers',
            'confirmedBookings',
            'pendingBookings',
            'cancelledBookings',
            'roomTypeBookings',
            'filter',
            'monthlyBookings',
            'header_title'
            
        
        ));
    }

    // Helper method to get start date based on the selected range
    private function getStartDate($range)
    {
        switch ($range) {
            case '30':
                return now()->subDays(30);
            case '90':
                return now()->subDays(90);
            case '365':
                return now()->subDays(365);
            case 'all':
            default:
                return null; // No date filter for "All Time"
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
