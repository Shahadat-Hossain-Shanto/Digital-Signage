<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PermissionService;

class PermissionController extends Controller
{
    protected $permission_service;

    // Constructor to inject PermissionService dependency
    public function __construct(PermissionService $permission_service)
    {
        $this->permission_service = $permission_service;
    }

    // Method to display index page with permissions
    public function index(Request $request)
    {
        return $this->permission_service->index($request);
    }

    // Method to list permissions data
    public function listData(Request $request)
    {
        return $this->permission_service->listData($request);
    }

    // Method to show create permission form
    public function create()
    {
        return $this->permission_service->create();
    }

    // Method to store a new permission
    public function store(Request $request)
    {
        return $this->permission_service->store($request);
    }

    // Method to show edit form for a specific permission
    public function edit($id)
    {
        return $this->permission_service->edit($id);
    }

    // Method to update a specific permission
    public function update(Request $request, $id)
    {
        return $this->permission_service->update($request, $id);
    }

    // Method to delete a specific permission
    public function destroy($id)
    {
        return $this->permission_service->destroy($id);
    }
}

