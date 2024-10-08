<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    
    public function index(){
        
        $users = User::getUser();
       
        $header_title = "Manage User";
        return view('back_end.role-permission.user.index', compact('users', 'header_title'));
    }


    public function create()
    {
        $roles = $this->getRole()->pluck('name', 'name');
        $header_title = "Create  User";
        return view('back_end.role-permission.user.create', compact('roles', 'header_title'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other', // Assuming gender options are male, female, other
            'DateOfBirth' => 'required|date|before:today', // Validates date and ensures it's before today
            'phone' => 'required|string|max:15|unique:users,phone', // Ensure phone number is unique
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is unique
            
            'password' => 'required|string|min:8|max:20', // Ensure password is at least 8 characters and matches confirmation
            'roles' => 'required|array|min:1',
            'roles.*' => 'required|string|exists:roles,name',
            
        ]);

        // Log::info('Request Data: ', $request->all());
       
        try {
            // Create a new Guest record
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone =  $request->phone;
            $user->gender =  $request->gender;
            $user->DateOfBirth =  $request->DateOfBirth;
            $user->full_name =  $request->full_name;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->save();
            
            $user->syncRoles($request->roles);
            

            // Set a success message in the session
            return redirect('/users')->with('success', __('label.userCreatedSuccess'));
        } catch (\Exception $e) {
            // Set an error message in the session
            return redirect('/users')->with('error', __('label.userCreatedError'));
        }
    }
    

    public function edit(User $user)
    {
         // Get all roles
    $roles = Role::pluck('name', 'name'); // Pluck the 'name' field of roles
    $header_title = "Edit User";
    // Get the roles that the user currently has
    $userRoles = $user->roles->pluck('name', 'name')->toArray(); // Pluck the 'name' field of user's roles

    // Return the edit view with user and roles data
    return view('back_end.role-permission.user.edit', compact('user','header_title', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'full_name' => 'required|string|max:255',
        'gender' => 'required|in:male,female,other',
        'DateOfBirth' => 'required|date|before:today',
        'phone' => 'required|string|max:15|unique:users,phone,' . $user->id, // Ensure phone is unique except for this user
        'address' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id, // Ensure email is unique except for this user
        'roles' => 'required|array|min:1',
        'roles.*' => 'required|string|exists:roles,name',
    ]);

    try {
        // Update the user's basic information
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->gender = $validated['gender'];
        $user->DateOfBirth = $validated['DateOfBirth'];
        $user->full_name = $validated['full_name'];
        $user->address = $validated['address'];

        // If password is provided, update it
        if ($request->filled('password')) {
            $validated = $request->validate([
                'password' => 'required|string|min:8|max:20',
            ]);
            $user->password = Hash::make($validated['password']);
        }

        // Save the user's updated information
        $user->save();
        

        // Sync the roles (remove old roles and assign new ones)
        $user->syncRoles($validated['roles']);

        // Set a success message in the session
        return redirect('/users')->with('success', __('label.userUpdatedSuccess'));
    } catch (\Exception $e) {
        // Set an error message in the session
        return redirect('/users')->with('error', __('label.userUpdatedError'));
    }
}

    public function destroy($userId)
    {

        $user = User::findOrFail($userId);

        if (!empty($user)) {
            $user->is_deleted = 1;
            $user->save();

            return redirect('/users')->with('success', __('label.userDeleteSuccess'));
            // with('success', 'The Room was marked as deleted successfully');
        }

        return redirect('/users')->with('error', __('label.userDeleteError'));
        // ->with('error', 'Room not found');
    }

    


    public function getRole()
    {
        return Role::where('is_deleted', 0)->get();
    }
    
}
