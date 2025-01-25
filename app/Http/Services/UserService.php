<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
Use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function loadUsers()
    {
        // Get the subscriber ID of the authenticated user
        $subscriberId = Auth::user()->subscriber_id;

        // Fetch users and roles associated with the subscriber ID
        $users = User::where('subscriber_id', $subscriberId)->get();
        $roles = Role::where('subscriber_id', $subscriberId)->get();

        // Return the users and roles in the JSON response
        return response()->json([
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function addUser(Request $request)
    {
        // Log the incoming request (useful for debugging)
        Log::info($request->all());

        // Validate request input
        $attributes = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:11',
            'location' => 'required|string|max:255',
            'password' => 'required|min:8',
            're_enter_password' => 'required|same:password',
        ]);

        // Set the subscriber_id from the authenticated user
        $attributes['subscriber_id'] = Auth::user()->subscriber_id;

        try {
            // Create the user
            $user = User::create($attributes);

            // Assign roles if provided
            if ($request->has('roles')) {
                $user->assignRole($request->input('roles'));
            }

            return back()->withStatus('User Successfully Added.');
        } catch (\Exception $e) {
            // Log the error and return a user-friendly message
            Log::error('Error creating user or assigning roles:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'There was an error creating the user or assigning roles.']);
        }
    }

    public function loadUser($id)
    {
        // Fetch user by ID and check subscriber_id matches
        $user = User::where('id', $id)
                    ->where('subscriber_id', Auth::user()->subscriber_id)
                    ->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Fetch roles associated with the user
        $role = $user->getRoleNames(); // This retrieves the role names associated with the user

        return response()->json([
            'user' => $user,
            'role' => $role, // Return the roles in the response
        ]);
    }

    public function edit(Request $request)
    {
        Log::info($request->input('roles'));

        // Validate request input
        $attributes = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:11',
            'about' => 'nullable',
            'location' => 'required',
            'roles' => 'required|exists:roles,name' // Change to a single role
        ]);

        // Find user by ID and check subscriber_id
        $user = User::where('id', $request->id)
                    ->where('subscriber_id', Auth::user()->subscriber_id)
                    ->first();

        // Check if the user exists
        if (!$user) {
            return back()->withErrors(['user' => 'User not found.']);
        }

        // Update user attributes
        $user->update($attributes);

        // Fetch roles specific to the authenticated subscriber
        $roles = Role::where('subscriber_id', Auth::user()->subscriber_id)->pluck('name')->toArray();

        // Check if the provided role is valid for the subscriber
        if ($request->has('roles')) {
            //replace the current role with the new one
            $user->syncRoles([$request->input('roles')]);
        }

        return back()->withStatus('User Successfully Updated.');
    }

    public function deleteUser(Request $request)
    {
        // Find user by ID and ensure it belongs to the authenticated subscriber
        $user = User::where('id', $request->id)
                    ->where('subscriber_id', Auth::user()->subscriber_id)
                    ->first();

        if (!$user) {
            return back()->withErrors(['error' => 'User not found or unauthorized access.']);
        }

        $user->delete();

        return back()->withStatus('User Successfully Deleted.');
    }
}
