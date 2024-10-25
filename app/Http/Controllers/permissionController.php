<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class permissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('roles-permission.permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('roles-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);
        Permission::create(['name' => $request->name]);
        return redirect('permission')->with('status', 'Permission Created ✅');
    }

    public function edit(Permission $permission)
    {
        return view('roles-permission.permission.edit', ['permissions' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name'
        ]);
        $permission->update(['name' => $request->name]);
        return redirect('permission')->with('status', 'Permission Updated ✅');
    }

    public function destroy($permissionId)
    {
        $permissions = Permission::find($permissionId);
        $permissions->delete();
        return redirect('permission')->with('status', 'Delete action success');
    }
}
