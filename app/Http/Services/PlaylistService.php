<?php

namespace App\Http\Services;

use App\Models\Content;
use App\Models\PlayList;
use Illuminate\Http\Request;
use App\Models\PlayListContents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class playlistService
{

    public function getVideo()
    {
        // Get authenticated subscriber's ID
        $subscriberId = Auth::user()->subscriber_id;

        // Filter video playlists for the subscriber
        $playlists = PlayList::select('playlist_name')
            ->where('video_file_name', '<>', null)
            ->where('subscriber_id', $subscriberId)
            ->groupBy('playlist_name')
            ->get();

        return view('videoContentList.videoPlaylist', compact('playlists'));
    }

    public function getImage()
    {
        $subscriberId = Auth::user()->subscriber_id;
    
        $playlists = PlayList::select(
            'play_lists.playlist_name', 
            DB::raw('GROUP_CONCAT(play_list_contents.content SEPARATOR ",") as contents'),
            DB::raw('GROUP_CONCAT(play_list_contents.content_type SEPARATOR ",") as content_types')
        )
        ->join('play_list_contents', 'play_lists.id', '=', 'play_list_contents.playlist_id')
        ->where('play_lists.subscriber_id', $subscriberId)
        ->groupBy('play_lists.playlist_name')
        ->get();
    
        return view('imageContentList.imagePlaylist', compact('playlists'));
    }
    

    public function getCreateVideoPlaylist()
    {
        $subscriberId = Auth::user()->subscriber_id;

        $videoLists = Content::where('video', '<>', null)
            ->where('subscriber_id', $subscriberId)
            ->get();

        return view('videoContentList.createVideoPlaylist', compact('videoLists'));
    }

    public function getCreateImagePlaylist()
    {
        $subscriberId = Auth::user()->subscriber_id;

        $audioLists = Content::where('content_type','Audio')
            ->where('subscriber_id', $subscriberId)
            ->get();
        $imageLists = Content::where('content_type','Image')
            ->where('subscriber_id', $subscriberId)
            ->get();

        $videoLists = Content::where('content_type','Video')
            ->where('subscriber_id', $subscriberId)
            ->get();
            $linkLists = Content::where('content_type', 'Link')
            ->where('subscriber_id', $subscriberId)
            ->get();

        return view('imageContentList.createImagePlaylist', compact('linkLists','imageLists', 'audioLists','videoLists'));
    }

    public function getStoreImagePlaylist($request)
    {
        $subscriberId = Auth::user()->subscriber_id;
    
        // Check if playlist contents are provided
        if ($request->playlist_contents) {
            $order = 0;
    
            // Check if a playlist with the same name already exists
            if (PlayList::where('playlist_name', $request->playlist_name)
                ->where('subscriber_id', $subscriberId)
                ->count() > 0) {
                return response()->json(['status' => 400, 'message' => 'Playlist Name Exists']);
            }
    
            $playlist = new PlayList;
            $playlist->playlist_name = $request->playlist_name; // Use playlist name from request
            $playlist->subscriber_id = $subscriberId;
            
            // $playlist->repeat = $request->repeat ?? false; // Use repeat value from the request (default to false if not provided)
            $playlist->mute = $request->mute ?? false; // Use mute value from the request (default to false if not provided)
            $playlist->save(); // Save the playlist content
            // Iterate through each playlist content and save them
            foreach ($request->playlist_contents as $playlist_content) {
               
                log::info($playlist_content['duration']);
                $playlist_contents= new PlayListContents;
                $playlist_contents->playlist_id = $playlist->id; // Use 'content' for image/video source
                $playlist_contents->content = $playlist_content['content']; // Use 'content' for image/video source
                $playlist_contents->content_type = $playlist_content['type'];
                if($playlist_content['type']=='Video')
                {
                    $timeString = $playlist_content['duration'] ?? '00:00:00'; // Default to "00:00:00" if not set

                    // Validate that the time string is in the correct format (HH:MM:SS)
                    if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $timeString)) {
                        // Split the time string into an array of [hours, minutes, seconds]
                        list($hours, $minutes, $seconds) = explode(':', $timeString);
                    
                        // Convert the time to total seconds
                        $totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
                    
                        // Assign the converted value to the duration
                        $playlist_contents->duration = $totalSeconds;
                    } else {
                        // Handle invalid input format
                        throw new \Exception("Invalid duration format: $timeString");
                    }
                    
                }
               else{
                   $playlist_contents->duration = $playlist_content['duration'];

               }



                $playlist_contents->order_index = ++$order;
                $playlist_contents->subscriber_id = $subscriberId;
                $playlist_contents->save(); // Save the playlist content


            }
    
            return response()->json(['status' => 200, 'message' => 'Playlist created successfully!']);
        }
    
        return response()->json(['status' => 400, 'message' => 'All fields must be filled.']);
    }
    
    public function getStoreVideoPlaylist($request)
    {
        // Get the authenticated subscriber's ID
        $subscriberId = Auth::user()->subscriber_id;

        if ($request->playlist_contents) {
            $order = 0;

            // Check if a playlist with the same name exists for the subscriber
            if (PlayList::where('playlist_name', $request->playlist_contents[0]['playlist_name'])
                ->where('subscriber_id', $subscriberId)
                ->count() > 0) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Playlist Name Exists'
                ]);
            }

            foreach ($request->playlist_contents as $playlist_content) {
                if ($playlist_content) {
                    $playlist_contents = new PlayList;
                    $playlist_contents->playlist_name = $playlist_content['playlist_name'];
                    $playlist_contents->subscriber_id = $subscriberId; // Associate with subscriber
                    $playlist_contents->video_file_name = $playlist_content['videoFile'];
                    $playlist_contents->duration = $playlist_content['duration'];
                    $playlist_contents->repeat = $playlist_content['repeat'];
                    $playlist_contents->mute = $playlist_content['mute'];
                    $playlist_contents->order_index = ++$order;

                    $playlist_contents->save();
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Something went wrong'
                    ]);
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Playlist created successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'All fields must be filled.'
            ]);
        }
    }
    public function getDestroyImagePlaylist($id)
    {
        PlayList::where('playlist_name', $id)
        ->delete();

        return redirect()->route('image.playlist.view')->with('status', 'Deleted successfully!');

    }
    // public function getDestroyVideoPlaylist($id)
    // {
    //     // Find all playlists with the given playlist_name and non-null video_file_name
    //     $playlists = PlayList::where('playlist_name', $id)
    //                           ->where('video_file_name', '<>', null)
    //                           ->get();

    //     // Loop through each playlist and attempt to delete it
    //     foreach ($playlists as $playlist) {
    //         try {
    //             $playlist->delete();
    //         } catch (\Exception $e) {
    //             // Log the error if needed
    //             Log::error('Failed to delete playlist ID ' . $playlist->id . ': ' . $e->getMessage());
    //             // Optionally, you can add custom logic to handle specific errors
    //         }
    //     }

    //     // Redirect back with a success message
    //     return redirect()->route('video.playlist.view')->with('status', 'Deleted successfully!');
    // }

    public function getShowImageContentList($request, $id)
    {

        $subscriberId = Auth::user()->subscriber_id; 
        $imageLists = Content::where('content_type','Image')
        ->where('subscriber_id', $subscriberId)
        ->get();

        $videoLists = Content::where('content_type','Video')
            ->where('subscriber_id', $subscriberId)
            ->get();
        // Get the authenticated subscriber ID

        // Retrieve playlists for the authenticated subscriber
        $contentLists = PlayListContents::select('play_list_contents.*','play_lists.mute')
        ->join('play_lists', 'play_lists.id', '=', 'play_list_contents.playlist_id')
        ->where('play_lists.playlist_name', $id)
        ->where('play_lists.subscriber_id', $subscriberId)
        ->orderBy('play_list_contents.order_index', 'ASC')
        ->get();
            $linkLists = Content::where('content_type', 'Link')
            ->where('subscriber_id', $subscriberId)
            ->get();
        $name = $id;
        return view('imageContentList.showImageList', compact('contentLists', 'name','imageLists','videoLists','linkLists'));
    }

    // public function getShowVideoContentList($request, $id)
    // {
    //     // Get the authenticated subscriber ID
    //     $subscriberId = Auth::user()->subscriber_id;

    //     // Retrieve playlists for the authenticated subscriber
    //     $contentLists = PlayList::where('playlist_name', $id)
    //         ->where('subscriber_id', $subscriberId)
    //         ->orderBy('order_index', 'ASC')
    //         ->get();

    //     $name = $id;
    //     return view('videoContentList.showVideoList', compact('contentLists', 'name'));
    // }

    // public function VideoPlaylistEdit($id)
    // {
    //     $subscriberId = Auth::user()->subscriber_id;

    //     // Filter playlists by subscriber ID, playlist name, and video file presence
    //     $videoPlayLists = PlayList::where('playlist_name', $id)
    //         ->where('subscriber_id', $subscriberId)
    //         ->whereNotNull('video_file_name')
    //         ->orderBy('order_index', 'ASC')
    //         ->get();

    //     // Filter videos by subscriber ID
    //     $videoLists = Content::where('subscriber_id', $subscriberId)
    //         ->where('video', '<>', null)
    //         ->get();

    //     if ($videoPlayLists->isNotEmpty()) {
    //         $name = $id;
    //         return view('videoContentList.videoPlaylistUpdate', compact('videoPlayLists', 'name', 'videoLists'));
    //     } else {
    //         return response()->json([
    //             'status' => 404,
    //             'message' => 'Data not found.'
    //         ]);
    //     }
    // }
    public function ImagePlaylistEdit($id)
    {
        $subscriberId = Auth::user()->subscriber_id;

        // Filter playlists by subscriber ID and playlist name
        $ImagePlayLists = PlayList::where('playlist_name', $id)
            ->where('subscriber_id', $subscriberId)
            ->orderBy('order_index', 'ASC')
            ->get();

        // Filter content by subscriber ID
        $imageLists = Content::where('subscriber_id', $subscriberId)
            ->where('content_type','Image')
            ->get();

        $videoLists = Content::where('subscriber_id', $subscriberId)
            ->where('content_type','Video')
            ->get();

        if ($ImagePlayLists->isNotEmpty()) {
            $name = $id;
            return view('imageContentList.imagePlaylistUpdate', compact('ImagePlayLists', 'name', 'imageLists', 'videoLists'));
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found.'
            ]);
        }
    }

    // public function VideoPlaylistUpdate(Request $request)
    //     {
    //         $subscriberId = Auth::user()->subscriber_id;

    //         // Validate incoming request data
    //         $validatedData = $request->validate([
    //             'tableData.*.videoSrc' => 'required|string',
    //             'tableData.*.duration' => 'required|string',
    //             'tableData.*.repeat' => 'required|in:true,false',
    //             'tableData.*.mute' => 'required|in:true,false',
    //             'tableData.*.id' => 'nullable|integer|exists:play_lists,id',
    //         ]);

    //         $order = 1;
    //         $updatedIds = []; // To store IDs of records that are updated

    //         // First pass: Insert new records
    //         foreach ($validatedData['tableData'] as $data) {
    //             if (is_null($data['id'])) {
    //                 // Insert new record
    //                 $playlist = new PlayList();
    //                 $playlist->subscriber_id = $subscriberId;
    //                 $playlist->video_file_name = $data['videoSrc'];
    //                 $playlist->duration = $data['duration'];
    //                 $playlist->repeat = $data['repeat'];
    //                 $playlist->mute = $data['mute'];
    //                 $playlist->order_index = $order;
    //                 $playlist->playlist_name = $request->name; // Assuming you want to set the playlist name
    //                 $playlist->save();

    //                 // Add the ID to the list of updated IDs
    //                 $updatedIds[] = $playlist->id;
    //             } else {
    //                 // Update existing record
    //                 $playlist = PlayList::find($data['id']);

    //                 if ($playlist) {
    //                     $playlist->video_file_name = $data['videoSrc'];
    //                     $playlist->duration = $data['duration'];
    //                     $playlist->repeat = $data['repeat'];
    //                     $playlist->mute = $data['mute'];
    //                     $playlist->order_index = $order;
    //                     $playlist->save();

    //                     // Add the ID to the list of updated IDs
    //                     $updatedIds[] = $playlist->id;
    //                 }
    //             }
    //             $order++;
    //         }

    //         $updatedIds = array_map('intval', $updatedIds);

    //         // Delete records that are not in the updated list
    //         $deletedCount = PlayList::where('playlist_name', $request->name)
    //             ->where('subscriber_id', $subscriberId)
    //             ->whereNotNull('video_file_name')
    //             ->whereNotIn('id', $updatedIds)
    //             ->delete();

    //         return response()->json(['message' => 'Updated successfully!']);
    //     }
    public function ImagePlaylistUpdate(Request $request)
    {
        // Log request data for debugging
        Log::info($request->all());
    
        // Validate incoming request data
        $validatedData = $request->validate([
            'tableData.*.id' => 'nullable',
            'tableData.*.content' => 'required|string',
            'tableData.*.content_type' => 'required|string|in:Image,Video,Link',
            'tableData.*.duration' => 'required|string',
        ]);
    
        // Find the existing playlist by name
        $playlist = PlayList::where('playlist_name', $request->name)->first();
    
        if (!$playlist) {
            return response()->json(['error' => 'Playlist not found.'], 404);
        }
    
        // Update playlist mute option if provided
        if ($request->has('mute')) {
            $playlist->update(['mute' => $request->mute]);
        }
    
      // Delete all existing contents for this playlist
    PlayListContents::where('playlist_id', $playlist->id)->delete();

    // Insert the new contents
    $order = 1; // Initialize order index
    foreach ($validatedData['tableData'] as $data) {
        PlayListContents::create([
            'playlist_id' => $playlist->id,
            'content' => $data['content'],
            'content_type' => $data['content_type'],
            'duration' => $data['duration'],
            'order_index' => $order,
            'subscriber_id' => Auth::user()->subscriber_id,
        ]);
        $order++;
    }
    
        return response()->json(['message' => 'Playlist updated successfully!']);
    }
    
    }        