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

    //     public function store(Request $request)
    // {
    //     // Validate the input fields
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif',
    //         'price' => 'required|numeric',
    //         'duration' => 'required|string',
    //         'location' => 'required|string',
    //         'status' => 'required|boolean',
    //         'is_featured' => 'sometimes|boolean', // Changed to 'sometimes' for unchecked case
    //     ]);

    //     // Upload the primary image
    //     $path = $request->file('image')->store('tours', 'public');

    //     // Create the tour
    //     $tour = Tour::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'image' => $path,
    //         'price' => $request->price,
    //         'duration' => $request->duration,
    //         'location' => $request->location,
    //         'status' => $request->status,
    //         'is_featured' => $request->has('is_featured') ? 1 : 0, // Fallback for the checkbox
    //     ]);

    //     return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
    // }

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
    // public function update(Request $request, $tourId)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|numeric',
    //         'duration' => 'required|string',
    //         'location' => 'required|string',
    //         'description' => 'required|string',
    //         'images' => 'nullable|array',
    //         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'primary_image_id' => 'nullable|exists:tour_images,id',
    //         'remove_images.*' => 'nullable|exists:tour_images,id', // Validate image IDs to be removed
    //     ]);

    //     // Find the tour
    //     $tour = Tour::findOrFail($tourId);

    //     // Update the tour fields
    //     $tour->update([
    //         'name' => $request->name,
    //         'price' => $request->price,
    //         'duration' => $request->duration,
    //         'location' => $request->location,
    //         'description' => $request->description,
    //         'is_featured' => $request->has('is_featured'),
    //     ]);

    //     // Handle image uploads
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             // Save each image
    //             $path = $image->store('tour_images', 'public');

    //             // Create a new image record for the tour
    //             TourImage::create([
    //                 'tour_id' => $tour->id,
    //                 'image' => $path,
    //                 'is_primary' => false, // By default, new images are secondary
    //             ]);
    //         }
    //     }

    //     // Remove images that were selected for deletion
    //     if ($request->has('remove_images')) {
    //         foreach ($request->remove_images as $imageId) {
    //             $image = TourImage::find($imageId);
    //             if ($image) {
    //                 // If the removed image is the primary image, we'll need to update primary image
    //                 if ($image->is_primary) {
    //                     // If the removed image was primary, set another image as primary
    //                     $nextPrimary = $tour->images()->where('id', '!=', $imageId)->first();
    //                     if ($nextPrimary) {
    //                         // Set the next available image as primary
    //                         $nextPrimary->update(['is_primary' => true]);
    //                     }
    //                 }

    //                 // Delete the image file from storage
    //                 Storage::disk('public')->delete($image->image);

    //                 // Delete the image record from the database
    //                 $image->delete();
    //             }
    //         }
    //     }

    //     // Update the primary image
    //     if ($request->has('primary_image_id')) {
    //         // First, set all images to non-primary
    //         $tour->images()->update(['is_primary' => false]);

    //         // Then, set the selected image as primary
    //         $tour->images()->where('id', $request->primary_image_id)->update(['is_primary' => true]);
    //     }

    //     return redirect()->route('tours.index')->with('success', 'Tour updated successfully');
    // }
}
