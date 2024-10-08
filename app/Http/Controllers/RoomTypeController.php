<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    //
    public function index()
    {

        $roomtypes = RoomType::getRoomType();
        $header_title = "Manage RoomType";

        return view('back_end.roomtype.index', compact('header_title', 'roomtypes'));
    }

    public function create()
    {

        $header_title = "New RoomType";

        return view("back_end.roomtype.create", compact('header_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:50|unique:room_types,type_name',
            // 'max_persons' => 'required|integer',
            // 'base_price' => 'required',
            // 'amenities' => 'required|array',

        ]);

        try {
            // Create a new Guest record
            $type = new RoomType();
            $type->type_name = $request->type_name;
            // $type->max_persons = $request->max_persons;
            // $type->base_price = $request->base_price;
            $type->description = $request->description;
            // $type->amenities = json_encode($request->amenities); // Encode amenities as JSON
            $type->save();

            // Set a success message in the session
            return redirect('/roomtypes')->with('success', __('label.roomTypeCreatedSuccess'));

            // with('success', 'A new roomtype was created successfully.');
        } catch (\Exception $e) {
            // Set an error message in the session
            return redirect('/roomtypes')->with('success', __('label.roomTypeCreatedError') . $e->getMessage());
            // with('error', 'There was an error creating the roomtype. Please try again. ' . $e->getMessage());
        }
    }

    // public function edit($id)
    // {
    //     $roomtype = RoomType::findOrFail($id);
    //     return response()->json($roomtype);
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'type_name' => 'required|string|max:50|unique:room_types,type_name,' . $id
    //     ]);

    //     try {
    //         $type = RoomType::findOrFail($id);
    //         $type->type_name = $request->type_name;
    //         $type->save();

    //         return response()->json(['success' => 'RoomType updated successfully']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'RoomType update failed: ' . $e->getMessage()], 500);
    //     }

    // }

    public function edit($id)
    {
        $roomtype = RoomType::findOrFail($id);
        $header_title = "Edit RoomType";
        return view('back_end.roomtype.edit', compact('roomtype', 'header_title'));
    }

    public function update(Request $request, $id)
    {
        try {
            $roomType = RoomType::findOrFail($id);
            $roomType->type_name = $request->type_name;
            // $roomType->max_persons = $request->max_persons;
            // $roomType->base_price = $request->base_price;
            $roomType->description = $request->description;


            // Convert the comma-separated string back to a JSON array
            // $roomType->amenities = json_encode(array_map('trim', explode(',', $request->amenities)));
            $roomType->save();

            return redirect('/roomtypes')->with('success', __('label.roomTypeUpdatedSuccess'));
        } catch (\Exception $e) {
            return redirect('/roomtypes')->with('error', __('label.roomTypeUpdatedError') . $e->getMessage());
        }
    }


    public function destroy($roomTypeId)
    {
        $roomtype = RoomType::findOrFail($roomTypeId);

        if (!empty($roomtype)) {
            $roomtype->is_deleted = 1;
            $roomtype->save();

            return redirect('/roomtypes')->with('success', 'The RoomType was marked as deleted successfully');
        }

        return redirect('/roomtypes')->with('error', 'RoomType not found');
    }
}
