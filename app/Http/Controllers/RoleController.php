<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);

        // Retrieve permission names from the permissions array in the request
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissionNames);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit($id)
    {
        $role = Role::findById($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
{
    $role = Role::findById($id);

    $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
        'permissions' => 'required|array',
    ]);

    $role->name = $request->name;
    $role->save();

    // Retrieve permission names from the permissions array in the request
    $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
    $role->syncPermissions($permissionNames);

    return redirect()->route('roles.index')->with('success', 'Role updated successfully');
}

    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
