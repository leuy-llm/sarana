<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Restaurant;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    //
    public function index()
    {
        $restaurant = Restaurant::all();
        $header_title = "Manage Restaurant";
        return view('back_end.restaurant.index', compact('restaurant', 'header_title'));
    }

    // Show the form for creating a new service
    public function create()
    {
        $header_title =  __('label.newFood');
        return view('back_end.restaurant.create', compact('header_title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required|boolean',
        ]);
        // Handle the file upload for the icon
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
        }


        // Create a new facility
        Restaurant::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->status,
            'image' => $imagePath, // Store the icon path in the database
        ]);

        // Redirect or return a response
        return redirect('restaurants')->with('success', __('label.galleryCreatedSuccess'));
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $header_title = "Edit Restaurant";
        return view('back_end.restaurant.edit', compact('restaurant', 'header_title'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
            $restaurant->image = $imagePath;
        }

        $restaurant->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $restaurant->image,
            'status' => $request->status,
        ]);

        return redirect()->route('restaurants.index')->with('success', __('labelrestaurantUpdateSuccess'));
    }


    public function destroy($id)
    {
        try {
            $query = Restaurant::findOrFail($id);
            $query->delete();

            return redirect('/restaurants')->with('success', __('label.restaurantDeleteSuccess'));
        } catch (\Exception $e) {
            return redirect('/restaurants')->with('success', __('label.restaurantDeleteError'));
        }
        return redirect('/restaurants');
    }

    public function toggleActive(Restaurant $restaurant)
    {
        $restaurant->status = !$restaurant->status; // Toggle status (0 to 1, or 1 to 0)
        $restaurant->save();

        return redirect()->back()->with('success', 'Restaurant status updated!');
    }

}
