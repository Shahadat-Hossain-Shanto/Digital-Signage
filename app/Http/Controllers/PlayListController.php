<?php

namespace App\Http\Controllers;

use Log;
use App\Models\PlayList;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PlaylistService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class PlayListController extends Controller
{
    protected $playlistService;
    public function __construct(PlaylistService $playlistService)
    {
        $this->playlistService = $playlistService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function video()
    {
        return $this->playlistService->getVideo();
    }

    public function image()
    {
        return $this->playlistService->getImage();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVideoPlayList()
    {
        return $this->playlistService->getCreateVideoPlaylist();
    }

    public function createImagePlayList()
    {
        return $this->playlistService->getCreateImagePlaylist();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeImagePlayList(Request $request)
    {
        return $this->playlistService->getStoreImagePlaylist($request);
    }

    public function storeVideoPlayList(Request $request)
    {
        return $this->playlistService->getStoreVideoPlaylist($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function editVideoPlayList(Request $request)
    // {
    //     $id = $request['id'];
    //     $videoPlayLists = PlayList::find($id);
    //     return response()->json($videoPlayLists);
    // }

    public function editImagePlayList(Request $request)
    {
        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve the playlist if it belongs to the subscriber
        $id = $request->input('id');
        $imagePlayLists = PlayList::where('id', $id)
            ->where('subscriber_id', $subscriberId)
            ->first();

        if ($imagePlayLists) {
            return response()->json($imagePlayLists);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Playlist not found or access denied.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function updateVideoPlayList(Request $request)
     {
         $message = [
             'edit_template_screen.required' => 'Template Screen is required',
             'edit_duration.required'        => 'Duration is required',
             // 'video.*.required' => 'Video is required',
         ];

         $validator = Validator::make($request->all(), [
             'edit_template_screen' => 'required',
             'edit_duration'        => 'required',
             // 'video.*' => 'required',
         ], $message);

         if ($validator->fails()) {
             return response()->json([
                 'status' => 400,
                 'errors' => $validator->messages()
             ]);
         }

         // Get the authenticated subscriber ID
         $subscriberId = Auth::user()->subscriber_id;

         // Find the playlist with the given screen_id and matching subscriber_id
         $videoList = PlayList::where('id', $request->screen_id)
             ->where('subscriber_id', $subscriberId)
             ->first();

         if ($videoList) {
             $videoList->template_screen = $request->edit_template_screen;
             $videoList->duration        = $request->edit_duration;
             $videoList->video           = implode(',', $request->input('video', []));

             $videoList->save();

             return response()->json([
                 'status' => 200,
                 'message' => 'Updated Successfully'
             ]);
         } else {
             return response()->json([
                 'status' => 404,
                 'message' => 'Playlist not found or access denied.'
             ], 404);
         }
     }

    public function updateImagePlayList(Request $request)
    {
        return $this->playlistService->ImagePlaylistUpdate($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyVideoPlayList( $id)
    {
        return $this->playlistService->getDestroyVideoPlaylist($id);

    }

    public function destroyImagePlayList( $id)
    {
        return $this->playlistService->getDestroyImagePlaylist($id);
    }


    public function showImageContentList(Request $request, String $id)
    {
        return $this->playlistService->getShowImageContentList($request, $id);
    }
    public function showVideoContentList(Request $request, String $id)
    {
        return $this->playlistService->getShowVideoContentList($request, $id);
    }

    public function addVideoPlayList(Request $request)
    {
        $videoContents = Content::where('video', '<>', null)->get();
        return view('DigitalSignage.videoContentList.createVideoPlaylist', compact('videoContents'));
    }
    public function VideoPlaylistEdit($id)
    {
        return $this->playlistService->VideoPlaylistEdit($id);
    }
    public function VideoPlaylistUpdate(Request $request)
    {
        return $this->playlistService->VideoPlaylistUpdate($request);
    }
    public function ImagePlaylistEdit($id)
    {
        return $this->playlistService->ImagePlaylistEdit($id);
    }
}
