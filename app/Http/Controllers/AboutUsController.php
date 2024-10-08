<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //
    public function index()
    {
        $abouts = AboutUs::orderBy('id', 'DESC')->get();
        $header_title = "About Us";
        return view('back_end.general_setting.about_us.index', compact('header_title', 'abouts'));
    }
}
