<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
// use App\Models\Role; // Import your custom Role model

use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    
   
    public function index()
    {

        // $roles = Role::getRole();
        $roles = $this->getRole(); // Use $this->getRole() to call the method within the same controller
        $data['header_title'] = 'Role List';
        return view('back_end.role-permission.role.index', ['roles' => $roles], $data);
    }
    

    public function create()
    {
        $data['header_title'] = 'Add New Role';
        return view('back_end.role-permission.role.create', $data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);
        Role::create([
            'name' => $request->name
        ]);
        if ($request->name) {
            return redirect('/roles')->with('success', __('label.roleCreatedSuccess'));
        } else {
            return redirect('/roles')->with('error', __('label.roleCreatedError'));
        }
        return redirect('roles');
    }
    public function edit(Role $role)
    {
        $data['header_title'] = 'Edit Role';
        return view('back_end.role-permission.role.edit', ['role' => $role], $data);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);
        if ($request->name) {
            return redirect('/roles')->with('success', __('label.rolesUpdatedSucess'));
        } else {
            return redirect('/roles')->with('error', __('label.rolesUpdatedError'));
        }
        return redirect('roles');
    }
    public function destroy($roleId)
    {

        // try {
        //     $role = Role::findOrFail($roleId);
        //     $role->delete();

        //     return redirect('/roles')->with('success', __('label.roomDeleteSuccess'));
        // } catch (\Exception $e) {
        //     return redirect('/roles')->with('error', __('label.roomDeleteError'));
        // }
        // return redirect()->route('roles.index');
        $role = Role::findOrFail($roleId);

        if (!empty($role)) {
            $role->is_deleted = 1;
            $role->save();

            return redirect('/roles')->with('success', __('label.roleDeleteSuccess'));
           
        }

        return redirect('/roles')->with('error', __('label.roleDeleteError'));
        
    }

   
    public function addPermissionToRole($roleId)
    {

        $permissions = $this->getPermission();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        // Flash message for success


        return view('back_end.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }


    public function givePermissionToRole(Request $request, $roleId)
    {
        try {

            $request->validate([
                'permission' => 'required'
            ]);
            $role = Role::findOrFail($roleId);
            $role->syncPermissions($request->permission);

            // Toastr::success('Permissions added to role!', 'Congrats', ['timeout' => 6000]);
            return redirect('/roles')->with('success', __('label.roomGivePerSuccess'));
            return redirect('roles');
        } catch (\Exception $e) {
            return redirect('/roles')->with('error', __('label.roomGivePerError') . $e->getMessage());

            return redirect()->back();
        }
    }

    public function getRole()
    {
        return Role::where('is_deleted', 0)->get();
    }

    public function getPermission()
    {
        return Permission::where('is_deleted', 0)->get();
    }

}
