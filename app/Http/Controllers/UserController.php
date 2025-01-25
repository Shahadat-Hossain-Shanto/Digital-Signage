<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        // Get the authenticated user's subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve roles for the specific subscriber
        $roles = Role::where('subscriber_id', $subscriberId)->get();

        return view('user.user-management', compact('roles'));
    }

    public function loadUsers()
    {
        return $this->userService->loadUsers();
    }

    public function addUser(Request $request)
    {
        return $this->userService->addUser($request);
    }

    public function loadUser($id)
    {
        return $this->userService->loadUser($id);
    }

    public function edit(Request $request)
    {
        return $this->userService->edit($request);
    }

    public function deleteUser(Request $request)
    {
        return $this->userService->deleteUser($request);
    }
}
