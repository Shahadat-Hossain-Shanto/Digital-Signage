<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegisterDevice;
use App\Models\TemplateList;
use App\Models\PlayList;
use Illuminate\Http\Request;
use App\Http\Services\DeviceInfoApiService;
use DB;
use Log;

class DeviceInfoApiController extends Controller
{
    protected $deviceInfoApiService;
    public function __construct(DeviceInfoApiService $deviceInfoApiService) {
        $this->deviceInfoApiService = $deviceInfoApiService;
    }

    public function check_device(String $id)
    {
        return $this->deviceInfoApiService->getCheckDevice($id);
    }
    public function check_playlist(String $id)
    {
        return $this->deviceInfoApiService->getCheckplaylist($id);
    }

    public function send_token(Request $request)
    {
        return $this->deviceInfoApiService->getSendToken($request);
    }
}
