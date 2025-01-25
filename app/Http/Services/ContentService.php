<?php

namespace App\Http\Services;

use Log;
use Image;
use App\Models\Banner;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ContentService
{

    public function getUploadVideoAndImage(Request $request)
    {
        // foreach ($request->file('content_videos') as $video) {
        //     \Log::info('Uploaded file name: ' . $video->getClientOriginalName());
        //     \Log::info('Uploaded file size: ' . $video->getSize());
        //     \Log::info('Upload error: ' . $video->getError());
        // }
        // Validate the request input
        $request->validate([
            'content_images.*' => 'required|image|max:10240', // Allows any image type
            'content_videos.*' => 'required|mimes:mp4,avi,asf,mov,qt,avchd,flv,swf,mpg,mpeg,mpeg-4,wmv,divx,3gp|max:60000',
            'content_audios.*' => 'required|mimes:mp3,wav,ogg,flac,aac,m4a,webm|max:20000',
        ]);

        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Initialize an empty array to hold uploaded file paths
        $uploadedFiles = [];

        // Handle image uploads
        if ($request->hasFile('content_images')) {
            foreach ($request->file('content_images') as $file) {
                // Ensure the file is an instance of UploadedFile
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $imageName = uniqid() . '-' . $file->getClientOriginalName();
                    // Move the file to the designated directory
                    // $file->move(public_path('contents/images'), $imageName);
                    $file->move('contents/images', $imageName);

                    // Save the image name to the database with the subscriber ID
                    Content::create([
                        'content' => $imageName,
                        'subscriber_id' => $subscriberId,
                        'content_type' => 'Image',
                    ]);

                    // Store the uploaded file path
                    $uploadedFiles[] = 'contents/images/' . $imageName;
                }
            }
        }

        // Handle video uploads
        if ($request->hasFile('content_videos')) {
            foreach ($request->file('content_videos') as $video) {
                if ($video instanceof \Illuminate\Http\UploadedFile) { // Check if the file is valid
                    $videoName = uniqid() . '-' . $video->getClientOriginalName();
                    $video->move('contents/videos/', $videoName); // Move to the correct path

                    // Save video name to the database with the subscriber ID
                    Content::create([
                        'content' => $videoName,
                        'subscriber_id' => $subscriberId,
                        'content_type' => 'Video',
                    ]);

                    $uploadedFiles[] = 'contents/videos/' . $videoName; // Store uploaded file path
                }
            }
        }


        // Handle audio uploads
        if ($request->hasFile('content_audios')) {
            foreach ($request->file('content_audios') as $audio) {
                if ($audio instanceof \Illuminate\Http\UploadedFile) { // Check if the file is valid
                    $audioName = uniqid() . '-' . $audio->getClientOriginalName();
                    $audio->move('contents/audios/', $audioName); // Move to the correct path

                    // Save audio name to the database with the subscriber ID
                    Content::create([
                        'content' => $audioName,
                        'subscriber_id' => $subscriberId,
                        'content_type' => 'Audio',
                    ]);

                    $uploadedFiles[] = 'contents/audios/' . $audioName; // Store uploaded file path
                }
            }
        }

        // Check if any files were uploaded
        if (count($uploadedFiles) > 0) {
            return response()->json([
                'status' => 200,
                'uploaded_files' => $uploadedFiles,
                'message' => 'Content uploaded successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => "No content selected."
            ]);
        }
    }


    public function getDeleteVideo($id)
    {
        $contentVideo = Content::find($id);
        if (File::exists('contents/videos/' . $contentVideo->content)) {
            File::delete('contents/videos/' . $contentVideo->content);
        }

        Content::destroy($id);
        return redirect()->route('content.video.list')->with('status', 'Deleted successfully!');
    }



    public function getDeleteLink($id)
    {
        $contentLink = Content::find($id);
        if (File::exists('contents/links/' . $contentLink->content)) {
            File::delete('contents/links/' . $contentLink->content);
        }

        Content::destroy($id);
        return redirect()->route('content.link.list')->with('status', 'Deleted successfully!');
    }

    public function getDeleteAudio($id)
    {

        $contentAudio = Content::find($id);
        // Delete Old Image
        if (File::exists('contents/audios/' . $contentAudio->content)) {
            # code...
            File::delete('contents/audios/' . $contentAudio->content);
        }

        Content::destroy($id);
        return redirect()->route('content.audio.list')->with('status', 'Deleted successfully!');
    }

    public function getDeleteImage($id)
    {
        $contentImage = Content::find($id);

        if (File::exists('contents/images/' . $contentImage->content)) {
            File::delete('contents/images/' . $contentImage->content);
        }

        Content::destroy($id);
        return redirect()->route('content.image.list')->with('status', 'Deleted successfully!');
    }

    public function store_banner($request)
    {
        $subscriberId = Auth::user()->subscriber_id;
        $url = url('/');
        $banner = '/banner/';

        $content = Content::updateOrCreate(
            ['id' => $request->updateId, 'subscriber_id' => $subscriberId],
            [
                'subscriber_id' => $subscriberId,
                'content_type' => 'App',
            ]
        );

        if ($request->updateId == NULL) {
            Content::updateOrCreate(
                ['id' => $content->id, 'subscriber_id' => $subscriberId],
                [
                    'content' => $url . $banner . $content->id,
                ]
            );
        }

        foreach ($request->bannerText as $text) {
            Banner::updateOrCreate(
                ['id' => $text['id'], 'app_id' => $content->id, 'subscriber_id' => $subscriberId],
                [
                    'app_id' => $content->id,
                    'name' => $request->bannerName,
                    'text' => $text['text'],
                    'subscriber_id' => $subscriberId,
                ]
            );
        }
    }

    public function bannerInfo($id)
    {
        $banner = Banner::where('app_id', $id)->get();

        if ($banner) {
            return response()->json([
                'status' => 201,
                'data' => $banner,
                'message' => 'Data found.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found.'
            ]);
        }
    }

    public function deleteBanner($id)
    {
        Banner::where('app_id', $id)->delete();
        Content::destroy($id);
        return redirect()->route('content.banner.list')->with('status', 'Deleted successfully!');
    }
}
