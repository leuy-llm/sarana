<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Guest;
use App\Exports\GuestExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class GuestController extends Controller
{
    //
    public function index()
    {
        // ->orderBy('id', 'desc')->get();
        // $guests = Guest::where('is_deleted',0)->orderBy('id','desc')->get();
        $guests = Guest::getGuest();
        $header_title = "Manage Guest";
        return view('back_end.guest.guest', compact('guests', 'header_title'));
    }

    public function create()
    {

        $header_title = "New Guest";
        return view('back_end.guest.create', compact('header_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:guests,name',
            'email' => 'required|email|max:20|unique:guests,email',
            'mobile' => 'required|numeric|min:11|unique:guests,mobile',
            'address' => 'required|string|max:255',

        ]);
        try {
            // Create a new Guest record
            $guest = new Guest();
            $guest->name = $request->name;
            $guest->email = $request->email;
            $guest->mobile = $request->mobile;
            $guest->address = $request->address;
            $guest->password = '';
            $guest->save();

            // Set a success message in the session
            return redirect('/guests')->with('success', __('label.guestCreatedSuccess'));
        } catch (\Exception $e) {
            // Set an error message in the session
            return redirect('/guests')->with('error', __('label.guestCreatedError'));
        }
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        $header_title = "Edit Guest";
        return view('back_end.guest.edit', compact('guest', 'header_title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:guests,email,' . $id,
            'mobile' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $guest = Guest::findOrFail($id);

        $guest->name = $request->name;
        $guest->email = $request->email;
        $guest->mobile = $request->mobile;
        $guest->address = $request->address;
        $guest->password = '';
        $guest->save();

        return redirect('/guests')->with('success', __('label.guestUpdatedSuccess'));
    }

    public function destroy($guestId)
    {
        $guest = Guest::findOrFail($guestId);

        if (!empty($guest)) {
            $guest->is_deleted = 1;
            $guest->save();

            // return redirect('/guests')->with('success', 'The guest was marked as deleted successfully');
            return redirect('/guests')->with('success', __('label.guestDeleteSuccess'));
        }

        return redirect('/guests')->with('error', __('label.guestDeleteError'));
    }


    /*========== Export Guest function ============== */
    public function export(Request $request)
    {

        if ($request->type == 'xlsx') {
            $extension = 'xlsx';
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == 'csv') {
            $extension = 'csv';
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == 'xls') {
            $extension = 'xls';
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = 'xlsx';
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }
        $filename = 'guests-' . date('d-m-Y') . '.' . $extension;
        return Excel::download(new GuestExport, $filename, $exportFormat);
    }

    // public function show(){

    // }

    // function register(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:guests',
    //         'mobile' => 'required|numeric|unique:guests',
    //         'address' => 'nullable|string|max:255',
    //         'password' => 'required|string|min:8|confirmed', // assuming password needs confirmation

    //     ]);


    //     $guest = Guest::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'mobile' => $request->mobile,
    //         'address' => $request->address,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     auth()->guard('guest')->login($guest);

    //     return redirect()->back();
    // }
    public function register(Request $request)
    {
        // Custom validation handling with error bag
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:guests',
                'mobile' => 'required|numeric|unique:guests',
                'address' => 'nullable|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator, 'registerErrors')->withInput();
        }

        // Registration logic
        $guest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        auth()->guard('guest')->login($guest);
        // Add a notification when a new query is created
        $notifications = session()->get('notifications', []);

        // Generate a new ID based on the count of existing notifications
        $id = count($notifications) + 1;

        $notifications[] = [
            'id' => $id,
            'type' => 'new_registration',
            'message' => 'A new guest has registered: ' . $guest->name,
            'time' => now()->format('Y-m-d H:i:s'),
        ];

        // Store the updated notifications back in the session
        session(['notifications' => $notifications]);
        return redirect()->back();
    }



    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::guard('guest')->attempt($credentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->back(); // redirect after login
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

    public function login(Request $request)
    {

        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator, 'loginErrors')->withInput();
        }

        if (Auth::guard('guest')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('reservation');
        }

        // Login failed, return with an error message to loginErrors
        return redirect()->back()->withErrors(['login' => 'Invalid email or password.'], 'loginErrors')->withInput();
    }

    public function logout()
    {
        auth()->guard('guest')->logout();
        return redirect()->back(); // Redirect to homepage after logout
    }
}
