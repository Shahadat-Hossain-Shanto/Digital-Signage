<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PermissionGroupService;

class PermissionGroupController extends Controller
{
    // Property to hold the instance of PermissionGroupService
    protected $permission_group_service;

    // Constructor to initialize the PermissionGroupService
    public function __construct(PermissionGroupService $permission_group_service)
    {
        $this->permission_group_service = $permission_group_service;
    }

    // Function to display the create permission group form
    public function create()
    {
        // Return the view 'permission/permission_group/group-create'
        return view('permission/permission_group/group-create');
    }

    // Function to store a new permission group
    public function store(Request $request)
    {
        // Call the store method from PermissionGroupService and pass the request
        return $this->permission_group_service->store($request);
    }

    // Function to list permission groups
    public function listdata(Request $request)
    {
        // Call the listdata method from PermissionGroupService and pass the request
        return $this->permission_group_service->listdata($request);
    }

    // Function to edit a permission group based on ID
    public function edit($id)
    {
        // Call the edit method from PermissionGroupService and pass the permission group ID
        return $this->permission_group_service->edit($id);
    }

    // Function to update an existing permission group
    public function update(Request $request, $id)
    {
        // Call the update method from PermissionGroupService and pass the request and permission group ID
        return $this->permission_group_service->update($request, $id);
    }

    // Function to delete a permission group based on ID
    public function destroy($id)
    {
        // Call the destroy method from PermissionGroupService and pass the permission group ID
        return $this->permission_group_service->destroy($id);
    }
}

