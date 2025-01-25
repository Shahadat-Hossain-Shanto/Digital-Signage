<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterDevice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use File;
use Image;
use Illuminate\Support\Facades\DB;
use Log;

class DashboardController extends Controller
{
    public function index()
    {
            // Get the authenticated user's subscriber ID
        $subscriberId = Auth::user()->subscriber_id;
        $registerDevices = DB::table('register_devices')
            ->select('id', 'device_id', 'imei', 'device_type',
                'size', 'model', 'brand', 'description',
                'status', 'user_by', 'setup_location')
                ->where('subscriber_id', $subscriberId) // Filter by subscriber_id
                ->get();
            // dd($registerDevices);
        return view('dashboard.index', compact('registerDevices'));
        // return view('dashboard.index');
    }
}
