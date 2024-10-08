<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    //
    public function index()
    {
        $header_title = "Manage Carousel";
        $carousels = Carousel::orderBy('id', 'desc')->paginate(12);
        return view('frontend.carousel.index', compact('header_title', 'carousels'));
    }

    public function create(){
        $header_title = "Create Carousel";
        return view('frontend.carousel.create', compact('header_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:carousels,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Validate each image,
            'description'=>'required',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('carousels', 'public');
        }


        // Create a new facility
        Carousel::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $image, // Store the icon path in the database
        ]);

         // Redirect or return a response
         return redirect('carousels')->with('success', 'Carousel created successfully.');
    }

    public function destroy($carouselId)
    {
        try {
            $carousel = Carousel::findOrFail($carouselId);
            $carousel->delete();

            return redirect('/carousels')->with('success', __('label.roomDeleteSuccess'));

        } catch (\Exception $e) {
            return redirect('/carousels')->with('success', __('label.roomDeleteError'));
        }
        return redirect('/carousels');
    }
}
