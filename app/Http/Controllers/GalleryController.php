<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    //


    public function index()
    {
        $galleries = Gallery::all();
        $header_title = "Manage Gallerys";
        return view('back_end.gallery.index', compact('galleries', 'header_title'));
    }

    // Show the form for creating a new service
    public function create()
    {
        $header_title =  __('label.newGallery');
        return view('back_end.gallery.create', compact('header_title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required|boolean',
        ]);
        // Handle the file upload for the icon
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('galleries', 'public');
        }


        // Create a new facility
        Gallery::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->status,
            'image' => $imagePath, // Store the icon path in the database
        ]);

        // Redirect or return a response
        return redirect('gallerys')->with('success', __('label.galleryCreatedSuccess'));
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $header_title = "Edit Gallery";
        return view('back_end.gallery.edit', compact('gallery', 'header_title'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('galleries', 'public');
            $gallery->image = $imagePath;
        }

        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $gallery->image,
            'status' => $request->status,
        ]);

        return redirect()->route('gallerys.index')->with('success', __('label.galleryUpdateSuccess'));
    }


    public function destroy($id)
    {
        try {
            $query = Gallery::findOrFail($id);
            $query->delete();

            return redirect('/gallerys')->with('success', __('label.galleryDeleteSuccess'));
        } catch (\Exception $e) {
            return redirect('/gallerys')->with('success', __('label.galleryDeleteError'));
        }
        return redirect('/gallerys');
    }

    public function toggleActive(Gallery $gallery)
    {
        $gallery->status = !$gallery->status; // Toggle status (0 to 1, or 1 to 0)
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery status updated!');
    }
}
