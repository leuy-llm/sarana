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
        'email'=>'required',
        'password'=>'required'
       ]);

       if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect('login');
    } else {
        return redirect()->back()->withErrors(['name' => 'Invalid name or password.']);
    }
    }
}
