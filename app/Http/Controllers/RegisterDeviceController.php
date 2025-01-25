<?php

namespace App\Http\Controllers;

use DB;
use Log;
use App\Models\Content;
use App\Models\Template;
use App\Models\TemplateList;
use Illuminate\Http\Request;
use App\Models\RegisterDevice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\RegisterDeviceService;

class RegisterDeviceController extends Controller
{
    protected $registerDeviceService;
    public function __construct(RegisterDeviceService $registerDeviceService)
    {
        $this->registerDeviceService = $registerDeviceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function device()
    {
        // return view('registerDevice.manage');
        return $this->registerDeviceService->getDeviceList();
    }

    // public function deviceList()
    // {
    //     return $this->registerDeviceService->getDeviceList();
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get the authenticated user's subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve templates associated with the subscriber
        $templates = Template::where('subscriber_id', $subscriberId)->get();

        // Retrieve audio lists associated with the subscriber
        $audioLists = Content::where([['subscriber_id', $subscriberId], ['content_type', 'Audio']])
            ->get();

        // Return the view with the filtered templates and audio lists
        return view('registerDevice.create', compact('templates', 'audioLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->registerDeviceService->getStore($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return $this->registerDeviceService->getEdit($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->registerDeviceService->getUpdate($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->registerDeviceService->getDelete($id);
    }
    
    public function template_assign($id)
    {
        return $this->registerDeviceService->template_assign($id);
    }
    public function template_assign_store(Request $request, $id)
    {
        return $this->registerDeviceService->template_assign_store($request,$id);

    }
}
