<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10); // Paginate users for easier viewing
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Retrieve all roles
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'roles' => 'required|array'
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
    ]);

    // Retrieve role names from the roles array in the request
    $roleNames = Role::whereIn('id', $validatedData['roles'])->pluck('name')->toArray();
    $user->syncRoles($roleNames);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Retrieve all roles
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'roles' => 'required|array'
    ]);

    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
    ]);

    // Retrieve role names from the roles array in the request
    $roleNames = Role::whereIn('id', $validatedData['roles'])->pluck('name')->toArray();
    $user->syncRoles($roleNames);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

