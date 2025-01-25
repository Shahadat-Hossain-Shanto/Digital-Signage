<style>
    .nav-link.active {
        color: black !important;
        font-weight: bold;
        background-color: rgb(0, 208, 255) !important;
        position: relative;
        border-radious: 0px;
    }

    #imageModal .nav-link.active:after {
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        border-left: 10px solid rgb(0, 208, 255);
        border-top: 13px solid transparent;
        border-bottom: 13px solid transparent;
    }

    .link-wrapper {
        position: relative;
        display: inline-block;
    }

</style>
<x-layout titlePage="Template Contents" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='template.edit'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Template Contents" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/template"> Template</a></li>'>
        </x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong>Template Contents</strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="card-body common_property">
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start ps-5 edit_template_name" id="edit_template_name">

                                            <span name="template_name" id="template_name" contenteditable="true" style="outline: 0px solid transparent;" data-template_id="{{ $template->id }}">
                                                {{ $template->template_name }}
                                            </span>
                                            &nbsp;&nbsp;
                                            <i class='fas fa-pencil-alt' for='template_name' id="edit_template_name_icon" hidden></i>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <button class="btn bg-gradient-danger mb-0" type="delete">
                                                Delete
                                            </button>
                                            <button class="btn bg-gradient-success mb-0 ms-3" id="submit" type="submit">
                                                Publish
                                            </button>
                                            <div class="text-end ms-3">
                                                <a class="btn bg-gradient-dark mb-0" href="{{ route("template.list.view") }}">
                                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-12 ms-0 my-4">
                                        <div class="col-md-10 px-2 " style="background-color: #f3f2f2; border-radius: 8px;">
                                            <div class="d-flex justify-content-between p-4 pb-2">
                                                <div class="col-md-2" style="margin: auto 0;">
                                                    <select class="form-select p-2 bg-white" aria-label="Default select example" name="option" id="option">
                                                        <option value="background_audio" selected>Background Audio
                                                        </option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <div class="form-check form-switch d-inline-block custom-switch pe-1">
                                                        <input type="checkbox" class="form-check-input" id="muteCheckbox" name="mute" style="margin-top: 5px;" {{ $template->mute === "true" ? "checked" : "false" }}>
                                                        <label class="form-check-label" for="muteCheckbox">
                                                            <h5 class="d-inline" style="vertical-align: middle;">Mute
                                                            </h5>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn bg-white" id="openImageModal" data-bs-toggle="modal" data-bs-target="#imageModal" style="margin: auto 0;">
                                                        <p class="fw-bolder mb-0"><i class="material-icons text-sm" style="vertical-align: baseline;">add</i>&nbsp;&nbsp;Add
                                                            Content</p>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id='content'>
                                                <div id='audio_content' class="d-flex justify-content-between m-4 p-4 mt-0 mb-5" style="background-color: #ffffff; border-radius: 8px;">
                                                    <div id="background_audio_mediaTable" class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Media</th>
                                                                    <th>Content Name</th>
                                                                    <th>Content Type</th>
                                                                    <th>Duration</th>
                                                                    <th>Audio</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="text-align: center; vertical-align: middle;">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div id='main_content' class="d-none justify-content-between m-4 p-4 mt-0 mb-5" style="background-color: #ffffff; border-radius: 8px;">
                                                    <div id="main_zone_mediaTable" class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Media</th>
                                                                    <th>Content Name</th>
                                                                    <th>Content Type</th>
                                                                    <th>Duration</th>
                                                                    <th>Audio</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="text-align: center; vertical-align: middle;">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div id='background_content' class="d-none justify-content-between m-4 p-4 mt-0 mb-5" style="background-color: #ffffff; border-radius: 8px;">
                                                    <div id="background_mediaTable" class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Media</th>
                                                                    <th>Content Name</th>
                                                                    <th>Content Type</th>
                                                                    <th>Duration</th>
                                                                    <th>Audio</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="text-align: center; vertical-align: middle;">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-block text-center p-3">
                                            <p class="fw-bolder mb-0">Layout</p>
                                            <div class='p-2'>
                                                <div class="">
                                                    <div class="orientation" id="zone" data-layout_type="{{ $template->template_type }}" data-layout_name="{{ $template->template_layout }}">
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <label class="form-label m-2 p-2 fs-6 text-white" id="background_audio" style="background-color: #000000; border-radius: 20px; width: 90%;">Background
                                                        Audio</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        {{-- Content --}}
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Select Media</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="min-height: 67vh;">
                        <div class="row">
                            <!-- Vertical Tabs Navigation -->
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills" id="mediaTab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="playlists-tab" data-bs-toggle="pill" data-bs-target="#playlists" type="button" role="tab" aria-controls="playlists" aria-selected="true">Playlists</button>
                                    <button class="nav-link" id="images-tab" data-bs-toggle="pill" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="true">Images</button>
                                    <button class="nav-link" id="videos-tab" data-bs-toggle="pill" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">Videos</button>
                                    <button class="nav-link" id="audios-tab" data-bs-toggle="pill" data-bs-target="#audios" type="button" role="tab" aria-controls="audios" aria-selected="false">Audios</button>
                                    <button class="nav-link" id="links-tab" data-bs-toggle="pill" data-bs-target="#links" type="button" role="tab" aria-controls="links" aria-selected="false">Links</button>
                                </div>
                            </div>
                            <!-- Tab Content Area -->
                            <div class="col-md-9">
                                <div class="tab-content" id="mediaTabContent">
                                    <!-- Playlists Tab Pane -->
                                    <div class="tab-pane fade show active" id="playlists" role="tabpanel" aria-labelledby="playlists-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @foreach ($playlists as $playlist)
                                                <tr>
                                                    <td class="py-3">
                                                        <div class="stacked-card" style="position: relative; width: 120px; height: 160px; margin: 0 auto; overflow: hidden;">
                                                            <a>
                                                                @php
                                                                $contents = explode(",", $playlist->contents);
                                                                $contentTypes = explode(
                                                                ",",
                                                                $playlist->content_types,
                                                                );
                                                                @endphp
                                                                @foreach ($contents as $index => $content)
                                                                @if ($contentTypes[$index] == "Image")
                                                                <img src="{{ asset("contents/images/" . $content) }}" alt="{{ $content }}" class="stacked-image" style="position: absolute; top: {{ $index * 10 }}px; left: {{ $index * 10 }}px; width: 100%; border-radius: 8px;">
                                                                @elseif ($contentTypes[$index] == "Video")
                                                                <video src="{{ asset("contents/videos/" . $content) }}" alt="Video Thumbnail" class="stacked-image" style="position: absolute; top: {{ $index * 10 }}px; left: {{ $index * 10 }}px; width: 100%; border-radius: 8px;">
                                                                    @endif
                                                                    @endforeach
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>{{ $playlist->playlist_name }}</td>
                                                    <td>
                                                        @if ($playlist->mute == "true")
                                                        Mute
                                                        @else
                                                        Unmute
                                                        @endif
                                                    </td>
                                                    <td>{{ $playlist->total_duration }} Seconds</td>
                                                    <td class="d-none">{{ $playlist }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Images Tab Pane -->
                                    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @foreach ($imageLists as $imageList)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset("contents/images/{$imageList->content}") }}" class="img-thumbnail" alt="Image" width="120">
                                                    </td>
                                                    <td>{{ $imageList->content }}</td>
                                                    {{-- <td>{{ $imageList->content_type }}</td> --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Videos Tab Pane -->
                                    <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @if (!is_null($videoLists))
                                                @foreach ($videoLists as $videoList)
                                                <tr>
                                                    <td>
                                                        <video width="150" height="auto" controls>
                                                            <source src="{{ asset("contents/videos/" . $videoList->content) }}" type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <td>{{ $videoList->content }}</td>
                                                    {{-- <td>{{ $videoList->content_type }}</td> --}}
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="3" class="text-center">No videos found.</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Audios Tab Pane -->
                                    <div class="tab-pane fade" id="audios" role="tabpanel" aria-labelledby="audios-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @if (!is_null($audioLists))
                                                @foreach ($audioLists as $audioList)
                                                <tr>
                                                    <td>
                                                        <audio width="120" height="auto" controls style="width: 120;">
                                                            <source src="{{ asset("contents/audios/" . $audioList->content) }}" type="audio/mpeg">
                                                        </audio>
                                                    </td>
                                                    <td>{{ $audioList->content }}</td>
                                                    {{-- <td>{{ $audioList->content_type }}</td> --}}
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="3" class="text-center">No audios found.</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Links Tab Pane -->
                                    <div class="tab-pane fade" id="links" role="tabpanel" aria-labelledby="links-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @if (!is_null($linkLists))
                                                @foreach ($linkLists as $linkList)
                                                <tr>
                                                    <td>
                                                        <div class="link-wrapper">
                                                            @php
                                                            $content = $linkList->content;
                                                            $videoExtensions = [".mp4", ".webm", ".ogg"];
                                                            $audioExtensions = [".mp3", ".ogg", ".wav"];
                                                            $fileExtension = strtolower(
                                                            pathinfo($content, PATHINFO_EXTENSION),
                                                            );

                                                            // Detect YouTube link and extract ID
                                                            $youtubeId = null;
                                                            if (
                                                            preg_match(
                                                            "/(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/",
                                                            $content,
                                                            $matches,
                                                            )
                                                            ) {
                                                            $youtubeId = $matches[1];
                                                            }
                                                            @endphp

                                                            @if ($youtubeId)
                                                            {{-- YouTube Video Embed --}}
                                                            <iframe width="350" height="200" src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            @elseif (in_array($fileExtension, $videoExtensions))
                                                            {{-- HTML5 Video --}}
                                                            <video width="350" height="200" controls>
                                                                <source src="{{ asset($content) }}" type="video/{{ $fileExtension }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                            @elseif (in_array($fileExtension, $audioExtensions))
                                                            {{-- HTML5 Audio --}}
                                                            <audio controls>
                                                                <source src="{{ asset($content) }}" type="audio/{{ $fileExtension }}">
                                                                Your browser does not support the audio tag.
                                                            </audio>
                                                            @elseif (filter_var($content, FILTER_VALIDATE_URL))
                                                            {{-- Attempt to Embed as Iframe or Open in New Tab if Blocked --}}
                                                            <div class="iframe-container" style="position: relative; width: 350px; height: 200px;">
                                                                <iframe id="iframe-{{ $linkList->id }}" width="100%" height="100%" src="{{ $content }}" frameborder="0" style="border: none;" allowfullscreen onerror="handleIframeError(this, '{{ $content }}')">
                                                                </iframe>
                                                                <button class="fullscreen-btn" onclick="toggleFullscreen('iframe-{{ $linkList->id }}')" style="position: absolute; bottom: 15px; right: 15px; background: rgba(0, 0, 0, 0.6); border: none; padding: 5px; border-radius: 50%;">
                                                                    <i class="material-icons text-white" style="font-size: 20px;">fullscreen</i>
                                                                </button>
                                                            </div>
                                                            @else
                                                            {{-- Default Link --}}
                                                            <a href="{{ asset($content) }}" target="_blank">
                                                                <button class="btn btn-link">View
                                                                    Link</button>
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $linkList->content }}" target="_blank">
                                                            <button class="btn btn-link">{{ $linkList->content }}</button>
                                                        </a>
                                                    </td>
                                                    {{-- <td>{{ $linkList->content_type }}</td> --}}
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="3" class="text-center">No links found.</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveMedia">Select</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-plugins></x-plugins>
    </div>
    @push("js")
    {{-- Load --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var layout_type = $('#zone').data('layout_type');
            var layout_name = $('#zone').data('layout_name');

            if (layout_type == 'Portrait' && layout_name == 'Full Screen') {
                $('#zone').addClass('portrait-full-screen');
                $('#option').prepend('<option value="main_zone">Main Zone</option>');
            } else if (layout_type == 'Portrait' && layout_name == 'Full Screen with Background') {
                $('#zone').parent().attr('id', 'background').addClass('landscape-full-screen-with-background');
                $('#zone').addClass('portrait-full-screen-with-background-zone-1');
                $('#option').prepend('<option value="main_zone">Main Zone</option>');
                $('#option').prepend('<option value="background">Background</option>');
            } else if (layout_type == 'Landscape' && layout_name == 'Full Screen') {
                $('#zone').addClass('landscape-full-screen');
                $('#option').prepend('<option value="main_zone">Main Zone</option>');
            } else if (layout_type == 'Landscape' && layout_name == 'Full Screen with Background') {
                $('#zone').parent().attr('id', 'background').addClass('landscape-full-screen-with-background');
                $('#zone').addClass('landscape-full-screen-with-background-zone-1');
                $('#option').prepend('<option value="main_zone">Main Zone</option>');
                $('#option').prepend('<option value="background">Background</option>');
            }

            // CSS
            $(document).ready(function() {
                $('.layout').css({
                    'margin': '0 auto'
                , });

                $('.landscape-full-screen').css({
                    'width': '100%'
                    , 'height': '100%'
                    , 'top': '0px'
                    , 'left': '0px'
                    , 'z-index': '10'
                    , 'overflow': 'hidden'
                    , 'background-color': '#a09d9d'
                    , 'height': '100px'
                    , 'margin': '0 auto'
                    , 'border-radius': '8px'
                });

                $('.landscape-full-screen-with-background').css({
                    width: '100%'
                    , height: '100%'
                    , background: 'rgb(100, 94, 94)'
                    , 'z-index': 1
                    , 'height': '100px'
                    , 'position': 'relative'
                    , 'margin': '0 auto'
                    , 'border-radius': '8px'
                });
                $('.landscape-full-screen-with-background-zone-1').css({
                    width: '85%'
                    , height: '85%'
                    , top: '8%'
                    , left: '8%'
                    , 'z-index': 3
                    , position: 'absolute'
                    , 'border-radius': '4px'
                    , overflow: 'hidden'
                    , 'background-color': '#a09d9d'
                    , 'box-shadow': 'rgba(0, 0, 0, 0.4) 0px 0px 30px'
                });

                $('.portrait-full-screen').css({
                    'width': '100%'
                    , 'height': '100%'
                    , 'top': '0px'
                    , 'left': '0px'
                    , 'z-index': '10'
                    , 'overflow': 'hidden'
                    , 'background-color': '#a09d9d'
                    , 'height': '100px'
                    , 'width': '70px'
                    , 'margin': '0 auto'
                    , 'border-radius': '8px'
                });

                $('.portrait-full-screen-with-background').css({
                    width: '100%'
                    , height: '100%'
                    , background: 'rgb(100, 94, 94)'
                    , 'z-index': 1
                    , 'height': '100px'
                    , 'position': 'relative'
                    , 'height': '100px'
                    , 'width': '70px'
                    , 'margin': '0 auto'
                    , 'border-radius': '8px'
                });
                $('.portrait-full-screen-with-background-zone-1').css({
                    width: '85%'
                    , height: '85%'
                    , top: '8%'
                    , left: '8%'
                    , 'z-index': 3
                    , position: 'absolute'
                    , 'border-radius': '4px'
                    , overflow: 'hidden'
                    , 'background-color': '#a09d9d'
                    , 'box-shadow': 'rgba(0, 0, 0, 0.4) 0px 0px 30px'
                });
            });
        });

        $("#edit_template_name").hover(
            function() {
                $('#edit_template_name_icon').removeAttr('hidden');
            }
            , function() {
                $('#edit_template_name_icon').attr('hidden', true);
            }
        );

        $("#option").change(function() {
            var selectedValue = $(this).val();
            if (selectedValue == 'main_zone') {
                $("#zone").css("background-color", 'rgb(0, 0, 0)');
                $("#background").css("background-color", 'rgb(100, 94, 94)');
                $("#background_audio").css("background-color", 'rgb(100, 94, 94)');

                $('#main_content').removeClass('d-flex');
                $('#background_content').removeClass('d-flex');
                $('#audio_content').removeClass('d-flex');

                $('#main_content').removeClass('d-none');
                $('#background_content').removeClass('d-none');
                $('#audio_content').removeClass('d-none');

                $('#main_content').addClass('d-flex');
                $('#background_content').addClass('d-none');
                $('#audio_content').addClass('d-none');

            } else if (selectedValue == 'background') {
                $("#zone").css("background-color", '#a09d9d');
                $("#background").css("background-color", 'rgb(0, 0, 0)');
                $("#background_audio").css("background-color", 'rgb(100, 94, 94)');

                $('#main_content').removeClass('d-flex');
                $('#background_content').removeClass('d-flex');
                $('#audio_content').removeClass('d-flex');

                $('#main_content').removeClass('d-none');
                $('#background_content').removeClass('d-none');
                $('#audio_content').removeClass('d-none');

                $('#main_content').addClass('d-none');
                $('#background_content').addClass('d-flex');
                $('#audio_content').addClass('d-none');
            } else if (selectedValue == 'background_audio') {
                $("#zone").css("background-color", '#a09d9d');
                $("#background").css("background-color", 'rgb(100, 94, 94)');
                $("#background_audio").css("background-color", 'rgb(0, 0, 0)');

                $('#main_content').removeClass('d-flex');
                $('#background_content').removeClass('d-flex');
                $('#audio_content').removeClass('d-flex');

                $('#main_content').removeClass('d-none');
                $('#background_content').removeClass('d-none');
                $('#audio_content').removeClass('d-none');

                $('#main_content').addClass('d-none');
                $('#background_content').addClass('d-none');
                $('#audio_content').addClass('d-flex');
            }
        });

        $(document).ready(function() {
            $('#background_audio').click(function() {
                $("#zone").css("background-color", '#a09d9d');
                $("#background").css("background-color", 'rgb(100, 94, 94)');
                $("#background_audio").css("background-color", 'rgb(0, 0, 0)');
                $('#option').val('background_audio').change();

                $('#main_content').removeClass('d-flex');
                $('#background_content').removeClass('d-flex');
                $('#audio_content').removeClass('d-flex');

                $('#main_content').removeClass('d-none');
                $('#background_content').removeClass('d-none');
                $('#audio_content').removeClass('d-none');

                $('#main_content').addClass('d-none');
                $('#background_content').addClass('d-none');
                $('#audio_content').addClass('d-flex');
            });

            $('#background').click(function() {
                $("#zone").css("background-color", '#a09d9d');
                $("#background").css("background-color", 'rgb(0, 0, 0)');
                $("#background_audio").css("background-color", 'rgb(100, 94, 94)');
                $('#option').val('background').change();

                $('#main_content').removeClass('d-flex');
                $('#background_content').removeClass('d-flex');
                $('#audio_content').removeClass('d-flex');

                $('#main_content').removeClass('d-none');
                $('#background_content').removeClass('d-none');
                $('#audio_content').removeClass('d-none');

                $('#main_content').addClass('d-none');
                $('#background_content').addClass('d-flex');
                $('#audio_content').addClass('d-none');
            });

            $('#zone').click(function(event) {
                event.stopPropagation();
                $("#zone").css("background-color", 'rgb(0, 0, 0)');
                $("#background").css("background-color", 'rgb(100, 94, 94)');
                $("#background_audio").css("background-color", 'rgb(100, 94, 94)');
                $('#option').val('main_zone').change();

                $('#main_content').removeClass('d-flex');
                $('#background_content').removeClass('d-flex');
                $('#audio_content').removeClass('d-flex');

                $('#main_content').removeClass('d-none');
                $('#background_content').removeClass('d-none');
                $('#audio_content').removeClass('d-none');

                $('#main_content').addClass('d-flex');
                $('#background_content').addClass('d-none');
                $('#audio_content').addClass('d-none');
            });
        });

    </script>

    {{-- Select Content --}}
    <script>
        $(document).ready(function() {
            var selectedPlaylists = [];
            var selectedImages = [];
            var selectedVideos = [];
            var selectedAudios = [];
            var selectedLinks = [];

            $('#imageModal').find('table tr').click(function() {
                $(this).toggleClass('bg-selected');
            });

            $('#saveMedia').click(function() {
                var option = $("#option").val();
                selectedPlaylists = [];
                selectedImages = [];
                selectedVideos = [];
                selectedAudios = [];
                selectedLinks = [];

                $('#imageModal').find('#playlists table tr.bg-selected').each(function() {
                    var playlistContent = $(this).find('td').eq(4).text();
                    selectedPlaylists.push(playlistContent);
                });

                $('#imageModal').find('#images table tr.bg-selected').each(function() {
                    var imageContent = $(this).find('td').eq(1).text();
                    selectedImages.push(imageContent);
                });

                $('#imageModal').find('#videos table tr.bg-selected').each(function() {
                    var videoContent = $(this).find('td').eq(1).text();
                    selectedVideos.push(videoContent);
                });

                $('#imageModal').find('#audios table tr.bg-selected').each(function() {
                    var audioContent = $(this).find('td').eq(1).text();
                    selectedAudios.push(audioContent);
                });

                $('#imageModal').find('#links table tr.bg-selected').each(function() {
                    var linkContent = $(this).find('td').eq(1).text();
                    selectedLinks.push(linkContent);
                });

                selectedPlaylists.forEach(function(playlistContent) {
                    let parsedData = JSON.parse(playlistContent);
                    let audio = 'Mute';
                    if (parsedData.mute == 'false') {
                        audio = 'Unmute';
                    }

                    if (parsedData) {
                        var tdElement = $('<td class="py-3"></td>');

                        var stackedCardDiv = $(
                            '<div class="stacked-card" style="position: relative; width: 120px; height: 160px; margin: 0 auto; overflow: hidden;"></div>'
                        );

                        var anchorElement = $('<a></a>');

                        var contents = parsedData.contents.split(",");
                        var contentTypes = parsedData.content_types.split(",");

                        contents.forEach(function(content, index) {
                            var contentType = contentTypes[index];

                            if (contentType === "Image") {
                                var imgElement = $('<img>')
                                    .attr('src', '/contents/images/' + content)
                                    .attr('alt', content)
                                    .addClass('stacked-image')
                                    .css({
                                        position: 'absolute'
                                        , top: (index * 10) + 'px'
                                        , left: (index * 10) + 'px'
                                        , width: '100%'
                                        , borderRadius: '8px'
                                    });
                                anchorElement.append(imgElement);
                            } else if (contentType === "Video") {
                                var videoElement = $('<video>')
                                    .attr('src', '/contents/videos/' + content)
                                    .attr('alt', 'Video Thumbnail')
                                    .addClass('stacked-image')
                                    .css({
                                        position: 'absolute'
                                        , top: (index * 10) + 'px'
                                        , left: (index * 10) + 'px'
                                        , width: '100%'
                                        , borderRadius: '8px'
                                    });
                                anchorElement.append(videoElement);
                            }
                        });

                        stackedCardDiv.append(anchorElement);
                        tdElement.append(stackedCardDiv);
                    }
                    $('#' + option + '_mediaTable tbody').append(`
                            <tr class="draggable-row">
                                ${tdElement.prop('outerHTML')}
                                <td>${parsedData.playlist_name}</td>
                                <td>Playlist</td>
                                <td><input type="text" class="form-control" value="${parseInt(parsedData.total_duration)}" disabled></td>
                                <td>${audio}</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>
                        `);
                });

                selectedImages.forEach(function(imageContent) {
                    $('#' + option + '_mediaTable tbody').append(`
                                <tr class="draggable-row">
                                    <td><img src="{{ asset("contents/images/") }}/${imageContent}" class="img-thumbnail" alt="Image" width="150"></td>
                                    <td>${imageContent}</td>
                                    <td>Image</td>
                                    <td><input type="text" class="form-control border p-2" placeholder="Enter duration"value="05"></td>
                                    <td>Mute</td>
                                    <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                                </tr>
                            `);
                });

                selectedVideos.forEach(function(videoContent) {
                    var videoRow = `
                            <tr class="draggable-row">
                                <td>
                                    <video width="150" height="auto" controls>
                                        <source src="{{ asset("contents/videos/") }}/${videoContent}" type="video/mp4">
                                    </video>
                                </td>
                                <td>${videoContent}</td>
                                <td>Video</td>
                                <td><input type="text" class="form-control" id="duration" disabled></td>
                                <td>Unmute</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>`;
                    $('#' + option + '_mediaTable tbody').append(videoRow);
                    var videoElement = $('#' + option + '_mediaTable tbody tr:last-child video')[0];
                    getVideoDuration(videoElement);
                });

                selectedAudios.forEach(function(audioContent) {
                    var audioRow = `
                            <tr class="draggable-row">
                                <td>
                                    <audio width="150" height="auto" controls>
                                        <source src="{{ asset("contents/audios/") }}/${audioContent}" type="audio/mpeg">
                                    </audio>
                                </td>
                                <td>${audioContent}</td>
                                <td>Audio</td>
                                <td><input type="text" class="form-control" id="duration" disabled></td>
                                <td>Unmute</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>`;

                    $('#' + option + '_mediaTable tbody').append(audioRow);
                    var audioElement = $('#' + option + '_mediaTable tbody tr:last-child audio')[0];
                    getVideoDuration(audioElement);
                });

                selectedLinks.forEach(function(linkContent) {
                    var linkRow = `
                            <tr class="draggable-row">
                                <td>
                                    <div class="link-wrapper">
                                        @php
                                            $content = $linkList->content;
                                            $videoExtensions = [".mp4", ".webm", ".ogg"];
                                            $audioExtensions = [".mp3", ".ogg", ".wav"];
                                            $fileExtension = strtolower(pathinfo($content, PATHINFO_EXTENSION));

                                            // Detect YouTube link and extract ID
                                            $youtubeId = null;
                                            if (preg_match("/(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/", $content, $matches)) {
                                                $youtubeId = $matches[1];
                                            }
                                        @endphp

                                        @if ($youtubeId)
                                            {{-- YouTube Video Embed --}}
                                            <iframe width="350" height="200"
                                                src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        @elseif (in_array($fileExtension, $videoExtensions))
                                            {{-- HTML5 Video --}}
                                            <video width="350" height="200" controls>
                                                <source src="{{ asset($content) }}"
                                                    type="video/{{ $fileExtension }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif (in_array($fileExtension, $audioExtensions))
                                            {{-- HTML5 Audio --}}
                                            <audio controls>
                                                <source src="{{ asset($content) }}"
                                                    type="audio/{{ $fileExtension }}">
                                                Your browser does not support the audio tag.
                                            </audio>
                                        @elseif (filter_var($content, FILTER_VALIDATE_URL))
                                            {{-- Attempt to Embed as Iframe or Open in New Tab if Blocked --}}
                                            <div class="iframe-container"
                                                style="position: relative; width: 350px; height: 200px;">
                                                <iframe id="iframe-{{ $linkList->id }}"
                                                    width="100%" height="100%"
                                                    src="{{ $content }}"
                                                    frameborder="0" style="border: none;"
                                                    allowfullscreen
                                                    onerror="handleIframeError(this, '{{ $content }}')">
                                                </iframe>
                                                <button class="fullscreen-btn"
                                                    onclick="toggleFullscreen('iframe-{{ $linkList->id }}')"
                                                    style="position: absolute; bottom: 15px; right: 15px; background: rgba(0, 0, 0, 0.6); border: none; padding: 5px; border-radius: 50%;">
                                                    <i class="material-icons text-white"
                                                        style="font-size: 20px;">fullscreen</i>
                                                </button>
                                            </div>
                                        @else
                                            {{-- Default Link --}}
                                            <a href="{{ asset($content) }}"
                                                target="_blank">
                                                <button class="btn btn-link">View
                                                    Link</button>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="${linkContent}" target="_blank">
                                        <button
                                            class="btn btn-link">${linkContent}</button>
                                    </a>
                                </td>
                                <td>Link</td>
                                <td><input type="text" class="form-control border p-2" placeholder="Enter duration"value="05"></td>
                                <td>Unmute</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>`;

                    $('#' + option + '_mediaTable tbody').append(linkRow);
                });

                $('#imageModal').modal('hide');
                $('#imageModal').find('table tr').removeClass('bg-selected');
                makeRowsDraggable();
            });

            function makeRowsDraggable() {
                $('#background_audio_mediaTable tbody').sortable({
                    items: 'tr.draggable-row'
                    , cursor: 'move'
                    , update: function(event, ui) {}
                });
                $('#main_zone_mediaTable tbody').sortable({
                    items: 'tr.draggable-row'
                    , cursor: 'move'
                    , update: function(event, ui) {}
                });
                $('#background_mediaTable tbody').sortable({
                    items: 'tr.draggable-row'
                    , cursor: 'move'
                    , update: function(event, ui) {}
                });
            }

            function getVideoDuration(videoElement) {
                videoElement.onloadedmetadata = function() {
                    var durationInSeconds = videoElement.duration;
                    var formattedDuration = formatTime(durationInSeconds);
                    var durationInput = $(videoElement).closest('tr').find('input[type="text"]');
                    durationInput.val(formattedDuration);
                };
                if (videoElement.readyState >= 1) {
                    videoElement.onloadedmetadata();
                }
            }

            function formatTime(seconds) {
                var hours = Math.floor(seconds / 3600);
                var minutes = Math.floor((seconds % 3600) / 60);
                var remainingSeconds = Math.floor(seconds % 60);
                return pad(hours, 2) + ':' + pad(minutes, 2) + ':' + pad(remainingSeconds, 2);
            }

            function pad(value, length) {
                return ('0' + value).slice(-length);
            }

            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });
        });

        $('#submit').click(function(e) {
            e.preventDefault();
            let data = {};

            var background_audio = [];
            $('#background_audio_mediaTable tbody > tr').each(function() {
                let content = {};
                content["content_name"] = $(this).find("td:eq(1)").text().trim();
                content["content_type"] = $(this).find("td:eq(2)").text();
                content["duration"] = $(this).find("td:eq(3) input").val();
                content["audio"] = $(this).find("td:eq(4)").text();

                background_audio.push(content);
            });
            var main_zone = [];
            $('#main_zone_mediaTable tbody > tr').each(function() {
                let content = {};
                content["content_name"] = $(this).find("td:eq(1)").text().trim();
                content["content_type"] = $(this).find("td:eq(2)").text();
                content["duration"] = $(this).find("td:eq(3) input").val();
                content["audio"] = $(this).find("td:eq(4)").text();

                main_zone.push(content);
            });
            var background = [];
            $('#background_mediaTable tbody > tr').each(function() {
                let content = {};
                content["content_name"] = $(this).find("td:eq(1)").text().trim();
                content["content_type"] = $(this).find("td:eq(2)").text();
                content["duration"] = $(this).find("td:eq(3) input").val();
                content["audio"] = $(this).find("td:eq(4)").text();

                background.push(content);
            });

            data["background_audio_contents"] = background_audio;
            data["main_zone_contents"] = main_zone;
            data["background_contents"] = background;
            data["mute"] = $('#muteCheckbox').is(':checked') ? true : false;
            data["template_name"] = $('#template_name').text().trim();
            data["template_id"] = $('#template_name').data('template_id');
            data["template_type"] = $('#zone').data('layout_type');
            data["template_layout"] = $('#zone').data('layout_name');

            // console.log("Data to be sent:", data);

            $.ajax({
                type: "post"
                , url: "{{ route('template.update') }}"
                , data: JSON.stringify(data)
                , dataType: "json"
                , contentType: "application/json"
                , success: function(response) {
                    if (response.status == 200) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('Successful');
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.warning(response.message);
                    }
                }
            });
        });

    </script>
    @endpush
</x-layout>
