<?php

namespace App\Http\Services;

use Google_Client;
use App\Models\Content;
use App\Models\PlayList;
use App\Models\Template;
use Illuminate\Support\Str;
use App\Models\TemplateList;
use Illuminate\Http\Request;
use App\Models\RegisterDevice;
use App\Models\TemplateContent;
use App\Models\PlayListContents;
use App\Models\TemplatePlayList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class templateService
{

    public function list()
    {
        $subscriberId = Auth::user()->subscriber_id;

        // Fetch templates for the subscriber
        $templateLists = Template::where('subscriber_id', $subscriberId)->get();

        // Initialize an array to store template contents
        $templateContents = $templateLists->map(function ($templateList) {
            // Fetch the main zone content
            $templateContent = TemplateContent::select('content_name', 'content_type', 'content_id')
                ->where('template_id', $templateList->id)
                ->whereIn('content_place', ['main_zone', 'custom_main']) // Check for either value
                ->where('content_type', '!=', 'Audio')
                ->first();


            if ($templateContent) {
                if ($templateContent->content_type === 'Playlist') {
                    // Retrieve playlist details
                    $playlist = PlayListContents::where('playlist_id', $templateContent->content_id)->first();

                    // Return playlist data if it exists
                    if ($playlist) {
                        return [
                            'template_name' => $templateList->template_name,
                            'id' => $templateList->id,
                            'template_type' => $templateList->template_type,
                            'template_layout' => $templateList->template_layout,
                            'content' => $playlist, // Playlist data
                        ];
                    }
                } else {
                    // Return regular content data
                    return [
                        'template_name' => $templateList->template_name,
                        'id' => $templateList->id,
                        'template_type' => $templateList->template_type,
                        'template_layout' => $templateList->template_layout,
                        'content' => $templateContent, // Regular content
                    ];
                }
            }

            // Add dummy content if no valid TemplateContent exists
            return [
                'template_name' => $templateList->template_name,
                'id' => $templateList->id,
                'template_type' => $templateList->template_type,
                'template_layout' => $templateList->template_layout,
                'content' => [
                    'content_name' => 'Dummy Content',
                    'content_type' => 'Dummy',
                ],
            ];
        });

        // Convert the result to an array if needed
        $templateContents = $templateContents->toArray();

        // Log the contents for debugging

        return view('template.list', compact('templateContents'));
    }


    public function create($request)
    {

        $message = [
            'template_name.required'    => 'Template Name is required',
            'template_type.required'    => 'Full Screen is required',
            'template_layout.required'  => 'Screen Height is required',
        ];
        $validator = Validator::make($request->all(), [
            'template_name'     => 'required',
            'template_type'     => 'required',
            'template_layout'   => 'required',
        ], $message);

        // Handle validation failure
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        $subscriberId = Auth::user()->subscriber_id;

        if (Template::where('template_name', $request->template_name)
            ->where('subscriber_id', $subscriberId)
            ->exists()
        ) {
            return response()->json([
                'status' => 401,
                'message' => 'Template Name already exists'
            ]);
        } else {
            // Create the new template with subscriber_id
            $template = new Template;
            $template->subscriber_id        = $subscriberId;
            $template->template_name        = $request->template_name;
            $template->template_type        = $request->template_type;
            $template->template_layout      = $request->template_layout;
            $template->save();

            return response()->json([
                'status' => 200,
                'id' => $template->id
            ]);
        }
    }

    public function edit($id)
    {
        $subscriberId = Auth::user()->subscriber_id;
        $template = Template::find($id);

        $audioLists = Content::where('content_type', 'Audio')
            ->where('subscriber_id', $subscriberId)
            ->get();
        $imageLists = Content::where('content_type', 'Image')
            ->where('subscriber_id', $subscriberId)
            ->get();

        $videoLists = Content::where('content_type', 'Video')
            ->where('subscriber_id', $subscriberId)
            ->get();

        $linkLists = Content::where('content_type', 'Link')
            ->where('subscriber_id', $subscriberId)
            ->get();

        $playlists = PlayList::select(
            'playlist_name',
            DB::raw('GROUP_CONCAT(content SEPARATOR ",") as contents'),
            DB::raw('GROUP_CONCAT(content_type SEPARATOR ",") as content_types'),
            DB::raw('SUM(CAST(duration AS UNSIGNED)) as total_duration'),
            DB::raw('MAX(mute) as mute')
        )
            ->where('subscriber_id', $subscriberId)
            ->groupBy('playlist_name')
            ->get();

        return view('template.edit', compact('template', 'playlists', 'imageLists', 'audioLists', 'videoLists', 'linkLists'));
    }
    public function index($id)
    {
        $subscriberId = Auth::user()->subscriber_id;
        $template = Template::find($id);

        $audioLists = Content::where('content_type', 'Audio')
            ->where('subscriber_id', $subscriberId)
            ->get();
        $imageLists = Content::where('content_type', 'Image')
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
            ->orWhere('subscriber_id', 0)
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

        $edit_template = Template::find($id);

        $edit_mains = TemplateContent::where('template_id', $id)
            ->where('content_place', 'main_zone')
            ->get()
            ->map(function ($content) {
                if ($content->content_type == 'Playlist') {
                    // Query the Playlist model only if the content type is 'Playlist'
                    $content->playlists = PlayListContents::where('playlist_id', $content->content_id)
                        ->get(['content', 'content_type']);
                }
                return $content; // Return the content as is if not 'Playlist'
            });

        $edit_backgrounds = TemplateContent::where('template_id', $id)
            ->where('content_place', 'background')
            ->get()
            ->map(function ($content) {
                if ($content->content_type == 'Playlist') {
                    $content->playlists = PlayListContents::where('playlist_id', $content->content_id)
                        ->get(['content', 'content_type']);
                }
                return $content;
            });

        $edit_background_audios = TemplateContent::where('template_id', $id)
            ->where('content_place', 'background_audio')
            ->get()
            ->map(function ($content) {
                if ($content->content_type == 'Playlist') {
                    $content->playlists = PlayListContents::where('playlist_id', $content->content_id)
                        ->get(['content', 'content_type']);
                }
                return $content;
            });
        $edit_custom_mains = TemplateContent::where('template_id', $id)
            ->where('content_place', 'custom_main')
            ->get()
            ->map(function ($content) {
                if ($content->content_type == 'Playlist') {
                    $content->playlists = PlayListContents::where('playlist_id', $content->content_id)
                        ->get(['content', 'content_type']);
                }
                return $content;
            });
        $edit_custom_clocks = TemplateContent::where('template_id', $id)
            ->where('content_place', 'custom_clock')
            ->get()
            ->map(function ($content) {
                if ($content->content_type == 'Playlist') {
                    $content->playlists = PlayListContents::where('playlist_id', $content->content_id)
                        ->get(['content', 'content_type']);
                }
                return $content;
            });
        $edit_custom_banners = TemplateContent::where('template_id', $id)
            ->where('content_place', 'custom_banner')
            ->get()
            ->map(function ($content) {
                if ($content->content_type == 'Playlist') {
                    $content->playlists = PlayListContents::where('playlist_id', $content->content_id)
                        ->get(['content', 'content_type']);
                }
                return $content;
            });
        $edit_custom_weathers = TemplateContent::where('template_id', $id)
            ->where('content_place', 'custom_weather')
            ->get()
            ->map(function ($content) {
                if ($content->content_type == 'Playlist') {
                    $content->playlists = PlayListContents::where('playlist_id', $content->content_id)
                        ->get(['content', 'content_type']);
                }
                return $content;
            });




        return view('template.index', compact('template', 'playlists', 'imageLists', 'audioLists', 'videoLists', 'linkLists', 'edit_mains', 'edit_background_audios', 'edit_backgrounds', 'edit_custom_banners', 'edit_custom_weathers', 'edit_custom_clocks', 'edit_custom_mains', 'banners', 'apps'));
    }

    public function update($request)
    {
        $message = [
            'template_id.required'      => 'Template ID is required',
            'template_name.required'    => 'Template name is required',
            'template_type.required'    => 'Template Type is required',
            'template_layout.required'  => 'Template Layout is required',
            'mute.required'             => 'Audio Mute Value is required',
        ];
        $validator = Validator::make($request->all(), [
            'template_id'       => 'required',
            'template_name'     => 'required',
            'template_type'     => 'required',
            'template_layout'   => 'required',
            'mute'              => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $template = Template::find($request->template_id);

            if ($request->background_audio_contents) {

                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'background_audio']);
                $background_audio_order = 0;

                foreach ($request->background_audio_contents as $background_audio_contents) {

                    $background_audio_content = new TemplateContent;
                    $background_audio_content->template_id      = $template->id;
                    $background_audio_content->content_place    = 'background_audio';
                    $background_audio_content->order_index      = ++$background_audio_order;
                    $background_audio_content->content_name     = $background_audio_contents['content_name'];
                    $background_audio_content->content_type     = $background_audio_contents['content_type'];
                    $background_audio_content->content_id     = $background_audio_contents['id'];

                    if (strpos($background_audio_contents['duration'], ':')) {
                        list($hours, $minutes, $seconds) = explode(':', $background_audio_contents['duration']);
                        $seconds =  ($hours * 3600) + ($minutes * 60) + $seconds;
                    } else {
                        $seconds = $background_audio_contents['duration'];
                    }

                    $background_audio_content->duration         = $seconds;
                    $background_audio_content->audio            = $background_audio_contents['audio'];
                    $background_audio_content->subscriber_id    = $template->subscriber_id;

                    $background_audio_content->save();
                }
            } else {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'background_audio']);
            }

            if ($request->main_zone_contents) {


                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'main_zone']);
                $main_zone_order = 0;
                foreach ($request->main_zone_contents as $main_zone_contents) {
                    $main_zone_content = new TemplateContent;
                    $main_zone_content->template_id      = $template->id;
                    $main_zone_content->content_place    = 'main_zone';
                    $main_zone_content->order_index      = ++$main_zone_order;

                    $main_zone_content->content_name     = $main_zone_contents['content_name'];
                    $main_zone_content->content_type     = $main_zone_contents['content_type'];
                    $main_zone_content->content_id     = $main_zone_contents['id'];

                    if (strpos($main_zone_contents['duration'], ':')) {
                        list($hours, $minutes, $seconds) = explode(':', $main_zone_contents['duration']);
                        $seconds =  ($hours * 3600) + ($minutes * 60) + $seconds;
                    } else {
                        $seconds = $main_zone_contents['duration'];
                    }

                    $main_zone_content->duration         = $seconds;
                    $main_zone_content->audio            = $main_zone_contents['audio'];
                    $main_zone_content->subscriber_id    = $template->subscriber_id;

                    $main_zone_content->save();
                }
            } else {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'main_zone']);
            }

            if ($request->background_contents) {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'background']);
                $background_order = 0;
                foreach ($request->background_contents as $background_contents) {
                    $background_content = new TemplateContent;
                    $background_content->template_id      = $template->id;
                    $background_content->content_place    = 'background';
                    $background_content->order_index      = ++$background_order;
                    $background_content->content_name     = $background_contents['content_name'];
                    $background_content->content_type     = $background_contents['content_type'];
                    $background_content->content_id     = $background_contents['id'];

                    if (strpos($background_contents['duration'], ':')) {
                        list($hours, $minutes, $seconds) = explode(':', $background_contents['duration']);
                        $seconds =  ($hours * 3600) + ($minutes * 60) + $seconds;
                    } else {
                        $seconds = $background_contents['duration'];
                    }

                    $background_content->duration         = $seconds;
                    $background_content->audio            = $background_contents['audio'];
                    $background_content->subscriber_id    = $template->subscriber_id;

                    $background_content->save();
                }
            } else {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'background']);
            }

            if ($request->custom_main) {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_main']);
                $order = 0;
                foreach ($request->custom_main as $custom_mains) {
                    $custom_main = new TemplateContent;
                    $custom_main->template_id      = $template->id;
                    $custom_main->content_place    = 'custom_main';
                    $custom_main->order_index      = ++$order;

                    $custom_main->content_name     = $custom_mains['content_name'];
                    $custom_main->content_type     = $custom_mains['content_type'];
                    $custom_main->content_id     = $custom_mains['id'];

                    if (strpos($custom_mains['duration'], ':')) {
                        list($hours, $minutes, $seconds) = explode(':', $custom_mains['duration']);
                        $seconds =  ($hours * 3600) + ($minutes * 60) + $seconds;
                    } else {
                        $seconds = $custom_mains['duration'];
                    }

                    $custom_main->duration         = $seconds;
                    $custom_main->audio            = $custom_mains['audio'];
                    $custom_main->subscriber_id    = $template->subscriber_id;

                    $custom_main->save();
                }
            } else {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_main']);
            }
            if ($request->custom_clock) {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_clock']);
                $order = 0;
                foreach ($request->custom_clock as $custom_clocks) {
                    $custom_clock = new TemplateContent;
                    $custom_clock->template_id      = $template->id;
                    $custom_clock->content_place    = 'custom_clock';
                    $custom_clock->order_index      = ++$order;

                    $custom_clock->content_name     = $custom_clocks['content_name'];
                    $custom_clock->content_type     = $custom_clocks['content_type'];
                    $custom_clock->content_id     = $custom_clocks['id'];

                    if (strpos($custom_clocks['duration'], ':')) {
                        list($hours, $minutes, $seconds) = explode(':', $custom_clocks['duration']);
                        $seconds =  ($hours * 3600) + ($minutes * 60) + $seconds;
                    } else {
                        $seconds = $custom_clocks['duration'];
                    }

                    $custom_clock->duration         = $seconds;
                    $custom_clock->audio            = $custom_clocks['audio'];
                    $custom_clock->subscriber_id    = $template->subscriber_id;

                    $custom_clock->save();
                }
            } else {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_clock']);
            }
            if ($request->custom_banner) {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_banner']);
                $order = 0;
                foreach ($request->custom_banner as $custom_banners) {
                    $custom_banner = new TemplateContent;
                    $custom_banner->template_id      = $template->id;
                    $custom_banner->content_place    = 'custom_banner';
                    $custom_banner->order_index      = ++$order;

                    $custom_banner->content_name     = $custom_banners['content_name'];
                    $custom_banner->content_type     = $custom_banners['content_type'];
                    $custom_banner->content_id     = $custom_banners['id'];

                    if (strpos($custom_banners['duration'], ':')) {
                        list($hours, $minutes, $seconds) = explode(':', $custom_banners['duration']);
                        $seconds =  ($hours * 3600) + ($minutes * 60) + $seconds;
                    } else {
                        $seconds = $custom_banners['duration'];
                    }

                    $custom_banner->duration         = $seconds;
                    $custom_banner->audio            = $custom_banners['audio'];
                    $custom_banner->subscriber_id    = $template->subscriber_id;

                    $custom_banner->save();
                }
            } else {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_banner']);
            }
            if ($request->custom_weather) {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_weather']);
                $order = 0;
                foreach ($request->custom_weather as $custom_weathers) {
                    $custom_weather = new TemplateContent;
                    $custom_weather->template_id      = $template->id;
                    $custom_weather->content_place    = 'custom_weather';
                    $custom_weather->order_index      = ++$order;

                    $custom_weather->content_name     = $custom_weathers['content_name'];
                    $custom_weather->content_type     = $custom_weathers['content_type'];
                    $custom_weather->content_id     = $custom_weathers['id'];

                    if (strpos($custom_weathers['duration'], ':')) {
                        list($hours, $minutes, $seconds) = explode(':', $custom_weathers['duration']);
                        $seconds =  ($hours * 3600) + ($minutes * 60) + $seconds;
                    } else {
                        $seconds = $custom_weathers['duration'];
                    }

                    $custom_weather->duration         = $seconds;
                    $custom_weather->audio            = $custom_weathers['audio'];
                    $custom_weather->subscriber_id    = $template->subscriber_id;

                    $custom_weather->save();
                }
            } else {
                DB::delete("DELETE FROM template_contents WHERE  template_id = ? AND content_place = ? ", [$template->id, 'custom_weather']);
            }


            $template->template_name        = $request->template_name;
            $template->template_type        = $request->template_type;
            $template->template_layout      = $request->template_layout;
            $mute = 'false';
            if ($request->mute) {
                $mute = 'true';
            }
            $template->mute                 = $mute;

            $template->header                   = 0;
            $template->header_right             = 0;
            $template->vertically_right         = 0;
            $template->vertically_left          = 0;
            $template->lower_panel              = 0;
            $template->upper_panel              = 0;
            $template->footer                   = 0;
            $template->footer_right             = 0;
            $template->triple_horizontal_left   = 0;
            $template->triple_horizontal_right  = 0;
            $template->triple_horizontal_top    = 0;
            $template->triple_horizontal_middle = 0;
            $template->triple_horizontal_bottom = 0;
            $template->triple_vertically_left   = 0;
            $template->triple_vertically_middle = 0;
            $template->triple_vertically_right  = 0;
            $template->top_left                 = 0;
            $template->top_right                = 0;
            $template->bottom_left              = 0;
            $template->bottom_right             = 0;
            $template->background               = 0;

            if ($request->template_layout == 'Full Screen') {
                $template->background_audio         = 1;
                $template->main_zone                = 1;
                $template->background               = 0;
            } else if ($request->template_layout == 'Full Screen with Background') {
                $template->background_audio         = 1;
                $template->main_zone                = 1;
                $template->background               = 1;
            } else if ($request->template_layout == '4 Zones Layout') {
                $template->background_audio         = 1;
                $template->main_zone                = 1;
                $template->vertically_right         = 1;
                $template->footer                   = 1;
                $template->footer_right             = 1;
            }


            $template->save();

            return response()->json([
                'status' => 200,
                'message' => 'Template Updated Successfully!'
            ]);
        }
    }

    public function fullScreenTemplate()
    {

        $subscriberId = Auth::user()->subscriber_id;


        $templateLists = TemplateList::where('full_screen', 'true')
            ->where('subscriber_id', $subscriberId)
            ->get();
        return view('template.type.fullscreen.list', compact('templateLists'));
    }


    public function fullScreenTemplateEdit($id)
    {
        $subscriberId = Auth::user()->subscriber_id;

        $templateList = TemplateList::find($id);
        $ImagePlaylists = PlayList::select('playlist_name')
            ->where('subscriber_id', $subscriberId)
            ->where('image_file_name', '<>', null)
            ->groupBy('playlist_name')
            ->get();

        $VideoPlaylists = PlayList::select('playlist_name',)
            ->where('subscriber_id', $subscriberId)
            ->where('video_file_name', '<>', null)
            ->groupBy('playlist_name')
            ->get();
        $playlists = TemplatePlayList::where('template_id', $id)->get();
        return view('template.type.fullscreen.edit', compact('templateList', 'ImagePlaylists', 'VideoPlaylists', 'playlists', 'id'));
    }

    public function getDataList($param1, $param2, $param3, $param4)
    {
        // Retrieve the subscriber ID of the authenticated user
        $subscriberId = Auth::user()->subscriber_id;

        // Fetch template lists associated with the subscriber and matching the given parameters
        $templateLists = TemplateList::where('subscriber_id', $subscriberId)
            ->where('full_screen', $param1)
            ->where('footer_image', $param2)
            ->where('left_sidebar', $param3)
            ->where('right_sidebar', $param4)
            ->get();

        // Pass the data to the view
        return view('template.manage', compact('templateLists', 'param1'));
    }

    public function getCreateList(Request $request)
    {
        // Get the 'value' attribute from the request
        $value = $request->value;

        // Retrieve the subscriber ID of the authenticated user
        $subscriberId = auth()->user()->subscriber_id;

        // Check the value and query accordingly
        if ($value === "Image") {
            $Playlists = PlayList::select('playlist_name')
                ->where('image_file_name', '<>', null)
                ->where('subscriber_id', $subscriberId)  // Filter by subscriber ID
                ->groupBy('playlist_name')
                ->get();
        } elseif ($value === "Video") {
            $Playlists = PlayList::select('playlist_name')
                ->where('video_file_name', '<>', null)
                ->where('subscriber_id', $subscriberId)  // Filter by subscriber ID
                ->groupBy('playlist_name')
                ->get();
        } elseif ($value === "full") {
            // Fetch both image and video playlists for the subscriber
            $ImagePlaylists = PlayList::select('playlist_name')
                ->where('image_file_name', '<>', null)
                ->where('subscriber_id', $subscriberId)
                ->groupBy('playlist_name')
                ->get();

            $VideoPlaylists = PlayList::select('playlist_name')
                ->where('video_file_name', '<>', null)
                ->where('subscriber_id', $subscriberId)
                ->groupBy('playlist_name')
                ->get();

            return response()->json([
                'status' => 200,
                'ImagePlaylists' => $ImagePlaylists,
                'VideoPlaylists' => $VideoPlaylists,
            ]);
        } else {
            // Handle unexpected value
            return response()->json([
                'status' => 400,
                'message' => 'Invalid type provided.',
            ]);
        }

        // Return the response as JSON for Image or Video playlists
        return response()->json([
            'status' => 200,
            'Playlists' => $Playlists,
        ]);
    }


    public function getStore($request)
    {
        $message = [
            'template_name.required'  => 'Template Name is required',
            'full_screen.required'    => 'Full Screen is required',
            'height.required'         => 'Screen Height is required',
            'width.required'          => 'Screen Width is required',
            'footer.required'         => 'Footer Image is required',
            'left_sidebar.required'   => 'left Sidebar is required',
            'right_sidebar.required'  => 'Right Sidebar is required',
            'rotation.required'       => 'Rotation is required',
            // 'video.*.required'        => 'Video is required',
        ];
        $validator = Validator::make($request->all(), [
            'template_name'  => 'required',
            'full_screen'    => 'required',
            'height'         => 'required|numeric',
            'width'          => 'required|numeric',
            'footer'         => 'required',
            'left_sidebar'   => 'required',
            'right_sidebar'  => 'required',
            'rotation'       => 'required',
        ], $message);

        // Handle validation failure
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        // Check if the template name already exists for this subscriber
        $subscriberId = Auth::user()->subscriber_id;

        if (TemplateList::where('template_name', $request->template_name)
            ->where('subscriber_id', $subscriberId)
            ->exists()
        ) {
            return response()->json([
                'status' => 400,
                'message' => 'Template Name already exists'
            ]);
        }

        // Create the new template with subscriber_id
        $templateList = new TemplateList;
        $templateList->subscriber_id         = $subscriberId;
        $templateList->template_name         = $request->template_name;
        $templateList->full_screen           = $request->full_screen;
        $templateList->screen_height         = $request->height . 'px';
        $templateList->screen_width          = $request->width . 'px';
        $templateList->footer                = $request->footer;
        $templateList->left_sidebar          = $request->left_sidebar;
        $templateList->right_sidebar         = $request->right_sidebar;
        $templateList->rotation              = $request->rotation;
        $templateList->save();

        // Save associated playlists with order index
        $order = 0;
        foreach ($request->playlists as $playlist) {
            $playlist_name = PlayList::where('playlist_name', $playlist['playlist_name'])
                ->where('subscriber_id', $subscriberId)
                ->value('playlist_name'); // Only select the name

            if ($playlist_name) {
                $TemplatePlayList = new TemplatePlayList;
                $TemplatePlayList->template_id   = $templateList->id;
                $TemplatePlayList->playlist_name = $playlist_name;
                $TemplatePlayList->order_index   = ++$order;
                $TemplatePlayList->save();
            }
        }

        return response()->json([
            'status' => 200,
            'message' => "Added Successfully"
        ]);
    }

    public function getEdit($request, $id)
    {
        // $id = $request['id'];
        $templateList = TemplateList::find($id);
        // return response()->json($templateLists);
        return view('template.edit', compact('templateList'));
    }

    public function getUpdate($request, $id)
    {

        $message = [
            'template_name.required'  => 'Template Name is required',
            'playlists.required'  => 'Playlist name is required',
            'rotation.required'       => 'Rotation is required',
        ];
        $validator = Validator::make($request->all(), [
            'template_name'  => 'required',
            'playlists'  => 'required',
            'rotation'       => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $templateList = TemplateList::find($id);


            if (!is_null($templateList)) {

                $templateList->template_name         = $request->template_name;
                $templateList->full_screen           = $request->full_screen;
                $templateList->screen_height         = $request->height;
                $templateList->screen_width          = $request->width;
                $templateList->footer                = $request->footer;
                $templateList->left_sidebar          = $request->left_sidebar;
                $templateList->right_sidebar         = $request->right_sidebar;
                $templateList->rotation              = $request->rotation;




                // Retrieve old playlists from the TemplatePlaylists model
                $oldPlaylists = TemplatePlayList::where('template_id', $id)->get();
                $oldPlaylistNames = $oldPlaylists->pluck('playlist_name')->toArray();

                // Convert incoming playlists to a more manageable format
                $newPlaylists = $request->playlists; // Array of new playlists

                // Get the names of new playlists
                $newPlaylistNames = array_column($newPlaylists, 'playlist_name');
                $order = 1;
                // Determine playlists that are new and need to be added
                $playlistsToAdd = array_diff($newPlaylistNames, $oldPlaylistNames);
                foreach ($newPlaylists as $newPlaylist) {
                    $playlistName = $newPlaylist['playlist_name'];

                    // Check if the playlist is in the old list
                    $existingPlaylist = TemplatePlayList::where('template_id', $id)
                        ->where('playlist_name', $playlistName)
                        ->first();

                    if ($existingPlaylist) {
                        // Update the order_index for existing playlist
                        $existingPlaylist->update([
                            'order_index' => $order
                        ]);
                    } else if (in_array($playlistName, $playlistsToAdd)) {
                        // Create a new playlist entry if it needs to be added
                        TemplatePlayList::create([
                            'template_id' => $id,
                            'playlist_name' => $playlistName,
                            'order_index' => $order,
                            'subscriber_id' => Auth::user()->subscriber_id,

                        ]);
                    }

                    $order++;
                }
                // Determine playlists that need to be deleted
                $playlistsToDelete = array_diff($oldPlaylistNames, $newPlaylistNames);

                // Delete playlists that are in the old list but not in the current list
                TemplatePlayList::where('template_id', $id)
                    ->whereIn('playlist_name', $playlistsToDelete)
                    ->delete(); {
                    $data['playlist_details'] = [];

                    $search_play_list = PlayList::where('playlist_name', $templateList->playlist_name)->get();
                    foreach ($search_play_list as $playlist) {
                        $data['playlist_details'][] = [
                            'playlist_name'   => $playlist->playlist_name,
                            'video_file_name' => $playlist->video_file_name,
                            'image_file_name' => $playlist->image_file_name,
                            'duration'        => $playlist->duration,
                            'repeat'          => $playlist->repeat
                        ];
                    }





                    $apiURL = 'https://fcm.googleapis.com/v1/projects/tvmdm-75c8c/messages:send';

                    $deviceTokens = RegisterDevice::where([['template_id', $id], ["firebase_token", "!=", null]])
                        ->pluck('firebase_token')
                        ->toArray();

                    foreach ($deviceTokens as $token) {
                        $message = [
                            'token' => (string)$token, // Ensure token is a string
                            'data'  => [
                                'type'             => (string)'message',
                                'title'            => (string)'Message',
                                'message'          => (string)'Thank you for your support',
                                'template_name'    => (string)$templateList->template_name,
                                'full_screen'      => (string)$templateList->full_screen,
                                'screen_height'    => (string)$templateList->screen_height,
                                'screen_width'     => (string)$templateList->screen_width,
                                'footer_image'     => (string)$templateList->footer_image,
                                'left_sidebar'     => (string)$templateList->left_sidebar,
                                'right_sidebar'    => (string)$templateList->right_sidebar,
                                'rotation'         => (string)$templateList->rotation,
                                'playlist_details' => (string)json_encode($data['playlist_details']) // Ensure it's properly serialized and cast to string
                            ]
                        ];


                        $postInput = [
                            'message' => $message,
                        ];

                        $headers = [
                            'Authorization' => 'Bearer ' . $this->getAccessToken(),
                            'Content-Type'  => 'application/json; charset=UTF-8',
                        ];

                        $response = Http::withHeaders($headers)->post($apiURL, $postInput);

                        if ($response->successful()) {
                            log::info("FCM message sent successfully", ['response' => $response->json()]);
                        } else {
                            log::error("FCM message failed to send", ['response' => $response->json()]);
                        }
                    }
                }

                $templateList->save();
                $notification = array(
                    'message' => 'Updated Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('template.fullscreen.view');
            }
        }
    }
    private function getAccessToken()
    {
        $credentialsPath = storage_path('app/tvmdm.json');

        $client = new Google_Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $token = $client->fetchAccessTokenWithAssertion();
        return $token['access_token'];
    }
    public function getDestroy($id)
    {
        Template::destroy($id);
        TemplateContent::where('template_id', $id)
            ->delete();
        return redirect()->route('template.list.view')->with('Deleted Successfully');
    }

    public function get_playlist_type(Request $request)
    {
        // Retrieve the subscriber ID of the authenticated user
        $subscriberId = auth()->user()->subscriber_id;

        // Count the number of image files associated with the playlist and subscriber
        $image = PlayList::where('playlist_name', $request->playlistName)
            ->whereNotNull('image_file_name')
            ->where('subscriber_id', $subscriberId) // Filter by subscriber ID
            ->count();

        // Count the number of video files associated with the playlist and subscriber
        $video = PlayList::where('playlist_name', $request->playlistName)
            ->whereNotNull('video_file_name')
            ->where('subscriber_id', $subscriberId) // Filter by subscriber ID
            ->count();

        // Determine playlist type based on counts
        if ($video > $image) {
            return response()->json([
                'status' => 200,
                'type' => "Video"
            ]);
        }

        return response()->json([
            'status' => 200,
            'type' => "Image"
        ]);
    }


    public function assign_device(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'device_name' => 'required', // Ensure device ID exists in the register_devices table
            'template_id' => 'required|exists:templates,id',      // Ensure template ID exists in the templates table
        ]);

        try {
            // Find the device by ID
            $device = RegisterDevice::where('device_id', $request->device_name)->first();
            $device = RegisterDevice::find($device->id);

            // Update the device's content type and content ID
            $device->content_type = 'templates';
            $device->content_id = $request->template_id;
            $device->save();

            return response()->json([
                'success' => true,
                'message' => 'Device assigned successfully.',
            ]);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign device: ' . $e->getMessage(),
            ]);
        }
    }
}
