<?php

namespace App\Http\Services;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissionService
{
    
    public function index(Request $request)
    {
        // Retrieve all permissions and permission groups
        $permissions = Permission::all();
        $permission_groups = PermissionGroup::all();

        // Return the view 'permission.permission-list' with data
        return view('permission.permission-list', compact('permissions', 'permission_groups'));
    }

    /**
     * Retrieve all permissions data for AJAX requests.
    
     */
    public function listData(Request $request)
    {
        // Retrieve all permissions
        $permissions = Permission::all();
        $permission_groups = PermissionGroup::all();

        // Return JSON response if request is AJAX
        if ($request->ajax()) {
            return response()->json([
                'permissions' => $permissions,
            ]);
        }
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Retrieve all permission groups
        $permission_groups = PermissionGroup::all();

        // Return the view 'permission.permission-add' with permission_groups data
        return view('permission.permission-add', compact('permission_groups'));
    }

    /**
     * Store a newly created permission.
     *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $req)
    {
        // Iterate through each permission in the request and save it
        foreach ($req->permissionList as $permission) {
            $data = new Permission;
            $data->name = $permission['route_name'];
            $data->permissions_name = $permission['permission_name'];
            $data->permission_type = $permission['permission_type'];
            $data->group_name = $permission['permission_group'];
            $data->save();
        }

        // Return JSON response indicating success
        return response()->json([
            'status' => 200,
            'message' => 'Permission created Successfully!'
        ]);
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        // Find the permission by ID and retrieve all permission groups
        $permission = Permission::find($id);
        $permission_groups = PermissionGroup::all();

        // If permission exists, return JSON response with data
        if ($permission) {
            return response()->json([
                'status' => 200,
                'permission' => $permission,
                'permission_groups' => $permission_groups,
            ]);
        }
    }

    /**
     * Update the specified permission in storage.
     *
     * @param Request $req
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $req, $id)
    {
        // Update the permission with the provided data
        Permission::findOrFail($id)->update([
            'name' => $req->route_name,
            'group_name' => $req->permission_group,
            'permissions_name' => $req->permission_name,
            'permission_type' => $req->permission_group_type,
        ]);

        // Return JSON response indicating success
        return response()->json([
            'status' => 200,
            'message' => 'Permission Updated Successfully'
        ]);
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Delete the permission by ID
        Permission::findOrFail($id)->delete();

        // Redirect to '/permission-list' with success message
        return redirect('/permission-list')->with('status', 'Deleted successfully!');
    }

    
}
