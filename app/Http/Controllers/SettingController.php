<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ContactDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    //

    public function index()
    {
        $settings = Setting::orderBy('id', 'DESC')->get();
        $abouts = AboutUs::orderBy('id', 'DESC')->get();
        $contacts = ContactDetail::orderBy('id', 'DESC')->get();
        $header_title = "Settings";
        return view('back_end.general_setting.index', compact('header_title', 'settings', 'abouts','contacts'));
    }

    public function create()
    {
        $header_title = "New RoomType";
        return view("back_end.general_setting.create", compact('header_title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // Handle the file upload for the icon
        $sitePath = null;
        if ($request->hasFile('site_logo')) {
            $sitePath = $request->file('site_logo')->store('site_logo', 'public');
        }
        Setting::create([
            'site_title' => $request->input('site_title'),
            'site_logo' => $sitePath, // Store the icon path in the database
        ]);
        // Redirect or return a response
        return redirect('settings')->with('success', 'Facility created successfully.');
    }
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        $header_title = "Edit Setting";
        return view('back_end.general_setting.edit', compact('setting', 'header_title'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Find the facility by its ID
        $setting = Setting::findOrFail($id);

        // Handle the file upload for the icon
        if ($request->hasFile('site_logo')) {
            // Delete the old icon if it exists
            if ($setting->site_logo) {
                Storage::disk('public')->delete($setting->site_logo);
            }

            // Store the new icon
            $iconPath = $request->file('site_logo')->store('site_logo', 'public');
            $setting->site_logo = $iconPath; // Update the icon path
        }

        // Update the facility details
        $setting->update([
            'site_title' => $request->input('site_title'),

        ]);
        // Save the changes to the facility
        $setting->save();

        // Redirect or return a response
        return redirect('settings')->with('success', 'Setting updated successfully.');
    }


    /* ============ About section ========== */
    public function about()
    {
        $abouts = AboutUs::orderBy('id', 'DESC')->get();
        return view('back_end.general_setting.about_us.create', compact('abouts'));
    }

    public function aboutstore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // Handle the file upload for the icon
        $iconPath = null;
        if ($request->hasFile('image')) {
            $iconPath = $request->file('image')->store('site_logo', 'public');
        }

        AboutUs::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $iconPath, // Store the icon path in the database
        ]);

        return redirect('settings')->with('success', 'Facility created successfully.');
    }

    public function aboutedit($id)
    {
        $about = AboutUs::findOrFail($id);
        $header_title = "Edit About Us";
        return view('back_end.general_setting.about_us.edit', compact('about', 'header_title'));
    
    }

    public function aboutupdate(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Find the facility by its ID
        $about = AboutUs::findOrFail($id);

        // Handle the file upload for the icon
        if ($request->hasFile('image')) {
            // Delete the old icon if it exists
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }

            $sitePath = $request->file('image')->store('site_logo', 'public');
            $about->image = $sitePath; // Update the icon path
        }

        // Update the facility details
        $about->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $about->save();
        return redirect('settings')->with('success', 'Setting updated successfully.');
    }
    /*=================== Contact Section ==================== */
    public function contact()
    {
        return view('back_end.general_setting.index');
    }

    public function contactedit($id){
        $contact = ContactDetail::findOrFail($id);
        $header_title = "Edit Contact Detail";
        return view('back_end.general_setting.contact_details.edit', compact('contact', 'header_title'));
    }

    public function contactupdate(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'address' => 'required|string|max:100',
            'gmap' => 'nullable|string',
            'pn1' => 'required|string',
            'pn2' => 'required|string',
            'pn3' => 'required|string',
            
            'email' => 'required|string',
            'fb' => 'required|string',
            'insta' => 'required|string',
            'tele' => 'required|string',
            'tripa' => 'required|string',
            'iframe' => 'required|string',
            
        ]);

        // Find the facility by its ID
        $contact = ContactDetail::findOrFail($id);

        // Handle the file upload for the icon

        // Update the facility details
        $contact->update([
            'address' => $request->input('address'),
            'gmap' => $request->input('gmap'),
            'pn1' => $request->input('pn1'),
            'pn2' => $request->input('pn2'),
            'pn3' => $request->input('pn2'),

            'email' => $request->input('email'),
            'fb' => $request->input('fb'),
            'insta' => $request->input('insta'),
            'tele' => $request->input('tele'),
            'tripa' => $request->input('tripa'),
            'iframe' => $request->input('iframe'),
        ]);

        // Save the changes to the facility
        $contact->save();
        return redirect('settings')->with('success', 'Contact updated successfully.');
    }
}
