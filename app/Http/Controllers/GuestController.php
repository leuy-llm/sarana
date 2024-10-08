<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Guest;
use App\Exports\GuestExport;
use Illuminate\Http\Request;
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
            'password' => 'required|string|min:8|max:20',
            'mobile' => 'required|numeric|min:11|unique:guests,mobile',
            'address' => 'required|string|max:255',
        ]);

        // Log::info('Request Data: ', $request->all());
        $strippedMobile = preg_replace('/\D/', '', $request->mobile);
        try {
            // Create a new Guest record
            $guest = new Guest();
            $guest->name = $request->name;
            $guest->email = $request->email;
            $guest->mobile = $strippedMobile;
            $guest->address = $request->address;
            $guest->password = Hash::make($request->password);
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
            'password' => 'nullable|string|min:8|max:20',
            'mobile' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $guest = Guest::findOrFail($id);

        $guest->name = $request->name;
        $guest->email = $request->email;
        $guest->mobile = $request->mobile;
        $guest->address = $request->address;

        if (!empty($request->password)) {
            $guest->password = Hash::make($request->password);
        }

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
            return redirect('/guests')->with('success', __('label.roomDeleteSuccess'));
        }

        return redirect('/guests')->with('error', __('label.roomDeleteError'));
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
}
