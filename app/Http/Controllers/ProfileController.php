<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.user-profile');
    }

    public function edit()
    {
        return view('user.user-profile-edit');
    }

    public function profileView()
    {
        return view('user.profile');
    }

    public function profileUpdate()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:subscribers,email,' . auth()->user()->subscriber->id,
            'subLogo' => 'nullable|image|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            if (request()->hasFile('subLogo')) {
                $file = request()->file('subLogo');
                $imageName =  $file->getClientOriginalName();
                $file->move('assets/img/logo', $imageName);
                request()->merge(['logo' => $imageName]);
            }
            auth()->user()->subscriber->update(request()->all());
            return response()->json([
                'status' => 201,
                'message' => 'Profile successfully updated.'
            ]);
        }
    }

    public function update()
    {
        $user = request()->user();

        $attributes = request()->validate([
            'name' => 'required',
            'phone' => 'required|max:11|min:11',
            'location' => 'required',
            'about' => 'required:max:150'
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    }

    public function changePasswordView()
    {
        return view('user.user-profile-edit-change-password');
    }

    public function changePassword()
    {
        $user = request()->user();

        $attributes = request()->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $password = User::find($user->id)->password;

        if (Hash::check($attributes['current_password'], $password)) {
            $user->update([
                'password' => $attributes['password'],
            ]);
            return back()->withStatus('Password successfully updated.');
        } else {
            return back()->withStatus('Password Dose not match.');
        }
    }
}
