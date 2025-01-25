<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactRequest;


class ContactRequestController extends Controller
{
    public function contact_us_data_list()
    {
        // Return the form view (assuming you have a route to show the form)
        return view('homeview.contact-us-data-list');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'ownerName' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'orgName' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'issueTitle' => 'required|string|max:255',
            'issue-description' => 'required|string',
        ]);

        // Create a new support request record
        ContactRequest::create([
            'owner_name' => $validatedData['ownerName'],
            'email' => $validatedData['email'],
            'org_name' => $validatedData['orgName'],
            'mobile' => $validatedData['mobile'],
            'issue_title' => $validatedData['issueTitle'],
            'issue_description' => $validatedData['issue-description'],
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Contact request submitted successfully.');
    }

    public function getContactUsdata()
    {
        $contactRequests = ContactRequest::all();  // Fetch all contact requests

        return response()->json(['data' => $contactRequests]);
    }
}
