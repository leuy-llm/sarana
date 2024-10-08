<?php

namespace App\Http\Controllers;

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
                'floor' => 'nullable|integer',
                'status' => 'nullable|in:Available,Booked,Maintenance',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
            ]);

            DB::transaction(function () use ($request) {
                // Step 1: Create the room
                $room = Room::create([
                    'room_type_id' => $request->input('room_type_id'),
                    'room_number' => $request->input('room_number'),
                    'floor' => $request->input('floor'),
                    'status' => $request->input('status', 'Available'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                ]);

                // Step 2: Handle file uploads and associate images with the room
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
                'room_number' => 'required|string|unique:rooms,room_number,' . $id,
                'floor' => 'nullable|integer',
                'status' => 'nullable|in:Available,Booked,Maintenance',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
                'remove_images.*' => 'nullable|exists:room_images,id', // Validate image IDs to be removed
                'facilities' => 'nullable|array', // Validate facilities as an array
                'facilities.*' => 'exists:facilities,id', // Validate each facility ID exists
            ]);

            DB::transaction(function () use ($request, $id) {
                // Step 1: Find the room
                $room = Room::findOrFail($id);

                // Step 2: Update room details
                $room->update([
                    'room_type_id' => $request->input('room_type_id'),
                    'room_number' => $request->input('room_number'),
                    'floor' => $request->input('floor'),
                    'status' => $request->input('status', 'Available'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
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

                    // Insert new images into the RoomImage table
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

            // Only set success message after a successful update
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
            // with('success', 'The Room was marked as deleted successfully');
        }

        return redirect('/rooms')->with('error', __('label.roomDeleteError'));
        // ->with('error', 'Room not found');
    }

    public function show($id)
    {
        $room = Room::with('roomType', 'images','facilities')->findOrFail($id);
        $header_title = "Room Details";
        return view('back_end.room.show', compact('room', 'header_title'));
    }
}
