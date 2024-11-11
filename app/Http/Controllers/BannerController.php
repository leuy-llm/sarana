<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //




    public function banner()
    {
        $banner = Banner::get();
        //orderBy('id', 'desc')->get();
        $header_title = 'Banner Page';
        return view('back_end.banner.index', compact('banner', 'header_title'));
    }

    // public function create(){

    //     $header_title = "Create Banner";
    //     return view('back_end.banner.create',compact('header_title'));
    // }

    public function create()
    {
        // Define the allowed page names
        $pageNames = [
            'rooms' => 'Rooms Page',
            'contact_details' => 'Contact Page',
            'booking' => 'Reservation Page',
            'gallery' => 'Gallery Page'
        ];

        $header_title = "Create Banner";
        return view('back_end.banner.create', compact('header_title', 'pageNames'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:255',
            'banner_image' => 'required|image',
        ]);

        $banner = new Banner();
        $banner->page_name = $request->page_name;

        if ($request->hasFile('banner_image')) {
            $imagePath = $request->file('banner_image')->store('banners', 'public');
            $banner->banner_image = $imagePath;
        }

        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Banner added successfully.');
    }

    public function delete($id)
    {
        try {
            $query = Banner::findOrFail($id);
            $query->delete();

            return redirect('/banners')->with('success', __('label.queryDeleteSuccess'));
        } catch (\Exception $e) {
            return redirect('/banners')->with('success', __('label.queryDeleteError'));
        }
        return redirect('/banners');
    }
}
