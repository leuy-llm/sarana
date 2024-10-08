<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilitiesController extends Controller
{
    //
    public function index()
    {

        $facilitys = Facility::getFacility();
        $header_title = "Manage Facilities";

        return view('back_end.facility.index', compact('header_title', 'facilitys'));
    }

    public function create()
    {

        $header_title = "New Facilities";

        return view("back_end.facility.create", compact('header_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle the file upload for the icon
        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
        }


        // Create a new facility
        Facility::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'icon' => $iconPath, // Store the icon path in the database
        ]);

        // Redirect or return a response
        return redirect('facilitys')->with('success', 'Facility created successfully.');
    }

   

    public function edit($id)
    {
        $facility = Facility::findOrFail($id);
        $header_title = "Edit Facility";
        return view('back_end.facility.edit', compact('facility', 'header_title'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the facility by its ID
        $facility = Facility::findOrFail($id);

        // Handle the file upload for the icon
        if ($request->hasFile('icon')) {
            // Delete the old icon if it exists
            if ($facility->icon) {
                Storage::disk('public')->delete($facility->icon);
            }

            // Store the new icon
            $iconPath = $request->file('icon')->store('icons', 'public');
            $facility->icon = $iconPath; // Update the icon path
        }

        // Update the facility details
        $facility->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Save the changes to the facility
        $facility->save();

        // Redirect or return a response
        return redirect('facilitys')->with('success', 'Facility updated successfully.');
    }



    public function destroy($facilityId)
    {
        $facility = Facility::findOrFail($facilityId);

        if (!empty($facility)) {
            $facility->is_deleted = 1;
            $facility->save();

            return redirect('/facilitys')->with('success', 'The RoomType was marked as deleted successfully');
        }

        return redirect('/facilitys')->with('error', 'RoomType not found');
    }
}
