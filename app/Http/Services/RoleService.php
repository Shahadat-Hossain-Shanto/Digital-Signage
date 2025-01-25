<?php

namespace App\Http\Services;

use Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleService
{
    // Function to display the list of roles
    public function index()
    {
        // Retrieve roles that belong to the currently authenticated user's subscriber
        $roles = Role::where('subscriber_id', Auth::user()->subscriber_id)->get();
        // Return the view for displaying roles with the retrieved roles
        return view('role.role-index', compact('roles'));
    }

    public function create()
    {
        // Get the authenticated user's subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve all permissions (no filtering by subscriber ID)
        $permissions = Permission::all();

        // Retrieve distinct permission groups (no filtering by subscriber ID)
        $permission_groups = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();

        // Return the view for creating a role with the retrieved permissions and permission groups
        return view('role.role-create', compact('permissions', 'permission_groups', 'subscriberId'));
    }

    // Function to store a new role
    // Function to store a new role
    public function store(Request $request)
    {
        // Custom validation error messages
        $messages = [
            'rolename.required' => "Role name is required.",
            'rolename.unique' => "Role name must be unique for this subscriber.",
        ];

        // Validator for role name
        $validator = Validator::make($request->all(), [
            'rolename' => 'required|unique:roles,name,NULL,id,subscriber_id,' . Auth::user()->subscriber_id,
        ], $messages);

        // If validation passes
        if ($validator->passes()) {
            // Create a new role and set its attributes
            $role = new Role();
            $role->name = $request->rolename;
            $role->subscriber_id = Auth::user()->subscriber_id; // Associate with subscriber
            $role->save();

            // Sync the role's permissions if provided
            $permissions = $request->input('permissions');
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            // Redirect to the roles list
            return redirect()->route('admin.roles')->with('success', 'Role created successfully.');
        }

        // Return validation errors if validation fails
        return response()->json(['error' => $validator->errors()]);
    }


    // Function to display the edit role form
    public function edit($id)
    {
        // Find the role by ID and check subscriber_id
        $role = Role::where('id', $id)
                    ->where('subscriber_id', Auth::user()->subscriber_id)
                    ->first();

        if (!$role) {
            return back()->withErrors(['role' => 'Role not found or not accessible.']);
        }

        // Retrieve distinct permission groups
        $permissions = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();

        // Return the view for editing a role with the retrieved role and permissions
        return view('role.role-edit', compact('role', 'permissions'));
    }

    // Function to update an existing role
    public function update(Request $request, $id)
    {
        // Find the role by ID and check subscriber_id
        $role = Role::where('id', $id)
                    ->where('subscriber_id', Auth::user()->subscriber_id)
                    ->first();

        if (!$role) {
            return back()->withErrors(['role' => 'Role not found or not accessible.']);
        }

        // Validate the role name
        $request->validate([
            'rolename' => 'required|unique:roles,name,' . $role->id . ',id,subscriber_id,' . Auth::user()->subscriber_id,
        ]);

        // Update the role's name
        $role->name = $request->rolename;

        // Sync the role's permissions if provided
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        $role->save();

        // Flash success message and redirect to the roles list
        session()->flash('success', 'Role has been updated !!');
        return redirect()->route('admin.roles');
    }

    // Function to delete a role
    public function destroy($id)
    {
        // Find the role by ID and check subscriber_id
        $role = Role::where('id', $id)
                    ->where('subscriber_id', Auth::user()->subscriber_id)
                    ->first();

        if (!$role) {
            return back()->withErrors(['role' => 'Role not found or not accessible.']);
        }

        // Prevent deletion of the 'admin' role
        if ($role->name == 'admin') {
            return redirect('/role-list')->withErrors(['role' => 'Cannot delete the admin role.']);
        } else {
            // Delete the role and flash success message
            $role->delete();
            session()->flash('success', 'Role has been deleted !!');
            return back();
        }
    }
}
