<?php

namespace App\Http\Services;

use DB;
use Log;
use stdClass;
use App\Models\Content;
use App\Models\PlayList;
use App\Models\Template;
use PhpParser\JsonDecoder;
use App\Models\TemplateList;
use Illuminate\Http\Request;
use App\Models\RegisterDevice;
use App\Models\TemplateContent;
use App\Models\PlayListContents;
use App\Models\TemplatePlayList;

class deviceInfoApiService
{
    public function getCheckDevice($id)
    {
        $search_device_info = RegisterDevice::where('device_id', $id)->first();
        if (!$search_device_info) {
            return response()->json(['status_code' =>  400, 'unsuccessful' => 'Device not found'], 404);
        }


        $search_template = Template::where('id', $search_device_info->content_id)->first();
        $template_details = new stdClass();
        if ($search_device_info->content_type == 'templates' && $search_template) {
            $template_details->template_name            = $search_template->template_name;
            $template_details->template_type            = $search_template->template_type;
            $template_details->template_layout          = $search_template->template_layout;
            $template_details->mute                     = $search_template->mute;
            $template_details->background_audio         = $search_template->background_audio;
            $template_details->main_zone                = $search_template->main_zone;
            $template_details->background               = $search_template->background;
            $template_details->header                   = $search_template->header;
            $template_details->header_right             = $search_template->header_right;
            $template_details->vertically_right         = $search_template->vertically_right;
            $template_details->vertically_left          = $search_template->vertically_left;
            $template_details->lower_panel              = $search_template->lower_panel;
            $template_details->upper_panel              = $search_template->upper_panel;
            $template_details->footer                   = $search_template->footer;
            $template_details->footer_right             = $search_template->footer_right;
            $template_details->triple_horizontal_left   = $search_template->triple_horizontal_left;
            $template_details->triple_horizontal_right  = $search_template->triple_horizontal_right;
            $template_details->triple_horizontal_top    = $search_template->triple_horizontal_top;
            $template_details->triple_horizontal_middle = $search_template->triple_horizontal_middle;
            $template_details->triple_horizontal_bottom = $search_template->triple_horizontal_bottom;
            $template_details->triple_vertically_left   = $search_template->triple_vertically_left;
            $template_details->triple_vertically_middle = $search_template->triple_vertically_middle;
            $template_details->triple_vertically_right  = $search_template->triple_vertically_right;
            $template_details->top_left                 = $search_template->top_left;
            $template_details->top_right                = $search_template->top_right;
            $template_details->bottom_left              = $search_template->bottom_left;
            $template_details->bottom_right             = $search_template->bottom_right;
        }

        $allContents = [];
        if ($search_device_info->content_type == 'templates' && $search_template) {
            $unique_content_places = TemplateContent::where('template_id', $search_template->id)->pluck('content_place')->unique();
            foreach ($unique_content_places as $unique_content_place) {
                // $data  = new stdClass();
                $template_contents = TemplateContent::where([['template_id', $search_template->id], ['content_place', $unique_content_place]])->orderBy('order_index', 'ASC')->get();
                $data = [];
                foreach ($template_contents as $template_content) {
                    if ($template_content->content_type == 'Playlist') {
                        $contents = PlayListContents::where([['playlist_id', $template_content->content_id], ['subscriber_id', $template_content->subscriber_id]])->orderBy('order_index', 'ASC')->get();
                        foreach ($contents as $content) {
                            $playList_details = new stdClass();
                            $playList_details->name         = $content->content;
                            $playList_details->type         = $content->content_type;
                            $playList_details->duration     = $content->duration;

                            if ($search_template->mute == 'false') {
                                $mute = $content->mute;
                            } else {
                                $mute = $search_template->mute;
                            }

                            $playList_details->mute         = $mute;
                            $data[]  = $playList_details;
                        }
                    }
                    if ($template_content->content_type == 'App') {
                        $contents = Content::where([['id', $template_content->content_id], ['subscriber_id', $template_content->subscriber_id]])
                            ->orWhere([['id', $template_content->content_id], ['subscriber_id', 0]])->first();
                        $banner_details = new stdClass();
                        $banner_details->name         = $contents->content;
                        $banner_details->type         = 'App';
                        $banner_details->duration     = $template_content->duration;

                        if ($search_template->mute == 'false') {
                            $mute = $template_content->mute;
                        } else {
                            $mute = $search_template->mute;
                        }

                        $banner_details->mute         = $mute;
                        $data[]  = $banner_details;
                    } else {
                        $details = new stdClass();
                        $details->name      = $template_content->content_name;
                        $details->type      = $template_content->content_type;
                        $details->duration  = $template_content->duration;

                        if ($search_template->mute == 'false') {
                            $mute = 'false';
                            if ($template_content->audio == 'Mute') {
                                $mute = 'true';
                            }
                        } else {
                            $mute = $search_template->mute;
                        }

                        $details->mute      = $mute;
                        $data[] = $details;
                    }
                }
                $allContents[$unique_content_place] = $data;
            }
        } else if ($search_device_info->content_type == 'play_lists' && !$search_template) {
            $playlist = PlayList::find($search_device_info->content_id);
            $contents = PlayListContents::where([['playlist_id', $playlist->id], ['subscriber_id', $playlist->subscriber_id]])->orderBy('order_index', 'ASC')->get();
            $data = [];
            foreach ($contents as $content) {
                $playList_details = new stdClass();
                $playList_details->name         = $content->content;
                $playList_details->type         = $content->content_type;
                $playList_details->duration     = $content->duration;
                $playList_details->mute         = $content->mute;
                $data[]  = $playList_details;
            }
            $allContents['main_zone'] = $data;
        } else if ($search_device_info->content_type == 'contents' && !$search_template) {
            $content = Content::find($search_device_info->content_id);
            $details = new stdClass();
            $details->name      = $content->content;
            $details->type      = $content->content_type;
            $details->duration  = '600';
            $details->mute      = 'false';
            $allContents['main_zone'] = [$details];
        } else if ($search_device_info->content_type == 'App' && $search_device_info->content_name == 'Banner') {
            $content = Content::find($search_device_info->content_id);
            $details = new stdClass();
            $details->name      = $content->content;
            $details->type      = $content->content_type;
            $details->duration  = $search_device_info->duration;
            $details->mute      = 'false';
            $allContents['main_zone'] = [$details];
        }

        $data = new stdClass();
        // $data->device_details   = $device_details;
        $data->template_details = $template_details;
        $data->contents = $allContents;
        return response()->json([
            'status_code' => 200,
            'data' => $data
        ]);
    }

    public function getCheckplaylist($id)
    {

        $playlists = PlayList::where('playlist_name', $id)->orderBy('order_index', 'asc')
            ->get();
        // Return playlists as JSON response
        return response()->json([
            'status_code' => 200,
            'data' => $playlists
        ]);
    }

    public function getSendToken($request)
    {
        $find_device = RegisterDevice::where('device_id', $request->device_id)->first();

        if (!$find_device) {
            // Device not found, return error response
            return response()->json(['status_code' =>  400, 'unsuccessful' => 'Device not found']);
        } else {
            # code...
            $find_device->firebase_token = $request->firebase_token;
            $find_device->save();

            return response()->json([
                'status_code' => 200,
                'message' => 'Firebase token send successfully!'
            ]);
        }
    }
}
