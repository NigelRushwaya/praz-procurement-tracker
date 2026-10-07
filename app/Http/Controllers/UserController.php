<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ==========================================
    // VIEW ALL USERS
    // ==========================================

    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }


    // ==========================================
    // SHOW ADD USER FORM
    // ==========================================

    public function create()
    {
        return view('users.create');
    }


    // ==========================================
    // SAVE NEW USER
    // ==========================================

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:Admin,Staff',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }


    // ==========================================
    // SHOW EDIT USER FORM
    // ==========================================

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    // ==========================================
    // UPDATE USER
    // ==========================================

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:Admin,Staff',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Only change password if a new password was entered
        if ($request->filled('password')) {

            $request->validate([
                'password' => 'min:8',
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }


    // ==========================================
    // DELETE USER
    // ==========================================

    public function destroy(User $user)
    {
        // Prevent admin from deleting their own account
        if ($user->id === auth()->id()) {

            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
