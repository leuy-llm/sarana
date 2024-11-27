<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MettingController extends Controller
{
    //
    public function index()
    {
        $header_title = "Manage Meeting";
        $meetings = Meeting::all();
        return view('back_end.meeting.index', compact('header_title', 'meetings'));
    }

    public function create()
    {
        $header_title = "Create Meeting";
        return view('back_end.meeting.create', compact('header_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'availability' => 'boolean',
        ]);

        // Create the meeting
        $meeting = Meeting::create([
            'title' => $request->title,
            'description' => $request->description,
            'availability' => $request->availability,
        ]);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('meetings', 'public');
                $meeting->images()->create(['image' => $imagePath]);
            }
        }

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully.');
    }

    public function edit($id)
    {
        $header_title = "Edit Meeting";
        $meeting = Meeting::findOrFail($id);
        return view('back_end.meeting.edit', compact('header_title', 'meeting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'availability' => 'boolean',
            'remove_images.*' => 'nullable|exists:meeting_images,id', // Validate image IDs to be removed'

        ]);

        $meeting = Meeting::findOrFail($id);

        $meeting->update([
            'title' => $request->title,
            'description' => $request->description,
            'availability' => $request->availability,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('meetings', 'public');
                $meeting->images()->create(['image' => $imagePath]);
            }
        }

        if ($request->has('remove_images')) {
            $meeting->images()->whereIn('id', $request->remove_images)->delete();
        }

        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $query = Meeting::findOrFail($id);
            $query->delete();

            return redirect('/meetings')->with('success', __('label.meetingDeleteSuccess'));
        } catch (\Exception $e) {
            return redirect('/meetings')->with('success', __('label.meetingDeleteError'));
        }
        return redirect('/meetings');
    }
    public function toggleActive(Meeting $meeting)
    {
        $meeting->availability = !$meeting->availability; // Toggle status (0 to 1, or 1 to 0)
        $meeting->save();

        return redirect()->back()->with('success', 'Meeting status updated!');
    }
}
