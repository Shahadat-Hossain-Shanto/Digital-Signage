<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissionGroupService
{
    /**
     * Retrieve all permission groups.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listData(Request $request)
    {
        // Retrieve all permission groups
        $permission_groups = PermissionGroup::all();

        // Return JSON response if request is AJAX
        if ($request->ajax()) {
            return response()->json([
                'permission_groups' => $permission_groups,
            ]);
        }
    }

    /**
     * Store a new permission group.
     *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $req)
    {
        // Validation messages for custom error messages
        $messages = [
            'group_name.required' => "Group name is required.",
            'group_name.unique' => "Group name already exists."
        ];

        // Validation rules
        $validator = Validator::make($req->all(), [
            'group_name' => 'required|unique:permission_groups',
        ], $messages);

        // If validation passes, create and save the permission group
        if ($validator->passes()) {
            $data = new PermissionGroup();
            $data->group_name = $req->group_name;
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Permission Group Created Successfully'
            ]);
        }

        // If validation fails, return errors
        return response()->json(['error' => $validator->errors()]);
    }

    /**
     * Retrieve a specific permission group for editing.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        // Find the permission group by ID
        $permission_group = PermissionGroup::find($id);

        // If permission group exists, return JSON response
        if ($permission_group) {
            return response()->json([
                'status' => 200,
                'permission_group' => $permission_group,
            ]);
        }
    }

    /**
     * Update a specific permission group.
     *
     * @param Request $req
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $req, $id)
    {
        // Validation messages for custom error messages
        $messages = [
            'group_name.required' => "Group name is required.",
            'group_name.unique' => "Group name already exists."
        ];

        // Validation rules
        $validator = Validator::make($req->all(), [
            'group_name' => 'required|unique:permission_groups,group_name,' . $id,
        ], $messages);

        // If validation passes, update the permission group
        if ($validator->passes()) {
            PermissionGroup::findOrFail($id)->update([
                'group_name' => $req->group_name,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Permission Group Updated Successfully'
            ]);
        }

        // If validation fails, return errors
        return response()->json(['error' => $validator->errors()]);
    }

    /**
     * Delete a specific permission group.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find and delete the permission group by ID
        PermissionGroup::find($id)->delete();

        // Redirect with success message (assuming route 'permission.group.create' exists)
        return redirect()->route('permission.group.create')->with('status', 'Deleted successfully!');
    }
}
