<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Carousel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
use App\Http\Controllers\UserQueryController;

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

Route::get('/admin', function () {
    return view('dashboard');
});

/* ================== Back End Route ==================== */

/*=================== RoomType ========================== */
Route::resource('/roomtypes',RoomTypeController::class);
Route::get('roomtypes/{roomtypeId}/delete',[RoomTypeController::class,'destroy']);

/*=================== Guest Route ========================== */
Route::resource("/guests", GuestController::class);
Route::get('guests/{guestId}/delete',[GuestController::class,'destroy']);

/*=================== Room Route ========================== */
Route::resource("/rooms", RoomController::class);
Route::get('rooms/{roomId}/delete',[RoomController::class,'destroy']);
Route::get('rooms/{id}/detail', [RoomController::class, 'show'])->name('rooms.show');

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
Route::get('bookings/available-rooms/{checkin_date}', [BookingController::class, 'available_rooms']);
Route::get('bookings/{bookingId}/delete', [App\Http\Controllers\BookingController::class, 'destroy']);
Route::get('bookings/{id}/detail', [BookingController::class, 'show'])->name('bookings.show');

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
Route::resource('carousels',CarouselController::class);
Route::get('carousels/{carouselId}/delete', [App\Http\Controllers\CarouselController::class, 'destroy']);

// /*================= Setting General =================== */
Route::resource('settings',SettingController::class);
Route::get('settings/{settingId}/delete', [App\Http\Controllers\SettingController::class, 'destroy']);



/* ================== End Front ================ */
/*================= AboutUs =================== */

Route::get('abouts',[SettingController::class,'about'])->name('abouts.index');
Route::get('abouts/create',[SettingController::class,'about'])->name('abouts.create');
Route::post('abouts/store',[SettingController::class,'aboutstore'])->name('abouts.store');
Route::get('abouts/edit/{id}',[SettingController::class,'aboutedit'])->name('abouts.edit');
Route::post('abouts/update/{id}', [SettingController::class, 'aboutupdate'])->name('abouts.update');


/*================= Contacts  =================== */
Route::get('contacts',[SettingController::class,'contact'])->name('contacts.index');
// Route::get('contacts/create',[SettingController::class,'contact'])->name('contacts.create');
Route::post('contacts/store',[SettingController::class,'contactstore'])->name('contacts.store');
Route::get('contacts/edit/{id}',[SettingController::class,'contactedit'])->name('contacts.edit');
Route::post('contacts/update/{id}', [SettingController::class, 'contactupdate'])->name('contacts.update');

/*================= User Query =================== */
Route::get('queries',[UserQueryController::class,'query'])->name('queries.index');
// Route::get('queries/create',[UserQueryController::class,'create'])->name('queries.create');
Route::post('queries/store',[UserQueryController::class,'store'])->name('queries.store');
Route::get('queries/delete/{id}',[UserQueryController::class,'delete'])->name('queries.delete');
Route::put('queries/{id}/mark-as-read', [UserQueryController::class, 'markAsRead'])->name('queries.markAsRead');



/*================= Login =================== */
Route::get('login', [AuthController::class,'Auth']);
Route::post('/submit', [AuthController::class, 'login'])->name('sumbit');


/*==================== Export Route =========== */
Route::get('guest/export/',[GuestController::class,'export']);


/*================= HomePage ================= */
Route::get('/',[HomeController::class,'index'])->name('homepage');
/*================= Contact ================  */
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
/* ================ Our Room ================ */
// Route::get('rooms',[HomeController::class,'ourroom'])->name('')
Route::get('room_detail/{id}/{type_name}', [HomeController::class, 'roomDetail'])->name('roomDetail');



