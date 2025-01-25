<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportRequest;

class SupportRequestController extends Controller
{
    // Store support request data
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'orgName' => 'required|string|max:255',
            'mobile' => 'required|digits_between:10,15',
            'issueTitle' => 'required|string|max:255',
            'issue_description' => 'required|string',
            'ticketNumber' => 'required|string|unique:support_requests',
            'status' => 'required|string',
        ]);

        // Save the data to the database
        SupportRequest::create($validatedData);

        return redirect()->back()->with('success', 'Support Request Submitted Successfully!');
    }

    // Check for an existing ticket number
    public function checkTicket(Request $request)
    {
        $ticketNum = $request->query('ticketNum');
        $ticket = SupportRequest::where('ticketNumber', $ticketNum)->first();

        if ($ticket) {
            return response()->json(['message' => 'Ticket found: ' . $ticket->status]);
        } else {
            return response()->json(['message' => 'Ticket not found.']);
        }
    }

    public function support_data_list()
    {
        // Return the form view (assuming you have a route to show the form)
        return view('homeview.support-data-list');
    }

    public function getSupportData()
    {
        $supportRequests = SupportRequest::all();
        return response()->json(['data' => $supportRequests]);
    }

    public function delete($id)
    {
        $supportRequest = SupportRequest::findOrFail($id);
        $supportRequest->delete();

        return response()->json(['message' => 'Support Request Deleted Successfully!']);
    }

    // Edit (fetch data for editing)
    public function edit($id)
    {
        $supportRequest = SupportRequest::findOrFail($id);
        return view('homeview.edit-support-data-list', compact('supportRequest'));
    }

    // Update a support request
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'orgName' => 'required|string|max:255',
            'mobile' => 'required|digits_between:10,15',
            'issueTitle' => 'required|string|max:255',
            'issue_description' => 'required|string',
            'status' => 'required|string',
        ]);

        $supportRequest = SupportRequest::find($id);

        if (!$supportRequest) {
            return redirect()->route('home')->with('error', 'Support request not found');
        }

        $supportRequest->update($validatedData);

        return redirect()->route('support_data_list')->with('success', 'Support request updated successfully');
    }

}
