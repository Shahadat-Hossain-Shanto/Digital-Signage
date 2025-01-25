<?php

namespace App\Http\Controllers;

use Log;
use File;
use Image;
use App\Models\Banner;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ContentService;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Storage;
class ContentController extends Controller
{
    protected $contentService;
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function content()
    {
        return view('content.manage');
    }

    public function createContentVideo()
    {
        return view('content.add_video');
    }

    public function createContentImage()
    {
        return view('content.add_image');
    }

    public function createContentAudio()
    {
        return view('content.add_audio');
    }

    public function createContentLink()
    {
        return view('content.add_link');
    }

    public function upload(Request $request)
    {
        return $this->contentService->getUploadVideoAndImage($request);
    }
    public function storeLinks(Request $request)
    {
        // Validate the links
        $request->validate([
            'content_links' => 'required|array|min:1',
            'content_links.*' => 'url', // Ensure each item is a valid URL
        ]);

        // Store the links in the database
        $subscriberId = Auth::user()->subscriber_id;
        foreach ($request->content_links as $link) {
            Content::create([
                'content' => $link,
                'subscriber_id' => $subscriberId,
                'content_type' => 'Link',
            ]);
        }

        // Redirect to content-link-list after successful storage
        return redirect()->route('content.link.list')->with('status', 'Links uploaded successfully');
    }


    public function showImageList()
    {
        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve image lists that belong to the authenticated subscriber
        $imageLists = Content::where('content_type', "Image")
            ->where('subscriber_id', $subscriberId) // Filter by subscriber ID
            ->paginate(8);

        // Pass the image lists to the view
        return view('content.imageList', compact('imageLists'));
    }

    public function showAudioList()
    {
        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve audio lists associated with the authenticated subscriber
        $audioLists = Content::where('content_type', "Audio")
            ->where('subscriber_id', $subscriberId) // Filter by subscriber ID
            ->paginate(12);

        return view('content.audioList', compact('audioLists'));
    }

    public function showVideoList()
    {
        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve video lists associated with the authenticated subscriber
        $videoLists = Content::where('content_type', "Video")
            ->where('subscriber_id', $subscriberId) // Filter by subscriber ID
            ->paginate(6);

        return view('content.videoList', compact('videoLists'));
    }
    public function showLinkList()
    {
        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        // Retrieve video lists associated with the authenticated subscriber
        $linkLists = Content::where('content_type', "Link")
            ->where('subscriber_id', $subscriberId) // Filter by subscriber ID
            ->paginate(6);

        return view('content.linkList', compact('linkLists'));
    }
    public function showAppList()
    {
        // Get the authenticated subscriber ID
        $subscriberId = Auth::user()->subscriber_id;

        $applist = Content::where('content_type', 'App')
            ->where('content', 'NOT LIKE', '%banner%')
            ->get()
            ->map(function ($content) {
                $slug = basename($content->content); // e.g. 'digital-clock-2'
                $content->image = $slug;

                $slug = str_replace('-', ' ', $slug);
                $slug = ucwords($slug);
                $slug = trim($slug);
                $content->formatted_name = $slug;

                return $content;
            });

        return view('content.WidgetList', compact('applist'));
    }
    public function showBannerList()
    {
        $subscriberId = Auth::user()->subscriber_id;

        $distinctAppIds = Banner::where('subscriber_id', $subscriberId)
            ->select('app_id')
            ->distinct()
            ->get();

        $banners = collect();
        foreach ($distinctAppIds as $app) {
            $banner = Content::join('banners', 'banners.app_id', '=', 'contents.id')
                ->select('app_id', 'name', 'text', 'content')
                ->where('banners.subscriber_id', $subscriberId)
                ->where('banners.app_id', $app->app_id)
                ->orderBy('banners.id')
                ->first();

            $allText = Banner::select('text')
                ->where('subscriber_id', $subscriberId)
                ->where('app_id', $app->app_id)
                ->orderBy('id')
                ->get();
            $banner->fullText = $allText;
            if ($banner) {
                $banners->push($banner);
            }
        }
        return view('content.bannertList', compact('banners'));
    }
    public function deleteImage($id)
    {
        return $this->contentService->getDeleteImage($id);
    }

    public function deleteAudio($id)
    {
        return $this->contentService->getDeleteAudio($id);
    }

    public function deleteVideo($id)
    {
        return $this->contentService->getDeleteVideo($id);
    }
    public function deleteLink($id)
    {
        return $this->contentService->getDeleteLink($id);
    }
    public function store_banner(Request $request)
    {
        return $this->contentService->store_banner($request);
    }
    public function bannerInfo($id)
    {
        return $this->contentService->bannerInfo($id);
    }
    public function deleteBanner($id)
    {
        return $this->contentService->deleteBanner($id);
    }


    public function upload_all(Request $request)
    {
        $subscriberId = Auth::user()->subscriber_id;
        if ($request->has('content')) {  // Text input case
            $request->validate([
                'content' => 'required|string|max:5000',  // Validate text input
            ]);

            // Save the text content to the database
            Content::create([
                'content' => $request->input('content'),
                'subscriber_id' => $subscriberId,
                'content_type' => 'Link',
            ]);

            return response()->json([
                'message' => 'Text content saved successfully',
                'status' => 200
            ]);
        }
        // Adjust based on how you manage user authentication
        $uploadedFiles = []; // To store information about uploaded files

        // Supported extensions for each type
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $videoExtensions = ['mp4', 'avi', 'mov'];
        $audioExtensions = ['mp3', 'wav'];

        // Loop through each uploaded file
        foreach ($request->file('file') as $file) {
            $extension = $file->getClientOriginalExtension();
            // $filename = uniqid() . '-' . $file->getClientOriginalName();
            $folder = '';

            // Determine the folder based on file type
            if (in_array(strtolower($extension), $imageExtensions)) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $imageName = uniqid() . '-' . $file->getClientOriginalName();
                    // Move the file to the designated directory
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
            } elseif (in_array(strtolower($extension), $videoExtensions)) {
                if ($file instanceof \Illuminate\Http\UploadedFile) { // Check if the file is valid
                    $videoName = uniqid() . '-' . $file->getClientOriginalName();
                    $file->move('contents/videos/', $videoName); // Move to the correct path

                    // Save video name to the database with the subscriber ID
                    Content::create([
                        'content' => $videoName,
                        'subscriber_id' => $subscriberId,
                        'content_type' => 'Video',
                    ]);

                    $uploadedFiles[] = 'contents/videos/' . $videoName; // Store uploaded file path
                }
            } elseif (in_array(strtolower($extension), $audioExtensions)) {
                if ($file instanceof \Illuminate\Http\UploadedFile) { // Check if the file is valid
                    $audioName = uniqid() . '-' . $file->getClientOriginalName();
                    $file->move('contents/audios/', $audioName); // Move to the correct path

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


        return response()->json([
            'message' => 'Files uploaded successfully',
            'status' => 200


        ]);
    }
}
