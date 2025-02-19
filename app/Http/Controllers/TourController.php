<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    //
    public function index()
    {
        $header_title = "Manage Tours";
        $tours = Tour::with('images')->get();

        return view('back_end.tour.index', compact('header_title', 'tours'));
    }

    public function create()
    {
        $header_title = "Create Toure";
        return view('back_end.tour.create', compact('header_title'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'location' => 'required|string',
            'images' => 'required|array', // Ensure images is an array
            'images.*' => 'image|mimes:jpeg,png,jpg,gif', // Validate each image
        ]);

        // Create the tour
        $tour = Tour::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'location' => $request->location,
        ]);

        // Upload images and store them
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('tours', 'public');
                $tour->images()->create(['image' => $imagePath]);
            }
        }

        return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
    }




    public function edit(Tour $tour)
    {
        $header_title = "Edit Tour";
        return view('back_end.tour.edit', compact('header_title', 'tour'));
    }

    public function update(Request $request, Tour $tour)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'location' => 'required|string',
        ]);

        // If a new image is uploaded, store it and delete the old one
        if ($request->hasFile('images')) {
            // Delete the old image if it exists
            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }

            // Upload the new image
            $path = $request->file('image')->store('tours', 'public');
            $tour->image = $path;
        }

        // Update the tour details
        $tour->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'location' => $request->location,
        ]);

        return redirect()->route('tours.index')->with('success', 'Tour updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $query = Tour::findOrFail($id);
            $query->delete();

            return redirect('/tours')->with('success', __('label.tourDeleteSuccess'));
        } catch (\Exception $e) {
            return redirect('/tours')->with('success', __('label.tourDeleteError'));
        }
        return redirect('/tours');
    }
}
