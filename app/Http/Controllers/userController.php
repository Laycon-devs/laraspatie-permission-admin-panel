<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('role: manager')->only('edit');
    }
    public function index()
    {
        $users = User::all();
        return view('roles-permission.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name');
        return view('roles-permission.users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|array'
        ]);
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $users->syncRoles($request->role);
        return redirect('users')->with('status', 'User account created and roles assigned successfully');
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $userCurrentRoles = $user->getRoleNames()->all();
        $roles = Role::pluck('name');

        return view('roles-permission.users.edit', [
            'user' => $user,
            'userCurrentRoles' => $userCurrentRoles,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        if (!empty($request->password)) {
            $request->validate([
                'name' => 'required|string|max:255',
                'role' => 'required|array',
                'password' => 'required|string|min:6',
            ]);
            $data = [
                'name' => $request->name,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ];
            $user->update($data);
            $user->syncRoles($data['role']);
            return redirect()->back()->with('status', 'User account updated successfully');
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'role' => 'required|array',
            ]);
            $data = [
                'name' => $request->name,
                'role' => $request->role,
            ];
            $user->update($data);
            $user->syncRoles($data['role']);
            return redirect('users')->with('status', 'User account updated successfully without password');
        }
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('users')->with('status', 'User account deleted');
    }
}
