<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Carousel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BookingCalenderController;
use App\Http\Controllers\BookTestController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MettingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserQueryController;
use App\Models\Booking;
use App\Models\BookingCalender;
use App\Models\Restaurant;
use App\Models\Room;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.home.index');
});
/*==================== Export Route =========== */
Route::get('guest/export/', [GuestController::class, 'export']);
/*================= HomePage ================= */
Route::get('/', [HomeController::class, 'index'])->name('homepage');
/*================= Contact ================  */
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
/* ================ Our Room ================ */
// Route::get('rooms',[HomeController::class,'ourroom'])->name('')
Route::get('room_detail/{id}/{type_name}', [HomeController::class, 'roomDetail'])->name('roomDetail');
Route::get('property', [HomeController::class, 'property'])->name('property');
Route::get('service', [HomeController::class, 'service'])->name('service');
Route::get('gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('meeting', [HomeController::class, 'meeting'])->name('meeting');
Route::get('restaurant', [HomeController::class, 'restaurant'])->name('restaurant');
Route::get('tour', [HomeController::class, 'tour'])->name('tour');
Route::get('/room/filter', [HomeController::class, 'filterRooms'])->name('rooms.filter');
Route::get('/filterRooms', [HomeController::class, 'Roomfilter'])->name('filterRooms');
Route::post('/rooms/sort', [HomeController::class, 'sortRooms'])->name('rooms.sort');
// Route::post('/rooms/sort', [HomeController::class, 'room'])->name('rooms.sort');

Route::get('room', [HomeController::class, 'rooms'])->name('room');
// Route::get('room', [HomeController::class, 'room'])->name('room');

/*================= Login =================== */
Route::get('logindash', [AuthController::class, 'Auth'])->name('logindash');
Route::post('/submit', [AuthController::class, 'logindash'])->name('submit_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('bookings/available-room-types/{checkin_date}', [BookingController::class, 'available_room_types']);
// Route::get('/reservation/confirmation/{id}', [ReservationController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.index');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/reservation', [ReservationController::class, 'reservation'])->name('reservation');
Route::get('/reservation/skip-payment/{id}/{totalAmount}', [ReservationController::class, 'skipPayment'])->name('booking.skipPayment');
// Route::get('books/{id}',[HomeController::class, 'booking'])->name('books');
Route::get('books/create', [HomeController::class, 'createBooking'])->name('books.create');

Route::get('booking/{room}', [BookingController::class, 'show'])->name('booking.show');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout.index');

Route::get('/rooms/available', [BookingCalender::class, 'showAvailableRooms'])->name('rooms.available');
Route::post('/booking/process', [BookingCalender::class, 'processReservation'])->name('booking.process');
Route::get('/booking/payment', [BookingCalender::class, 'showPaymentPage'])->name('booking.payment');
Route::post('/booking/payment/process', [BookingCalender::class, 'processPayment'])->name('booking.payment.process');
Route::get('/booking/success', [BookingCalender::class, 'successPage'])->name('booking.success');
Route::get('/rooms/search', [BookingCalender::class, 'searchForm'])->name('rooms.search');
Route::get('/payment/start/{booking_id}', [PaymentController::class, 'start'])->name('payment.start');
Route::get('/booking/confirmation/{id}', [BookingCalender::class, 'showConfirmation'])->name('booking.confirmation');
Route::post('/payment/complete', [PaymentController::class, 'complete'])->name('payment.complete');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

// Define the route for proceeding to payment
Route::post('/proceed-to-payment', [HomeController::class, 'proceedToPayment'])->name('booking.proceedToPayment');
Route::get('/bookings/{id}/status/{status}', [BookingController::class, 'updateStatus'])->name('booking.status');

// Protect reservation route with 'guest' authentication
// Route::middleware(['auth:guest'])->group(function () {
//     Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
//     Route::post('/books/create', [HomeController::class, 'bookstore'])->name('books.store');
// });

Route::post('/booking/cancel/{id}', [ReservationController::class, 'cancelBooking'])->name('booking.cancel');
Route::get('/guest/logout', [GuestController::class, 'logout'])->name('guest.logout');
Route::get('/guest-login', function () {
    return view('auth.guest_login'); // Adjust to your guest login view
})->name('guest.logins');

// Route::get('/register', function () {
//     return view('auth.guest_register');
// })->name('register');
Route::get('/register/guest', [GuestController::class,'showRegistrationForm'])->name('register.guest');
Route::post('/guest/login', [GuestController::class, 'login'])->name('guest.login');
Route::post('/booking/pay-on-arrival', [BookingController::class, 'payOnArrival'])->name('booking.payOnArrival');
Route::post('/register', [GuestController::class, 'register'])->name('register');
Route::get('roomindex',[HomeController::class,'roomindex'])->name('roomindex');
Route::get('food',[HomeController::class,'food'])->name('food');
Route::get('/email.verify', function () {
    return view('auth.verify-email'); // Email verification notice view
})->middleware('auth:guest')->name('verification.notice');

// Route::get('/email.verify', function () {
//     return view('auth.verify-email'); 
// })->middleware('guest')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Marks the email as verified
    return redirect()->route('homepage'); // Redirect to homepage after verification
})->middleware(['auth:guest', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    auth('guest')->user()->sendEmailVerificationNotification(); // Sends a new verification email
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:guest', 'throttle:6,1'])->name('verification.send');



// Protected Routes (Require Authentication and Verification)
Route::middleware(['auth:guest', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});
// Fallback Route for Guests Not Authenticated or Verified
Route::fallback(function () {
    return redirect()->route('register')->with('message', 'Please register or log in to access this page.');
});

Route::post('queries/store', [UserQueryController::class, 'store'])->name('queries.store');
/* ================== Back End Route ==================== */
Route::group(['middleware' => ['isAdmin']], function () {
    /*=================== RoomType ========================== */
    Route::resource('/roomtypes', RoomTypeController::class);
    Route::get('roomtypes/{roomtypeId}/delete', [RoomTypeController::class, 'destroy']);
    Route::get('/app', [AuthController::class, 'dashboards'])->name('app');
    /*=================== Guest Route ========================== */
    Route::resource("/guests", GuestController::class);
    Route::get('guests/{guestId}/delete', [GuestController::class, 'destroy']);
    Route::get('guests/{id}/detail', [GuestController::class, 'show'])->name('show.guest');

    /*=================== Room Route ========================== */
    Route::resource("/rooms", RoomController::class);
    Route::get('rooms/{roomId}/delete', [RoomController::class, 'destroy']);
    // Route::get('rooms/{id}/detail', [RoomController::class, 'show'])->name('rooms.show');

    /*================= Traslate Route =========================== */
    Route::get('locale/{lang}', [TranslateController::class, 'setLang'])->name('locale.switch');

    /*================= Permisson Route =================== */
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    /*================= Role Route =================== */
    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);

    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    /*================= User Route =================== */
    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    /*================= Booking Route =================== */
    Route::resource('bookings', BookingController::class);
    // Route::get('bookings/available-rooms/{checkin_date}', [BookingController::class, 'available_rooms']);
    Route::get('/bookings/available-rooms/{checkin_date}', [BookingController::class, 'available_rooms']);
    Route::get('/bookings/available-room/{checkin_date}', [BookingController::class, 'availableRooms']);
    // Route::get('/bookings/available-rooms', [BookingController::class, 'getAvailableRooms'])->name('bookings.available-rooms');
    // Route::get('/bookings/available/{checkin_date}', [BookingController::class, 'getAvailableRooms'])->name('rooms.available');
    // Route::get('/api/rooms/availability', [BookingController::class, 'getAvailableRooms']);
    // web.php
Route::get('/rooms/{booking_id}/edit', [BookingController::class, 'editBookingRooms']);
Route::post('/rooms/{booking_id}/edit', [BookingController::class, 'updateBookingRooms']);
Route::get('/rooms/{booking_id}/edit-view', [BookingController::class, 'editBookingRoomsView']);
Route::get('/get-available-rooms', [BookingController::class, 'getAvailableRooms']);
// Route::post('/check-room-availability', [BookingController::class, 'checkAvailability'])->name('rooms.checkAvailability');
// Route::post('/rooms/check-availability', [BookingController::class, 'checkAvailability'])->name('rooms.check-availability');


// routes/api.php

// Route::get('/check-room-availability', function (Request $request) {
//     $roomId = $request->room_id;
//     $checkIn = $request->check_in;
//     $checkOut = $request->check_out;

//     $isAvailable = !DB::table('booking_rooms')
//         ->join('bookings', 'booking_rooms.booking_id', '=', 'bookings.id')
//         ->where('booking_rooms.room_id', $roomId)
//         ->where(function ($query) use ($checkIn, $checkOut) {
//             $query->whereBetween('bookings.check_in_date', [$checkIn, $checkOut])
//                   ->orWhereBetween('bookings.check_out_date', [$checkIn, $checkOut])
//                   ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$checkIn])
//                   ->orWhereRaw('? BETWEEN bookings.check_in_date AND bookings.check_out_date', [$checkOut]);
//         })
//         ->exists();

//     return response()->json(['available' => $isAvailable]);
// });


Route::get('/check-room-availability', [BookingController::class, 'checkRoomAvailability']);
// Route::get('/available-rooms', [HomeController::class, 'getAvailableRooms'])->name('availableRooms');

Route::get('/modalfilter', [HomeController::class, 'modalfilter'])->name('modalfilter');
Route::get('/booking', [HomeController::class, 'bookingPage'])->name('booking.page');

// In your web.php or api.php (Laravel routes)
// Route::get('/api/available-rooms', function (Request $request) {
//     $checkIn = $request->query('check_in');
//     $checkOut = $request->query('check_out');
//     $adults = $request->query('adults');
//     $children = $request->query('children');

//     // Fetch available rooms based on the filters
//     $rooms = Room::whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
//         $query->where('check_out_date', '>', $checkIn)
//               ->where('check_in_date', '<', $checkOut);
//     })->where('max_person', '>=', $adults + $children)
//       ->with(['images', 'roomType'])
//       ->get();

//     // Return the response
//     return response()->json(['rooms' => $rooms]);
// });

// Route::get('/api/available-rooms', function (Request $request) {
//     $checkIn = $request->query('check_in');
//     $checkOut = $request->query('check_out');
//     $adults = $request->query('adults');
//     $children = $request->query('children');

//     // Fetch available rooms based on the filters
//     $rooms = Room::whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
//         $query->where('check_out_date', '>', $checkIn)
//               ->where('check_in_date', '<', $checkOut);
//     })->where('max_person', '>=', $adults + $children)
//       ->with(['images', 'roomType'])
//       ->get();

//     // Log the rooms data for debugging
//     Log::info('Available rooms:', $rooms->toArray());

//     // Return the response
//     return response()->json(['rooms' => $rooms]);
// });

// Route::middleware('auth:guest')->group(function () {
//     Route::get('/booking/available-room/{checkin_date}', [BookingController::class, 'availableRooms']);
// });




// Route::get('/api/available-rooms', function (Request $request) {
//     $checkIn = $request->query('check_in');
//     $checkOut = $request->query('check_out');
//     $adults = $request->query('adults');
//     $children = $request->query('children');
    
//     // Fetch available rooms based on check-in/check-out dates and capacity
//     $rooms = Room::whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
//         $query->where('check_out_date', '>', $checkIn)
//               ->where('check_in_date', '<', $checkOut);
//     })->where('max_person', '>=', $adults + $children)
//       ->with(['images', 'roomType'])
//       ->get();

//     // Log available rooms for debugging
//     Log::info('Available rooms:', $rooms->toArray());

//     return response()->json(['rooms' => $rooms]);
// });


// Route::post('/api/add-room', function (Request $request) {
//     $roomId = $request->input('room_id');
//     $checkIn = $request->input('check_in');
//     $checkOut = $request->input('check_out');

//     $room = Room::with('bookings')->find($roomId);

//     if (!$room) {
//         return response()->json(['error' => 'Room not found'], 404);
//     }

//     // Check if the room is available for the selected dates
//     $isAvailable = !$room->bookings()->where('check_out_date', '>', $checkIn)
//         ->where('check_in_date', '<', $checkOut)
//         ->exists();

//     if (!$isAvailable) {
//         return response()->json(['error' => 'Room is not available for the selected dates'], 400);
//     }

//     // Additional condition: Prevent adding the same room multiple times
//     session()->push('selected_rooms', $roomId);
//     $selectedRooms = session('selected_rooms', []);

//     if (count(array_keys($selectedRooms, $roomId)) > 1) {
//         session()->forget('selected_rooms');
//         return response()->json(['error' => 'Room has already been added'], 400);
//     }

//     return response()->json(['message' => 'Room added successfully', 'room' => $room]);
// });
   // Route to check room availability (AJAX)
    // Route::get('/check-room-availability', [BookingController::class, 'checkRoomAvailability'])->name('checkRoomAvailability');
    // Route::get('/bookings/check-room-availability', [BookingController::class, 'checkRoomAvailability']);
    Route::get('bookings/{bookingId}/delete', [App\Http\Controllers\BookingController::class, 'destroy']);
    // Route::get('bookings/{id}/detail', [BookingController::class, 'show'])->name('bookings.show');

    /*================= Check Date Availability ============== */

    Route::get('/bookings/check-date/{date}', [BookingController::class, 'checkDate']);

    Route::get('/bookings/booked-dates', [BookingController::class, 'getBookedDates'])->name('bookings.booked-dates');

    /*================= Booking Calender =============== */
    Route::resource('calenders', BookingCalenderController::class);
    Route::get('/api/bookings', [BookingController::class, 'getBookings'])->name('bookings.get');

    /*================= Facility Room =============== */
    Route::resource('facilitys', FacilitiesController::class);
    Route::get('facilitys/{facilityId}/delete', [App\Http\Controllers\FacilitiesController::class, 'destroy']);
    // Route::get('/api/bookings', [FacilitiesController::class, 'getBookings'])->name('bookings.get');

    /*================= Front End =================== */
    /*================= Carousel =================== */
    Route::resource('carousels', CarouselController::class);
    Route::get('carousels/{carouselId}/delete', [App\Http\Controllers\CarouselController::class, 'destroy']);

    // /*================= Setting General =================== */
    Route::resource('settings', SettingController::class);
    Route::get('settings/{settingId}/delete', [App\Http\Controllers\SettingController::class, 'destroy']);

    Route::get('payments',[PaymentController::class, 'payment'])->name('payments.index');
    Route::get('/payments/create/{booking_id}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payment/success/{payment_id}', [PaymentController::class, 'success'])->name('payments.success');
    Route::get('/payment/error', [PaymentController::class, 'error'])->name('payments.error');
    Route::get('payment/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');

    /* ================== End Front ================ */
    /*================= AboutUs =================== */

    Route::get('abouts', [SettingController::class, 'about'])->name('abouts.index');
    Route::get('abouts/create', [SettingController::class, 'about'])->name('abouts.create');
    Route::post('abouts/store', [SettingController::class, 'aboutstore'])->name('abouts.store');
    Route::get('abouts/edit/{id}', [SettingController::class, 'aboutedit'])->name('abouts.edit');
    Route::post('abouts/update/{id}', [SettingController::class, 'aboutupdate'])->name('abouts.update');

    /*================= Contacts  =================== */
    Route::get('contacts', [SettingController::class, 'contact'])->name('contacts.index');
    // Route::get('contacts/create',[SettingController::class,'contact'])->name('contacts.create');
    Route::post('contacts/store', [SettingController::class, 'contactstore'])->name('contacts.store');
    Route::get('contacts/edit/{id}', [SettingController::class, 'contactedit'])->name('contacts.edit');
    Route::post('contacts/update/{id}', [SettingController::class, 'contactupdate'])->name('contacts.update');

    /*================= User Query =================== */
    Route::get('queries', [UserQueryController::class, 'query'])->name('queries.index');
    // Route::get('queries/create',[UserQueryController::class,'create'])->name('queries.create');

    Route::get('queries/delete/{id}', [UserQueryController::class, 'delete'])->name('queries.delete');
    Route::put('queries/{id}/mark-as-read', [UserQueryController::class, 'markAsRead'])->name('queries.markAsRead');

    Route::get('banners', [BannerController::class, 'banner'])->name('banner.index');
    Route::post('banners/store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('banners/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');
    Route::get('banners/create', [BannerController::class, 'create'])->name('banner.create');
    Route::resource('services', ServiceController::class);
    Route::get('services/{servicesId}/delete', [App\Http\Controllers\ServiceController::class, 'destroy']);

    Route::resource('meetings', MettingController::class);
    Route::get('meetings/{meetingId}/delete', [App\Http\Controllers\MettingController::class, 'destroy']);

    /*================= Gallery Route =================== */
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('tours', TourController::class);
    Route::get('tours/{tourId}/delete', [TourController::class, 'destroy']);

    /*================= Gallery Route =================== */
    Route::resource('gallerys', GalleryController::class);
    Route::post('/gallerys/{gallery}/toggle-active', [GalleryController::class, 'toggleActive'])->name('gallery.toggleActive');
    Route::post('/services/{service}/toggle-active', [ServiceController::class, 'toggleActive'])->name('service.toggleActive');
    Route::post('/meetings/{meeting}/toggle-active', [MettingController::class, 'toggleActive'])->name('meeting.toggleActive');
    Route::post('/restaurants/{restaurant}/toggle-active', [RestaurantController::class, 'toggleActive'])->name('restaurant.toggleActive');
    Route::post('/rooms/{room}/toggle-active', [RoomController::class, 'toggleActive'])->name('room.toggleActive');
    Route::post('/bookings/{booking}/toggle-active', [BookingController::class, 'toggleActive'])->name('booking.toggleActive');
    Route::get('gallerys/{galleryId}/delete', [GalleryController::class, 'destroy']);

    Route::get('/notifications/clear', function () {
        session()->forget('notifications');
        return redirect()->back()->with('success', 'Notifications cleared.');
    })->name('notifications.clear');

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
    Route::get('/reports/reservations', [ReportController::class, 'reservationReport'])
        ->name('reports.reservations');
    Route::get('/reports/reservations/export', [ReportController::class, 'exportReservationReport'])
        ->name('reports.reservations.export');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
