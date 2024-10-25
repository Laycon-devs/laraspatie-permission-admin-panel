<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('roles-permission.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('roles-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);
        Role::create(['name' => $request->name]);
        return redirect('role')->with('status', 'Role Created ✅');
    }

    public function edit(Role $role)
    {
        return view('roles-permission.role.edit', ['roles' => $role]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name'
        ]);
        $role->update(['name' => $request->name]);
        return redirect('role')->with('status', 'Role Updated ✅');
    }

    public function destroy($roleId)
    {
        $roles = Role::find($roleId);
        $roles->delete();
        return redirect('role')->with('status', 'Delete action success');
    }

    public function addPermissionRole($roleId)
    {
        $roles = Role::findOrFail($roleId);
        $permissions = Permission::get();

        $permissionsDB = DB::table('role_has_permissions')
            ->where('role_id', $roleId)
            ->pluck('permission_id')
            ->all();
        // dd($permissionsDB);
        return view('roles-permission.role.add-permission-role', [
            'roles' => $roles,
            'permissions' => $permissions,
            'permissionsDB' => $permissionsDB
        ]);
    }

    public function updatePermissionRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status', 'Permission has been given');
    }
}
