<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/All', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Create');
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'join_date' => 'nullable|date',
            'country' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|string|max:10',
            'language' => 'nullable|string|max:255',
            'duty_schedule' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        // Update the user
        $user->update($validated);

        return redirect()->route('users.all')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.all')->with('success', 'User deleted successfully');
    }
}
