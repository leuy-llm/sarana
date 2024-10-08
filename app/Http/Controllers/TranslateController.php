<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TranslateController extends Controller
{
    //
    public function setLang($locale){
       
        $supportedLocales = ['en', 'kh']; // Add all supported locales here

        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }

    
}
