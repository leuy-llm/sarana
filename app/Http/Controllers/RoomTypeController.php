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
        ]);

        try {
            // Create a new Guest record
            $type = new RoomType();
            $type->type_name = $request->type_name;
           
            $type->description = $request->description;
            
            $type->save();

            // Set a success message in the session
            return redirect('/roomtypes')->with('success', __('label.roomTypeCreatedSuccess'));

            // with('success', 'A new roomtype was created successfully.');
        } catch (\Exception $e) {
            // Set an error message in the session
            return redirect('/roomtypes')->with('success', __('label.roomTypeCreatedError') . $e->getMessage());
            
        }
    }
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
            $roomType->description = $request->description;
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
