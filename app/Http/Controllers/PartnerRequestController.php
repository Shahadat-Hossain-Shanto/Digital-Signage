<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartnerRequest;

class PartnerRequestController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'ownerName' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'orgName' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'issue-description' => 'required|string',
        ]);

        // Create a new support request record in the database
        PartnerRequest::create([
            'owner_name' => $validatedData['ownerName'],
            'email' => $validatedData['email'],
            'org_name' => $validatedData['orgName'],
            'mobile' => $validatedData['mobile'],
            'issue_description' => $validatedData['issue-description'],
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Partner request submitted successfully.');
    }

    public function partner_data_list()
    {
        // Return the form view (assuming you have a route to show the form)
        return view('homeview.become-our-partner-data-list');
    }

    public function getPartnerdata()
    {
        $contactRequests = PartnerRequest::all();  // Fetch all contact requests

        return response()->json(['data' => $contactRequests]);
    }
}
