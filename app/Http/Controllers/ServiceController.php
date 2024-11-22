<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //

    public function index()
    {
        $services = Service::all();
        $header_title = "Manage Services";
        return view('back_end.service.index', compact('services', 'header_title'));
    }

    // Show the form for creating a new service
    public function create()
    {
        $header_title =  __('label.newService');
        return view('back_end.service.create', compact('header_title'));
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
            $imagePath = $request->file('image')->store('services', 'public');
        }


        // Create a new facility
        Service::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'image' => $imagePath, // Store the icon path in the database
        ]);

        // Redirect or return a response
        return redirect('services')->with('success', __('label.serviceCreatedSuccess'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $header_title = "Edit Service";
        return view('back_end.service.edit', compact('service', 'header_title'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $service->image,
            'status' => $request->status,
        ]);

        return redirect()->route('services.index')->with('success', __('label.serviceUpdateSuccess'));
    }

    public function destroy($id)
    {
        try {
            $query = Service::findOrFail($id);
            $query->delete();

            return redirect('/services')->with('success', __('label.serviceDeleteSuccess'));
        } catch (\Exception $e) {
            return redirect('/services')->with('success', __('label.serviceDeleteError'));
        }
        return redirect('/services');
    }

    public function toggleActive(Service $service)
    {
        $service->status = !$service->status; // Toggle status (0 to 1, or 1 to 0)
        $service->save();
    
        return redirect()->back()->with('success', 'Service status updated!');
    }
}
