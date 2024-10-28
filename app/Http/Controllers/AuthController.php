<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function Auth(){

        return view('auth.login');
    }


    public function login(Request $request)
    {
      $request->validate([
        'name'=>'required',
        'password'=>'required'
       ]);

       if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
        return redirect()->route('app');
    } else {
        return redirect()->back()->withErrors(['name' => 'Invalid name or password.']);
    }
}

    public function dashboard(){

        return view('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
