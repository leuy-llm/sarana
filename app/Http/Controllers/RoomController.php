<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomType;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    //

    public function index()
    {
        $rooms = Room::getRoom();
        $roomTypes = RoomType::getRoomType();
        $facilities = Facility::getFacility(); // Get all facilities
        $header_title = "Manage Room";
        return view('back_end.room.index', compact('rooms', 'header_title', 'roomTypes', 'facilities'));
    }

    public function create()
    {
        $roomTypes = RoomType::getRoomType();
        $facilities = Facility::getFacility();
        $header_title = "New Room";
        return view('back_end.room.create', compact('roomTypes', 'header_title', 'facilities'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'room_type_id' => 'required|exists:room_types,id',
                'room_number' => 'required|string|unique:rooms,room_number',
                'quantity'=>'required|integer',
                'floor' => 'nullable|integer',
                'status' => 'required|boolean',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'special_price' => 'nullable|numeric',
                'rating' => 'nullable|numeric|between:0,5',
                'view_type' => 'nullable|string',
                'bed_type' => 'nullable|string',
                'room_size' => 'nullable|numeric',
                // 'extra_bed_capacity' => 'nullable|integer',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
                'facilities' => 'nullable|array',
                'facilities.*' => 'exists:facilities,id',
                'max_person' => 'nullable|integer',
            ]);


            DB::transaction(function () use ($request) {
                // Step 1: Create the room
                $room = Room::create([
                    'room_type_id' => $request->input('room_type_id'),
                    'quantity'=>$request->input('quantity'),
                    'room_number' => $request->input('room_number'),
                    'floor' => $request->input('floor'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'special_price' => $request->input('special_price'),
                    'rating' => $request->input('rating'),
                    'view_type' => $request->input('view_type'),
                    'bed_type' => $request->input('bed_type'),
                    'room_size' => $request->input('room_size'),
                    // 'extra_bed_capacity' => $request->input('extra_bed_capacity'),
                    'max_person' => $request->input('max_person'),
                ]);
                $uploadedImages = $request->file('images'); // Assuming this is an array of uploaded files
                $imagePaths = [];

                foreach ($uploadedImages as $image) {
                    $path = $image->store('room_images', 'public');
                    $imagePaths[] = ['room_id' => $room->id, 'image' => $path];
                }

                RoomImage::insert($imagePaths);

                // Step 3: Attach selected facilities to the room
                if ($request->has('facilities')) {
                    $room->facilities()->sync($request->input('facilities'));
                }
            });

            return redirect()->route('rooms.index')->with('success', __('label.roomCreatedSuccess'));
        } catch (\Exception $e) {
            return redirect('/rooms')->with('error', __('label.roomCreatedError') . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $room = Room::with('images', 'facilities')->findOrFail($id);
        $header_title = "Edit Room";
        $roomTypes = RoomType::getRoomType();
        $facilities = Facility::getFacility();
        return view('back_end.room.edit', compact('room', 'header_title', 'roomTypes', 'facilities'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'room_type_id' => 'required|exists:room_types,id',
                'quantity' => 'required|integer',
                'room_number' => 'required|string|unique:rooms,room_number,' . $id,
                'floor' => 'nullable|integer',
                'status' => 'required|boolean',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'special_price' => 'nullable|numeric',
                'rating' => 'nullable|numeric|between:0,5',
                'view_type' => 'nullable|string',
                'bed_type' => 'nullable|string',
                'room_size' => 'nullable|numeric',
                // 'extra_bed_capacity' => 'nullable|integer',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'remove_images.*' => 'nullable|exists:room_images,id',
                'facilities' => 'nullable|array',
                'facilities.*' => 'exists:facilities,id',
                'max_person' => 'nullable|integer',
            ]);

            DB::transaction(function () use ($request, $id) {
                // Step 1: Find the room
                $room = Room::findOrFail($id);

                // Step 2: Update room details
                $room->update([
                    'room_type_id' => $request->input('room_type_id'),
                    'quantity' => $request->input('quantity'),
                    'room_number' => $request->input('room_number'),
                    'floor' => $request->input('floor'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'special_price' => $request->input('special_price'),
                    'rating' => $request->input('rating'),
                    'view_type' => $request->input('view_type'),
                    'bed_type' => $request->input('bed_type'),
                    'room_size' => $request->input('room_size'),
                    // 'extra_bed_capacity' => $request->input('extra_bed_capacity'),
                    'max_person' => $request->input('max_person'),
                ]);

                // Step 3: Update room facilities
                if ($request->has('facilities')) {
                    $room->facilities()->sync($request->input('facilities'));
                }

                // Step 3: Handle file uploads if there are new images
                if ($request->hasFile('images')) {
                    $uploadedImages = $request->file('images');
                    $imagePaths = [];

                    foreach ($uploadedImages as $image) {
                        $path = $image->store('room_images', 'public');
                        $imagePaths[] = ['room_id' => $room->id, 'image' => $path];
                    }

                    RoomImage::insert($imagePaths);
                }

                // Step 4: Handle image removal if images are selected for removal
                if ($request->has('remove_images')) {
                    $removeImageIds = $request->input('remove_images');

                    foreach ($removeImageIds as $imageId) {
                        $image = RoomImage::findOrFail($imageId);
                        Storage::disk('public')->delete($image->image); // Delete image file
                        $image->delete(); // Delete record from the database
                    }
                }
            });

            return redirect()->route('rooms.index')->with('success', __('label.roomUpdateSuccess'));
        } catch (\Exception $e) {
            return redirect()->route('rooms.index', $id)->with('error', __('label.roomUpdateError') . $e->getMessage());
        }
    }


    public function destroy($roomId)
    {
        $room = Room::findOrFail($roomId);

        if (!empty($room)) {
            $room->is_deleted = 1;
            $room->save();
            return redirect('/rooms')->with('success', __('label.roomDeleteSuccess'));
        }

        return redirect('/rooms')->with('error', __('label.roomDeleteError'));
    }

    public function show($id)
    {
        $room = Room::with('roomType', 'images', 'facilities')->findOrFail($id);
        $header_title = "Room Details";
        return view('back_end.room.show', compact('room', 'header_title'));
    }

    public function toggleActive(Room $room)
    {
        $room->status = !$room->status; // Toggle status (0 to 1, or 1 to 0)
        $room->save();

        return redirect()->back()->with('success', 'Room status updated!');
    }

   

    public function roomfil(Request $request){
    $roomTypes = RoomType::getRoomType();
    $data = "Reservation";
    // Start a query to fetch rooms
    $roomsQuery = Room::with('roomType'); // Assuming rooms have a relationship with RoomType
    $settings = DB::table('settings')->get();

    $banner = Banner::where('page_name', 'rooms')->first();
    $contact = DB::table('contact_details')->get();

    $checkIn = $request->input('check_in');
    $checkOut = $request->input('check_out');
    // Apply filters based on user input
    if ($request->has('check_in') && $request->has('check_out')) {
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        
        $roomsQuery->whereDoesntHave('bookings', function ($query) use ($check_in, $check_out) {
            $query->where(function ($q) use ($check_in, $check_out) {
                $q->whereBetween('check_in_date', [$check_in, $check_out])
                  ->orWhereBetween('check_out_date', [$check_in, $check_out]);
            });
        });
    }

    // Apply filters for room capacity
    if ($request->has('adults')) {
        $adults = $request->input('adults');
        $roomsQuery->where('max_person', '>=', $adults);
    }

    if ($request->has('children')) {
        $children = $request->input('children');
        $roomsQuery->where('max_person', '>=', $children);
    }

    // Apply price filter
    if ($request->has('price_min') && $request->has('price_max')) {
        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');
        $roomsQuery->whereBetween('price', [$price_min, $price_max]);
    }

    // Apply room type filter
    if ($request->has('room_type')) {
        $room_type_id = $request->input('room_type');
        $roomsQuery->where('room_type_id', $room_type_id);
    }

    // Get the filtered rooms
    $rooms = $roomsQuery->paginate(9); // Adjust pagination as needed

    // Return the view with the rooms and room types
    return view('frontend.rooms.index', compact('rooms', 'roomTypes','data',));
    }
}
