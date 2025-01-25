<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RoleService;

class RoleController extends Controller
{
    protected $role_service;

    // Constructor to inject RoleService dependency
    public function __construct(RoleService $role_service)
    {
        $this->role_service = $role_service;
    }

    // Method to display create role form
    public function create()
    {
        return $this->role_service->create();
    }

    // Method to display index page of roles
    public function index()
    {
        return $this->role_service->index();
    }

    // Method to store a new role
    public function store(Request $request)
    {
        return $this->role_service->store($request);
    }

    // Method to display edit form for a specific role
    public function edit($id)
    {
        return $this->role_service->edit($id);
    }

    // Method to update a specific role
    public function update(Request $request, $id)
    {
        return $this->role_service->update($request, $id);
    }

    // Method to delete a specific role
    public function destroy($id)
    {
        return $this->role_service->destroy($id);
    }
}
