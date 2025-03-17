<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;


class PermissionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission:create-permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:view-permission', ['only' => ['index', 'show']]);
        $this->middleware('permission:update-permission', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }
    public function index(){
        
        $permissions = $this->getPermission();
        $data['header_title'] = 'Permission List';
        return view('back_end.role-permission.permission.index', ['permissions' => $permissions], $data);
    }
    public function getPermission()
    {
        return Permission::where('is_deleted', 0)->get();
    }

    public function create()
    {
        $data['header_title'] = "Add Permission";
        return view('back_end.role-permission.permission.create', $data);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => [
    //             'required',
    //             'string',
    //             Role::unique('permissions', 'name')->where(function ($query) {
    //                 return $query->where('is_deleted', 0);
    //             })
    //         ]
    //     ]);
    //     try {
    //         Permission::create([
    //             'name' => $request->name
    //         ]);
    //         return redirect('permissions')->with('success', __('label.permissionCreatedSuccess'));
    //         // ->with('success', 'Permission created successfully!');
    //     } catch (\Exception $e) {
    //         return redirect('permissions')->with('success', __('label.permissionCreatedtError'));
    //         // ->with('error', 'An error occurred while creating the permission.');
    //     }
    // }
    public function store(Request $request)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            Rule::unique('permissions', 'name')->where(function ($query) {
                return $query->where('is_deleted', 0); // Only check for non-deleted records
            })
        ]
    ]);

    try {
        // Check if a permission with the same name already exists and is marked as deleted
        $existingPermission = Permission::where('name', $request->name)->where('is_deleted', 1)->first();
        if ($existingPermission) {
            // Restore the existing permission instead of creating a new one
            $existingPermission->is_deleted = 0;
            $existingPermission->save();
        } else {
            // Create a new permission
            Permission::create([
                'name' => $request->name
            ]);
        }

        return redirect('permissions')->with('success', __('label.permissionCreatedSuccess'));
    } catch (\Exception $e) {
        return redirect('permissions')->with('error', __('label.permissionCreatedError'));
    }
}

    public function edit(Permission $permission)
    {
        $data['header_title'] = "Edit Permission";
        return view('back_end.role-permission.permission.edit', ['permission' => $permission], $data);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        if ($request->name) {
            return redirect('/permissions')->with('success', __('label.permissionUpdateSuccess'));
        } else {
            return redirect('/permissions')->with('success', __('label.permissionUpdateError'));
        }
        return redirect('permissions');
    }

    public function destroy($permissionId)
    {
      
        $permission = Permission::findOrFail($permissionId);

        if (!empty($permission)) {
            $permission->is_deleted = 1;
            $permission->save();

            return redirect('/permissions')->with('success', __('label.permissionDeleteSuccess'));
            // with('success', 'The Room was marked as deleted successfully');
        }
        return redirect('/permissions')->with('error', __('label.permissionDeleteError'));
        // ->with('error', 'Room not found');
    }
    

}
