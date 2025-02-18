<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Guest;
use App\Exports\GuestExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:guests,email',
            'mobile' => 'required|numeric|min:11|unique:guests,mobile',
            'address' => 'required|string|max:255',
            'zip' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'password' => 'required|string|min:6',
        ]);

        try {
            // Create a new Guest record
            $guest = new Guest();
            $guest->first_name = $request->first_name;
            $guest->last_name = $request->last_name;
            $guest->email = $request->email;
            $guest->mobile = $request->mobile;
            $guest->address = $request->address;
            $guest->zip = $request->zip;
            $guest->country = $request->country;
            $guest->city = $request->city;
            $guest->password = bcrypt($request->password); // Hash the password
            $guest->email_verified_at = null; // Set default for email verification
            $guest->save();

            return redirect('/guests')->with('success', __('label.guestCreatedSuccess'));
        } catch (\Exception $e) {
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:guests,email,' . $id,
            'mobile' => 'required|numeric|min:11|unique:guests,mobile,' . $id,
            'address' => 'required|string|max:255',
            'zip' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
        ]);

        try {
            $guest = Guest::findOrFail($id);
            $guest->first_name = $request->first_name;
            $guest->last_name = $request->last_name;
            $guest->email = $request->email;
            $guest->mobile = $request->mobile;
            $guest->address = $request->address;
            $guest->zip = $request->zip;
            $guest->country = $request->country;
            $guest->city = $request->city;
            if ($request->filled('password')) {
                $guest->password = bcrypt($request->password); // Hash the new password if provided
            }
            $guest->save();

            return redirect('/guests')->with('success', __('label.guestUpdatedSuccess'));
        } catch (\Exception $e) {
            return redirect('/guests')->with('error', __('label.guestUpdatedError'));
        }
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

    public function show($guestId)
    {
        $guest = Guest::findOrFail($guestId);
        return view('back_end.guest.detail', compact('guest'));
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

    public function showRegistrationForm(Request $request)
    {
        if ($request->has('redirect')) {
            session(['url.intended' => $request->input('redirect')]);
        }

        return view('auth.guest_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:15',
            'last_name' => 'required|string|max:15',
            'zip' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:guests',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string',
            'city' => 'required|string|max:255', // Fixed here
            'country' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $guest = Guest::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'zip' => $request->zip,
            'country' => $request->country,
            'city' => $request->city,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // Log in the guest
        auth('guest')->login($guest);

        // Send email verification notification
        $guest->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('message', 'Please check your email for a verification link.');
    }
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the guest
        $credentials = $request->only('email', 'password');

        if (Auth::guard('guest')->attempt($credentials)) {
            // Redirect to the provided redirect URL or default to homepage
            $redirect = $request->input('redirect', route('homepage'));
            return redirect()->to($redirect);
        }

        // Return back with an error message if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
    public function logout()
    {
        auth('guest')->logout();
        return redirect()->route('homepage')->with('message', 'You have been logged out.');
    }
}
