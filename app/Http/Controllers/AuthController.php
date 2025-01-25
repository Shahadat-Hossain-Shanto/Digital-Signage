<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('homeview.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Hardcoded credentials
        $validUsername = 'wasim@gmail.com';
        $validPassword = 'wasim';

        // Retrieve user input
        $username = $request->input('username');
        $password = $request->input('password');

        // Validate credentials
        if ($username === $validUsername && $password === $validPassword) {
            // Regenerate session ID for security
            $request->session()->regenerate();

            // Set a session variable to indicate the user is logged in
            session(['loggedIn' => true]);

            // Debugging: Check session variables
            // Uncomment to see session contents
            // dd($request->session()->all());

            // Redirect to the intended page after login
            return redirect()->route('request-a-demo-data-list');
        } else {
            // Redirect back to login with error message if credentials are invalid
            return redirect()->route('loginl')->with('error', 'Invalid username or password');
        }
    }

    // Handle logout
    public function logoutl(Request $request)
    {
        // Forget the 'loggedIn' session variable and invalidate the session
        $request->session()->forget('loggedIn');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Optional: Uncomment to confirm session is cleared for debugging
        // dd($request->session()->all());

        // Redirect to login page after logout
        return redirect()->route('loginl');
    }
}
