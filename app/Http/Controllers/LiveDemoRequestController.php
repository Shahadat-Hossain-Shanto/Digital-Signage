<?php

namespace App\Http\Controllers;

use App\Models\LiveDemoRequest;
use Illuminate\Http\Request;

class LiveDemoRequestController extends Controller
{
    public function login()
    {
        // Return the form view (assuming you have a route to show the form)
        return view('homeview.login');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'orgName' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'numberOfScreen' => 'required|integer',
            'screenType' => 'required|string|max:255',
            'comments' => 'nullable|string',
        ]);

        // Save the validated data into the database
        LiveDemoRequest::create($validated);

        // Redirect or respond with a success message
        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }

    public function request_a_demo_data_list()
    {
        // Return the form view (assuming you have a route to show the form)
        return view('homeview.request-a-demo-data-list');
    }

    public function getRequestDemoData()
    {
        // Fetch demo requests, ordered by created_at in ascending order (oldest first)
        $demoRequests = LiveDemoRequest::all();

        // Return the data as JSON
        return response()->json([
            'data' => $demoRequests
        ]);
    }
}
