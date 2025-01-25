<?php

namespace App\Http\Services;

use Log;
use File;
use Image;
use stdClass;
use App\Models\Content;
use App\Models\PlayList;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Models\RegisterDevice;
use App\Models\TemplateContent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class registerDeviceService
{

    public function getDeviceList()
    {
        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve registered devices for the authenticated subscriber
        $registerDevices = DB::table('register_devices')
            ->select(
                'id',
                'device_id',
                'imei',
                'device_type',
                'size',
                'model',
                'brand',
                'description',
                'user_by',
                'setup_location',
                'os',

            )
            ->where('subscriber_id', $subscriberId)
            ->get();

        return view('registerDevice.manage', compact('registerDevices'));
    }


    public function getStore(Request $request)
    {
        // Define custom error messages for validation
        $message = [
            // 'device_id.required'        => 'Device ID is required',
            // 'device_id.unique'          => 'Device ID must be unique',
            // 'imei.required'             => 'IMEI is required',
            // 'imei.unique'               => 'IMEI must be unique',
            // 'model.required'            => 'Model is required',
            'device_type.required'      => 'Device Type is required',
            // 'size.required'             => 'Device Size is required',
            // 'brand.required'            => 'Brand is required',
            // 'description.required'      => 'Description is required',
            // 'user_by.required'          => 'User is required',
            'setup_location.required'   => 'Location is required',
            // 'template.required'         => 'Template Type is required',
            // 'group_name.required'       => 'Group Name is required',
            'status.required'           => 'Device Status is required',
        ];

        $validator = Validator::make($request->all(), [
            // 'device_id'=> 'required|unique:register_devices',
            // 'imei'=> 'required|unique:register_devices',
            'device_type' => 'required',
            // 'size' => 'required',
            // 'model' => 'required',
            // 'brand' => 'required',
            'description' => 'required',
            // 'user_by' => 'required',
            'setup_location' => 'required',
            // 'template' => 'required',
            // 'group_name' => 'required',
            'status' => 'required',
        ], $message);

        // If validation fails, return error messages
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            // Create a new RegisterDevice instance
            $registerDevice = new RegisterDevice;
            $subscriberId = Auth::user()->subscriber_id;

            // Add a leading zero if subscriber_id is a single digit
            if (strlen($subscriberId) === 1) {
                $subscriberId = '0' . $subscriberId;
            }

            // Generate a 4-digit random number
            $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

            // Combine subscriber_id and the random number
            $deviceId = $subscriberId . $randomNumber;
            $registerDevice->subscriber_id = Auth::user()->subscriber_id; // Associate with subscriber
            $registerDevice->device_id = $deviceId;
            $registerDevice->imei           = $request->imei;
            $registerDevice->model          = $request->model;
            $registerDevice->device_type    = $request->device_type;
            $registerDevice->size           = $request->size;
            $registerDevice->brand          = $request->brand;
            $registerDevice->description    = $request->description;
            $registerDevice->user_by        = $request->user_by;
            $registerDevice->setup_location  = $request->setup_location;
            $registerDevice->status         = $request->status;
            $registerDevice->os         = $request->os;

            // Save the registerDevice instance
            $registerDevice->save();

            return response()->json([
                'status' => 200,
                'message' => "Added Successfully",
                'device' => $registerDevice
            ]);
        }
    }


    public function getEdit($request)
    {
        $id = $request['id'];
        $subscriberId = Auth::user()->subscriber_id;

        // Fetch the device with the subscriber's templates
        $registerDevice = DB::table('register_devices')
            // ->join('template_lists', 'register_devices.template_id', '=', 'template_lists.id')
            ->select(
                'register_devices.id',
                'register_devices.device_id',
                'register_devices.device_type',
                'register_devices.size',
                'register_devices.imei',
                'register_devices.model',
                'register_devices.brand',
                'register_devices.regulation',
                'register_devices.description',
                'register_devices.setup_location',
                'register_devices.group_name',
                'register_devices.user_by',
                'register_devices.organized_by',
                'register_devices.content_id',
                'register_devices.content_type',
                'register_devices.status',
                'register_devices.os',
                'register_devices.subscriber_id'
            )
            ->where('register_devices.id', $id)
            ->where('register_devices.subscriber_id', $subscriberId)
            ->first();

        if (!$registerDevice) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        // Get templates for the same subscriber
        // $templates = DB::table('template_lists')
        //     ->where('subscriber_id', $subscriberId)
        //     ->select('id', 'template_name')
        //     ->get();

        return response()->json([
            'device' => $registerDevice,
            // 'templates' => $templates,
        ]);
    }

    public function getUpdate($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'device_id'        => 'required|unique:register_devices,device_id,' . $request->register_id,
                'imei'             => 'required|unique:register_devices,device_id,' . $request->register_id,
                'device_type'      => 'required',
                'subscriber_id_imei_unique' => [
                    Rule::unique('register_devices')->where(function ($query) use ($request) {
                        return $query->where('imei', $request->imei)
                            ->where('subscriber_id', Auth::user()->subscriber_id);
                    })->ignore($request->register_id), // Ignore the current record by its ID
                ],
                // 'model'            => 'required',
                // 'size'             => 'required',
                // 'brand'            => 'required',
                // 'description'      => 'required',
                // 'user_by'          => 'required',
                // 'setup_location'   => 'required',
                // 'template'         => 'required',
                // 'group_name'       => 'required',
                'status'           => 'required',
            ],
            [
                'device_id.required'        => 'Device ID is required',
                'device_id.unique'          => 'Device ID must be unique',
                'subscriber_id_imei_unique' => 'The combination of Subscriber ID and IMEI must be unique.',
                'device_type.required'      => 'Device Type is required',
                // 'imei.required'             => 'IMEI is required',
                // 'imei.unique'               => 'IMEI must be unique',
                // 'model.required'            => 'Model is required',
                // 'size.required'             => 'Device Size is required',
                // 'brand.required'            => 'Brand is required',
                // 'description.required'      => 'Description is required',
                // 'used_by.required'          => 'User is required',
                // 'setup_location.required'   => 'Location is required',
                'status.required'           => 'Device Status is required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $registerDevice = RegisterDevice::find($request->register_id);


            if (!is_null($registerDevice)) {

                // $registerDevice->device_id      = $request->device_id;
                $registerDevice->imei           = $request->imei;
                $registerDevice->device_type    = $request->device_type;
                $registerDevice->size           = $request->size;
                $registerDevice->model          = $request->model;
                $registerDevice->brand          = $request->brand;
                $registerDevice->description    = $request->description;
                $registerDevice->user_by        = $request->user_by;
                $registerDevice->setup_location = $request->setup_location;
                $registerDevice->os             = $request->os;
                $registerDevice->status         = $request->status;


                $registerDevice->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Updated Successfully"
                ]);
            }
        }
    }

    public function getDelete($id)
    {
        RegisterDevice::destroy($id);
        return redirect()->back()->with('message', 'Deleted Successfully');
    }
    public function template_assign($id)
    {
        $device = RegisterDevice::find($id);

        $tableName = $device->content_type; // Table name from content_type
        $contentId = $device->content_id;  // Content ID to search for

        if ($tableName)
            $content = DB::table($tableName)->find($contentId);
        else
            $content =  new stdClass();

        $subscriberId = Auth::user()->subscriber_id;
        $templateContents = []; // Initialize an empty array

        $templateLists = Template::where('subscriber_id', $subscriberId)->get();
        $imageLists = Content::where('content_type', 'Image')
            ->where('subscriber_id', $subscriberId)
            ->get();
        $audioLists = Content::where('content_type', 'Audio')
            ->where('subscriber_id', $subscriberId)
            ->get();


        $videoLists = Content::where('content_type', 'Video')
            ->where('subscriber_id', $subscriberId)
            ->get();

        $linkLists = Content::where('content_type', 'Link')
            ->where('subscriber_id', $subscriberId)
            ->get();

        $contents = Content::where('content_type', 'App')
            ->where('subscriber_id', $subscriberId)
            ->get();

        // Separate banners and apps based on URL containing a "?"
        $banners = $contents->filter(function ($content) {
            return str_contains($content->content, 'banner');
        });

        $apps = $contents->reject(function ($content) {
            return str_contains($content->content, 'banner'); // Reject banners to get the remaining apps
        });
        $playlists = PlayList::select(
            'play_lists.playlist_name',
            'play_lists.id',
            DB::raw('GROUP_CONCAT(play_list_contents.content SEPARATOR ",") as contents'),
            DB::raw('GROUP_CONCAT(play_list_contents.content_type SEPARATOR ",") as content_types'),
            DB::raw('SUM(CAST(play_list_contents.duration AS UNSIGNED)) as total_duration'),
            DB::raw('MAX(play_lists.mute) as mute')
        )
            ->join('play_list_contents', 'play_lists.id', '=', 'play_list_contents.playlist_id')
            ->where('play_lists.subscriber_id', $subscriberId)
            ->groupBy('play_lists.playlist_name', 'play_lists.id',)
            ->get();

        foreach ($templateLists as $templateList) {
            $templateContent = TemplateContent::select('content_name', 'content_type')
                ->where('template_id', $templateList->id)
                ->where('content_place', 'main_zone')
                ->where('content_type', '!=', 'Audio')
                ->first();

            // Check if template content exists
            if ($templateContent) {
                if ($templateContent->content_type == 'Playlist') {
                    // Retrieve playlist details
                    $playlist = PlayList::where('playlist_name', $templateContent->content_name)->first();

                    // Check if playlist data exists and add to array
                    if ($playlist) {
                        $templateContents[] = [
                            'template_name' => $templateList->template_name,
                            'id' => $templateList->id,
                            'content' => $playlist  // Include the playlist data
                        ];
                    }
                } else {
                    // For other content types (Image, Video, etc.)
                    $templateContents[] = [
                        'template_name' => $templateList->template_name,
                        'id' => $templateList->id,
                        'content' => $templateContent  // Include the regular content
                    ];
                }
            }
        }
        return view('registerDevice.template-assign', compact('id', 'device', 'playlists', 'imageLists', 'audioLists', 'videoLists', 'linkLists', 'templateContents', 'content', 'banners', 'apps'));
    }
    public function template_assign_store(Request $request, $id)
    {

        $search_device_info = RegisterDevice::find($id);
        $search_device_info->content_id = $request->id;
        $search_device_info->content_type = $request->content_type;
        $search_device_info->save();
        // return redirect()->back()->with('message', 'Updated Successfully');

        $tableName = $search_device_info->content_type; // Table name from content_type
        $contentId = $search_device_info->content_id;  // Content ID to search for

        // Query the corresponding table dynamically
        $content = DB::table($tableName)->find($contentId);
        return response()->json([
            'status' => 200,
            'message' => "Updated Successfully",
            'device' => $search_device_info,
            'content' => $content,

        ]);
    }
}
