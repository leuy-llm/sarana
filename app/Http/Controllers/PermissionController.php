<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);
        try {
            Permission::create([
                'name' => $request->name
            ]);
            return redirect('permissions')->with('success', __('label.permissionCreateSuccess'));
            // ->with('success', 'Permission created successfully!');
        } catch (\Exception $e) {
            return redirect('permissions')->with('success', __('label.permissionCreatetError'));
            // ->with('error', 'An error occurred while creating the permission.');
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

            return redirect('/users')->with('success', __('label.permissionDeleteSuccess'));
            // with('success', 'The Room was marked as deleted successfully');
        }

        return redirect('/users')->with('error', __('label.permissionDeleteError'));
        // ->with('error', 'Room not found');
    }
    

}
