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
        <x-navbars.navs.auth titlePage="Template Contents"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/template"> Template</a></li>'>
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
                                        <div class="col-6 d-flex justify-content-start ps-5 edit_template_name"
                                            id="edit_template_name">

                                            <span name="template_name" id="template_name" contenteditable="true"
                                                style="outline: 0px solid transparent;"
                                                data-template_id="{{ $template->id }}">
                                                {{ $template->template_name }}
                                            </span>
                                            &nbsp;&nbsp;
                                            <i class='fas fa-pencil-alt' for='template_name'
                                                id="edit_template_name_icon" hidden></i>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <button class="btn bg-gradient-danger mb-0 delete"
                                                data-id="{{ $template->id }}">
                                                Delete
                                            </button>
                                            <button class="btn bg-gradient-success mb-0 ms-3" id="submit"
                                                type="submit">
                                                Publish
                                            </button>
                                            <button class="btn bg-gradient-warning mb-0 ms-3" id="assign">
                                                Assign to Device
                                            </button>
                                            <div class="text-end ms-3">
                                                <a class="btn bg-gradient-dark mb-0"
                                                    href="{{ route("template.list.view") }}">
                                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-12 ms-0 my-4">
                                        <div class="col-md-10 px-2 "
                                            style="background-color: #f3f2f2; border-radius: 8px;">
                                            <div class="d-flex justify-content-between p-4 pb-2">
                                                <div class="col-md-2" style="margin: auto 0;">
                                                    <select class="form-select p-2 bg-white"
                                                        aria-label="Default select example" name="option"
                                                        id="option">
                                                        <option value="background_audio" selected>Background Audio
                                                        </option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <div
                                                        class="form-check form-switch d-inline-block custom-switch pe-1">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="muteCheckbox" name="mute" style="margin-top: 5px;"
                                                            {{ $template->mute === "true" ? "checked" : "false" }}>
                                                        <label class="form-check-label" for="muteCheckbox">
                                                            <h5 class="d-inline" style="vertical-align: middle;">Mute
                                                            </h5>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn bg-white" id="openImageModal"
                                                        data-bs-toggle="modal" data-bs-target="#imageModal"
                                                        style="margin: auto 0;">
                                                        <p class="fw-bolder mb-0"><i class="material-icons text-sm"
                                                                style="vertical-align: baseline;">add</i>&nbsp;&nbsp;Add
                                                            Content</p>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id='content'>
                                                <div id='audio_content'
                                                    class="d-flex justify-content-between m-4 p-4 mt-0 mb-5 tables"
                                                    style="background-color: #ffffff; border-radius: 8px;">
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
                                                                @foreach ($edit_background_audios as $edit_background_audio)
                                                                    <tr class="draggable-row">
                                                                        <td class="d-none">
                                                                            {{ $edit_background_audio->content_id }}
                                                                        </td>
                                                                        @if ($edit_background_audio->content_type == "Image")
                                                                            <td> <img
                                                                                    src="{{ asset("contents/images/" . $edit_background_audio->content_name) }}"
                                                                                    class="img-thumbnail" alt="Image"
                                                                                    width="80"></td>
                                                                        @elseif ($edit_background_audio->content_type == "Video")
                                                                            <td> <video
                                                                                    src="{{ asset("contents/videos/" . $edit_background_audio->content_name) }}"
                                                                                    class="img-thumbnail"
                                                                                    alt="Video Thumbnail"
                                                                                    width="80"></td>
                                                                        @elseif ($edit_background_audio->content_type == "Audio")
                                                                            <td> <audio width="80" height="auto"
                                                                                    controls>
                                                                                    <source
                                                                                        src="{{ asset("contents/audios/" . $edit_background_audio->content_name) }}"
                                                                                        type="audio/mpeg">
                                                                                </audio></td>
                                                                        @elseif ($edit_background_audio->content_type == "App")
                                                                            <td>
                                                                                @if ($edit_background_audio->content_name == "Digital Clock 1")
                                                                                    <img src="{{ asset("contents/clock/clock.webp") }}"
                                                                                        class="img-thumbnail"
                                                                                        alt="Digital Clock 1"
                                                                                        width="80">
                                                                                @elseif($edit_background_audio->content_name == "Digital Clock 2")
                                                                                    <img src="{{ asset("contents/clock/clock.webp") }}"
                                                                                        class="img-thumbnail"
                                                                                        alt="Digital Clock 2"
                                                                                        width="80">
                                                                                @elseif($edit_background_audio->content_name == "Digital Clock 3")
                                                                                    <img src="{{ asset("contents/clock/clock.webp") }}"
                                                                                        class="img-thumbnail"
                                                                                        alt="Digital Clock 3"
                                                                                        width="80">
                                                                                @elseif($edit_background_audio->content_name == "Weather")
                                                                                    <img src="{{ asset("contents/clock/weather.jpg") }}"
                                                                                        class="img-thumbnail"
                                                                                        alt="Weather" width="80">
                                                                                @elseif(substr($edit_background_audio->content_name, 0, 7) === "Banner:")
                                                                                    <img src="{{ asset("contents/clock/banner0.png") }}"
                                                                                        class="img-thumbnail"
                                                                                        alt="Banner" width="80">
                                                                                @endif

                                                                            </td>
                                                                        @elseif ($edit_background_audio->content_type == "Link")
                                                                            <td>
                                                                                <div class="link-wrapper">
                                                                                    @php
                                                                                        $content =
                                                                                            $edit_background_audio->content_name;
                                                                                        $fileExtension = strtolower(
                                                                                            pathinfo(
                                                                                                $content,
                                                                                                PATHINFO_EXTENSION,
                                                                                            ),
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
                                                                                        <iframe
                                                                                            src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                                            frameborder="0"
                                                                                            height="80"
                                                                                            width="80"
                                                                                            allow="accelerometer; encrypted-media; gyroscope;"
                                                                                            allowfullscreen></iframe>
                                                                                    @elseif(filter_var($content, FILTER_VALIDATE_URL))
                                                                                        {{-- Attempt to Embed as Iframe or Open in New Tab if Blocked --}}
                                                                                        <iframe
                                                                                            id="iframe-{{ $content }}"
                                                                                            src="{{ $content }}"
                                                                                            frameborder="0"
                                                                                            height="80"
                                                                                            width="80"
                                                                                            style="border: none;"
                                                                                            allowfullscreen
                                                                                            onerror="handleIframeError(this, '{{ $content }}')">
                                                                                        </iframe>
                                                                                    @else
                                                                                        {{-- Default Link --}}
                                                                                        <a href="{{ asset($content) }}"
                                                                                            target="_blank">
                                                                                            <button
                                                                                                class="btn btn-link">View
                                                                                                Link</button>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                        @elseif ($edit_background_audio->content_type == "Playlist")
                                                                            <td>
                                                                                <div class="stacked-card"
                                                                                    style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                                                    @foreach ($edit_background_audio->playlists as $index => $playlist)
                                                                                        @if ($playlist->content_type == "Image")
                                                                                            <div class="preview-container"
                                                                                                style="position: relative;">
                                                                                                <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                                                    alt="{{ $playlist->content }}"
                                                                                                    class="stacked-item"
                                                                                                    style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                                            @elseif($playlist->content_type == "Video")
                                                                                                <div class="preview-container"
                                                                                                    style="position: relative;">
                                                                                                    <video
                                                                                                        src="{{ asset("contents/videos/" . $playlist->content) }}"
                                                                                                        class="stacked-item"
                                                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                                                        muted>
                                                                                                    </video>

                                                                                                </div>
                                                                                            @elseif($playlist->content_type == "Link")
                                                                                                <div class="preview-container"
                                                                                                    style="position: relative;">
                                                                                                    <iframe
                                                                                                        src="{{ $playlist->content }}"
                                                                                                        class="stacked-item"
                                                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                                                    </iframe>

                                                                                                </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                    </div>
                                                    </td>
                                                    @endif
                                                    @if ($edit_background_audio->content_type == "Link")
                                                        <td>
                                                            <a href="{{ $edit_background_audio->content_name }}"
                                                                target="_blank">
                                                                <button
                                                                    class="btn btn-link">{{ $edit_background_audio->content_name }}</button>
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td>{{ $edit_background_audio->content_name }}</td>
                                                    @endif
                                                    <td>{{ $edit_background_audio->content_type }}
                                                    </td>
                                                    @if (
                                                        $edit_background_audio->content_type == "Video" ||
                                                            $edit_background_audio->content_type == "Audio" ||
                                                            $edit_background_audio->content_type == "Playlist")
                                                        <td><input type="text" class="form-control border p-2"
                                                                placeholder="Enter duration"
                                                                value="{{ $edit_background_audio->duration }}"
                                                                disabled></td>
                                                    @else
                                                        <td><input type="text" class="form-control border p-2"
                                                                placeholder="Enter duration"
                                                                value="{{ $edit_background_audio->duration }}"></td>
                                                    @endif

                                                    <td>{{ $edit_background_audio->audio }}</td>
                                                    <td><button type="button"
                                                            class="btn btn-danger btn-sm delete-row">Delete</button>
                                                    </td>

                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id='main_content'
                                                class="d-none justify-content-between m-4 p-4 mt-0 mb-5 tables"
                                                style="background-color: #ffffff; border-radius: 8px;">
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
                                                            @foreach ($edit_mains as $edit_main)
                                                                <tr class="draggable-row">
                                                                    <td class="d-none">{{ $edit_main->content_id }}
                                                                    </td>
                                                                    @if ($edit_main->content_type == "Image")
                                                                        <td> <img
                                                                                src="{{ asset("contents/images/" . $edit_main->content_name) }}"
                                                                                class="img-thumbnail" alt="Image"
                                                                                width="80" height="80"></td>
                                                                        </td>
                                                                    @elseif ($edit_main->content_type == "Video")
                                                                        <td> <video
                                                                                src="{{ asset("contents/videos/" . $edit_main->content_name) }}"
                                                                                class="img-thumbnail"
                                                                                alt="Video Thumbnail" width="80"
                                                                                height="80">
                                                                        </td>
                                                                    @elseif ($edit_main->content_type == "Audio")
                                                                        <td> <audio width="80" height="auto"
                                                                                controls style="width: 80;">
                                                                                <source
                                                                                    src="{{ asset("contents/audios/" . $edit_main->content_name) }}"
                                                                                    type="audio/mpeg">
                                                                            </audio></td>
                                                                    @elseif ($edit_main->content_type == "App")
                                                                        <td>
                                                                            @if ($edit_main->content_name == "Digital Clock 1")
                                                                                <img src="{{ asset("contents/clock/digital-clock-1.png") }}"
                                                                                    class="img-thumbnail"
                                                                                    alt="Digital Clock 1"
                                                                                    width="80" height="80">
                                                                            @elseif ($edit_main->content_name == "Digital Clock 2")
                                                                                <img src="{{ asset("contents/clock/digital-clock-2.png") }}"
                                                                                    class="img-thumbnail"
                                                                                    alt="Digital Clock 2"
                                                                                    width="80" height="80">
                                                                            @elseif ($edit_main->content_name == "Digital Clock 3")
                                                                                <img src="{{ asset("contents/clock/digital-clock-3.png") }}"
                                                                                    class="img-thumbnail"
                                                                                    alt="Digital Clock 3"
                                                                                    width="80">
                                                                            @elseif ($edit_main->content_name == "Weather")
                                                                                <img src="{{ asset("contents/clock/weather.jpg") }}"
                                                                                    class="img-thumbnail"
                                                                                    alt="Weather" width="80"
                                                                                    height="80">
                                                                            @elseif (substr($edit_main->content_name, 0, 7) === "Banner:")
                                                                                <img src="{{ asset("contents/clock/banner0.png") }}"
                                                                                    class="img-thumbnail"
                                                                                    alt="Banner" width="80"
                                                                                    height="80">
                                                                            @endif

                                                                        </td>
                                                                    @elseif ($edit_main->content_type == "Link")
                                                                        <td>
                                                                            <div class="link-wrapper">
                                                                                @php
                                                                                    $content = $edit_main->content_name;
                                                                                    $fileExtension = strtolower(
                                                                                        pathinfo(
                                                                                            $content,
                                                                                            PATHINFO_EXTENSION,
                                                                                        ),
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
                                                                                    <iframe
                                                                                        src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                                        frameborder="0"height="80"
                                                                                        width="80"
                                                                                        allow="accelerometer; encrypted-media; gyroscope;"
                                                                                        allowfullscreen></iframe>
                                                                                @elseif(filter_var($content, FILTER_VALIDATE_URL))
                                                                                    {{-- Attempt to Embed as Iframe or Open in New Tab if Blocked --}}
                                                                                    <iframe
                                                                                        id="iframe-{{ $content }}"
                                                                                        src="{{ $content }}"
                                                                                        frameborder="0" height="80"
                                                                                        width="80"style="border: none;"
                                                                                        allowfullscreen
                                                                                        onerror="handleIframeError(this, '{{ $content }}')">
                                                                                    </iframe>
                                                                                @else
                                                                                    {{-- Default Link --}}
                                                                                    <a href="{{ asset($content) }}"
                                                                                        target="_blank">
                                                                                        <button
                                                                                            class="btn btn-link">View
                                                                                            Link</button>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                    @elseif ($edit_main->content_type == "Playlist")
                                                                        <td>
                                                                            <div class="stacked-card"
                                                                                style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                                                @foreach ($edit_main->playlists as $index => $playlist)
                                                                                    @if ($playlist->content_type == "Image")
                                                                                        {{-- <div class="preview-container" style="position: relative;"> --}}
                                                                                        <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                                            alt="{{ $playlist->content }}"
                                                                                            class="stacked-item"
                                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                                    @elseif($playlist->content_type == "Video")
                                                                                        {{-- <div class="preview-container" style="position: relative;"> --}}
                                                                                        <video
                                                                                            src="{{ asset("contents/videos/" . $playlist->content) }}"
                                                                                            class="stacked-item"
                                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                                            muted>
                                                                                        </video>

                                                                                        {{-- </div> --}}
                                                                                    @elseif($playlist->content_type == "Link")
                                                                                        {{-- <div class="preview-container" style="position: relative;"> --}}
                                                                                        <iframe
                                                                                            src="{{ $playlist->content }}"
                                                                                            class="stacked-item"
                                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                                        </iframe>

                                                                                        {{-- </div> --}}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                </div>
                                                </td>
                                                @endif
                                                @if ($edit_main->content_type == "Link")
                                                    <td>
                                                        <a href="{{ $edit_main->content_name }}" target="_blank">
                                                            <button
                                                                class="btn btn-link">{{ $edit_main->content_name }}</button>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>{{ $edit_main->content_name }}</td>
                                                @endif
                                                <td>{{ $edit_main->content_type }}</td>
                                                @if (
                                                    $edit_main->content_type == "Video" ||
                                                        $edit_main->content_type == "Audio" ||
                                                        $edit_main->content_type == "Playlist")
                                                    <td><input type="text" class="form-control border p-2"
                                                            placeholder="Enter duration"
                                                            value="{{ $edit_main->duration }}" disabled></td>
                                                @else
                                                    <td><input type="text" class="form-control border p-2"
                                                            placeholder="Enter duration"
                                                            value="{{ $edit_main->duration }}"></td>
                                                @endif
                                                <td>{{ $edit_main->audio }}</td>
                                                <td><button type="button"
                                                        class="btn btn-danger btn-sm delete-row">Delete</button>
                                                </td>

                                                </tr>
                                                @endforeach

                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id='custom_layout_main_content'
                                            class="d-none justify-content-between m-4 p-4 mt-0 mb-5 tables"
                                            style="background-color: #ffffff; border-radius: 8px;">
                                            <div id="custom_layout_signage_mediaTable" class="table-responsive">
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
                                                        @foreach ($edit_custom_mains as $edit_custom_main)
                                                            <tr class="draggable-row">
                                                                <td class="d-none">{{ $edit_custom_main->content_id }}
                                                                </td>
                                                                @if ($edit_custom_main->content_type == "Image")
                                                                    <td> <img
                                                                            src="{{ asset("contents/images/" . $edit_custom_main->content_name) }}"
                                                                            class="img-thumbnail" alt="Image"
                                                                            width="80" height="80">
                                                                    </td>
                                                                @elseif ($edit_custom_main->content_type == "Video")
                                                                    <td> <video
                                                                            src="{{ asset("contents/videos/" . $edit_custom_main->content_name) }}"
                                                                            class="img-thumbnail"
                                                                            alt="Video Thumbnail" width="80"></td>
                                                                @elseif ($edit_custom_main->content_type == "Audio")
                                                                    <td> <audio width="80" height="auto" controls
                                                                            style="width:80;">
                                                                            <source
                                                                                src="{{ asset("contents/audios/" . $edit_custom_main->content_name) }}"
                                                                                type="audio/mpeg">
                                                                        </audio></td>
                                                                @elseif ($edit_custom_main->content_type == "App")
                                                                    <td>
                                                                        @if ($edit_custom_main->content_name == "Digital Clock 1")
                                                                            <img src="{{ asset("contents/clock/digital-clock-1.png") }}"
                                                                                class="img-thumbnail"
                                                                                alt="Digital Clock 1" width="80"
                                                                                height="80">
                                                                        @elseif ($edit_custom_main->content_name == "Digital Clock 2")
                                                                            <img src="{{ asset("contents/clock/digital-clock-2.png") }}"
                                                                                class="img-thumbnail"
                                                                                alt="Digital Clock 2" width="80"
                                                                                height="80">
                                                                        @elseif ($edit_custom_main->content_name == "Digital Clock 3")
                                                                            <img src="{{ asset("contents/clock/digital-clock-3.png") }}"
                                                                                class="img-thumbnail"
                                                                                alt="Digital Clock 3" width="80"
                                                                                height="80">
                                                                        @elseif ($edit_custom_main->content_name == "Weather")
                                                                            <img src="{{ asset("contents/clock/weather.jpg") }}"
                                                                                class="img-thumbnail" alt="Weather"
                                                                                width="80">
                                                                        @elseif(substr($edit_custom_main->content_name, 0, 7) === "Banner:")
                                                                            <img src="{{ asset("contents/clock/banner0.png") }}"
                                                                                class="img-thumbnail" alt="Banner"
                                                                                width="80" height="80">
                                                                        @endif

                                                                    </td>
                                                                @elseif ($edit_custom_main->content_type == "Link")
                                                                    <td>
                                                                        <div class="link-wrapper">
                                                                            @php
                                                                                $content =
                                                                                    $edit_custom_main->content_name;
                                                                                $fileExtension = strtolower(
                                                                                    pathinfo(
                                                                                        $content,
                                                                                        PATHINFO_EXTENSION,
                                                                                    ),
                                                                                );

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
                                                                                <iframe
                                                                                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                                    frameborder="0"height="80"
                                                                                    width="80"
                                                                                    allow="accelerometer; encrypted-media; gyroscope;"
                                                                                    allowfullscreen></iframe>
                                                                            @elseif(filter_var($content, FILTER_VALIDATE_URL))
                                                                                <iframe
                                                                                    id="iframe-{{ $content }}"
                                                                                    src="{{ $content }}"
                                                                                    frameborder="0" height="80"
                                                                                    width="80"style="border: none;"
                                                                                    allowfullscreen
                                                                                    onerror="handleIframeError(this, '{{ $content }}')">
                                                                                </iframe>
                                                                            @else
                                                                                <a href="{{ asset($content) }}"
                                                                                    target="_blank">
                                                                                    <button class="btn btn-link">View
                                                                                        Link</button>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                @elseif ($edit_custom_main->content_type == "Playlist")
                                                                    <td>
                                                                        <div class="stacked-card"
                                                                            style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                                            @foreach ($edit_custom_main->playlists as $index => $playlist)
                                                                                @if ($playlist->content_type == "Image")
                                                                                    <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                                        alt="{{ $playlist->content }}"
                                                                                        class="stacked-item"
                                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                                @elseif($playlist->content_type == "Video")
                                                                                    <video
                                                                                        src="{{ asset("contents/videos/" . $playlist->content) }}"
                                                                                        class="stacked-item"
                                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                                        muted>
                                                                                    </video>
                                                                                @elseif($playlist->content_type == "Link")
                                                                                    <iframe
                                                                                        src="{{ $playlist->content }}"
                                                                                        class="stacked-item"
                                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                                    </iframe>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                            </div>
                                            </td>
                                            @endif
                                            @if ($edit_custom_main->content_type == "Link")
                                                <td>
                                                    <a href="{{ $edit_custom_main->content_name }}" target="_blank">
                                                        <button
                                                            class="btn btn-link">{{ $edit_custom_main->content_name }}</button>
                                                    </a>
                                                </td>
                                            @else
                                                <td>{{ $edit_custom_main->content_name }}</td>
                                            @endif
                                            <td>{{ $edit_custom_main->content_type }}</td>
                                            @if (
                                                $edit_custom_main->content_type == "Video" ||
                                                    $edit_custom_main->content_type == "Audio" ||
                                                    $edit_custom_main->content_type == "Playlist")
                                                <td><input type="text" class="form-control border p-2"
                                                        placeholder="Enter duration"
                                                        value="{{ $edit_custom_main->duration }}" disabled></td>
                                            @else
                                                <td><input type="text" class="form-control border p-2"
                                                        placeholder="Enter duration"
                                                        value="{{ $edit_custom_main->duration }}"></td>
                                            @endif
                                            <td>{{ $edit_custom_main->audio }}</td>
                                            <td><button type="button"
                                                    class="btn btn-danger btn-sm delete-row">Delete</button>
                                            </td>

                                            </tr>
                                            @endforeach

                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id='custom_layout_clock_content'
                                        class="d-none justify-content-between m-4 p-4 mt-0 mb-5 tables"
                                        style="background-color: #ffffff; border-radius: 8px;">
                                        <div id="custom_layout_clock_mediaTable" class="table-responsive">
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
                                                    @foreach ($edit_custom_clocks as $edit_custom_clock)
                                                        <tr class="draggable-row">
                                                            <td class="d-none">{{ $edit_custom_clock->content_id }}
                                                            </td>
                                                            @if ($edit_custom_clock->content_type == "Image")
                                                                <td> <img
                                                                        src="{{ asset("contents/images/" . $edit_custom_clock->content_name) }}"
                                                                        class="img-thumbnail" alt="Image"
                                                                        width="80" height="80">
                                                                </td>
                                                            @elseif ($edit_custom_clock->content_type == "Video")
                                                                <td> <video
                                                                        src="{{ asset("contents/videos/" . $edit_custom_clock->content_name) }}"
                                                                        class="img-thumbnail" alt="Video Thumbnail"
                                                                        width="80" height="80"></td>
                                                            @elseif ($edit_custom_clock->content_type == "Audio")
                                                                <td> <audio width="80" height="auto" controls
                                                                        style="width: 80;" height="80">
                                                                        <source
                                                                            src="{{ asset("contents/audios/" . $edit_custom_clock->content_name) }}"
                                                                            type="audio/mpeg">
                                                                    </audio></td>
                                                            @elseif ($edit_custom_clock->content_type == "App")
                                                                <td>
                                                                    @if ($edit_custom_clock->content_name == "Digital Clock 1")
                                                                        <img src="{{ asset("contents/clock/digital-clock-1.webp") }}"
                                                                            class="img-thumbnail"
                                                                            alt="Digital Clock 1" width="80"
                                                                            height="80">
                                                                    @elseif ($edit_custom_clock->content_name == "Digital Clock 2")
                                                                        <img src="{{ asset("contents/clock/digital-clock-2.webp") }}"
                                                                            class="img-thumbnail"
                                                                            alt="Digital Clock 2"
                                                                            width="80"height="80">
                                                                    @elseif ($edit_custom_clock->content_name == "Digital Clock 3")
                                                                        <img src="{{ asset("contents/clock/digital-clock-3.webp") }}"
                                                                            class="img-thumbnail"
                                                                            alt="Digital Clock 3" width="80"
                                                                            height="80">
                                                                    @elseif ($edit_custom_clock->content_name == "Weather")
                                                                        <img src="{{ asset("contents/clock/weather.jpg") }}"
                                                                            class="img-thumbnail" alt="Weather"
                                                                            width="80">
                                                                    @elseif (substr($edit_custom_clock->content_name, 0, 7) === "Banner:")
                                                                        <img src="{{ asset("contents/clock/banner0.png") }}"
                                                                            class="img-thumbnail" alt="Banner"
                                                                            width="80" height="80">
                                                                    @endif

                                                                </td>
                                                            @elseif ($edit_custom_clock->content_type == "Link")
                                                                <td>
                                                                    <div class="link-wrapper">
                                                                        @php
                                                                            $content = $edit_custom_clock->content_name;
                                                                            $fileExtension = strtolower(
                                                                                pathinfo($content, PATHINFO_EXTENSION),
                                                                            );

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
                                                                            <iframe
                                                                                src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                                frameborder="0"height="80"
                                                                                width="80"
                                                                                allow="accelerometer; encrypted-media; gyroscope;"
                                                                                allowfullscreen></iframe>
                                                                        @elseif(filter_var($content, FILTER_VALIDATE_URL))
                                                                            <iframe id="iframe-{{ $content }}"
                                                                                src="{{ $content }}"
                                                                                frameborder="0" height="80"
                                                                                width="80"style="border: none;"
                                                                                allowfullscreen
                                                                                onerror="handleIframeError(this, '{{ $content }}')">
                                                                            </iframe>
                                                                        @else
                                                                            <a href="{{ asset($content) }}"
                                                                                target="_blank">
                                                                                <button class="btn btn-link">View
                                                                                    Link</button>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            @elseif ($edit_custom_clock->content_type == "Playlist")
                                                                <td>
                                                                    <div class="stacked-card"
                                                                        style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                                        @foreach ($edit_custom_clock->playlists as $index => $playlist)
                                                                            @if ($playlist->content_type == "Image")
                                                                                <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                                    alt="{{ $playlist->content }}"
                                                                                    class="stacked-item"
                                                                                    style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                            @elseif ($playlist->content_type == "Video")
                                                                                <video
                                                                                    src="{{ asset("contents/videos/" . $playlist->content) }}"
                                                                                    class="stacked-item"
                                                                                    style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                                    muted>
                                                                                </video>
                                                                            @elseif ($playlist->content_type == "Link")
                                                                                <iframe
                                                                                    src="{{ $playlist->content }}"
                                                                                    class="stacked-item"
                                                                                    style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                                </iframe>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                        </div>
                                        </td>
                                        @endif
                                        @if ($edit_custom_clock->content_type == "Link")
                                            <td>
                                                <a href="{{ $edit_custom_clock->content_name }}" target="_blank">
                                                    <button
                                                        class="btn btn-link">{{ $edit_custom_clock->content_name }}</button>
                                                </a>
                                            </td>
                                        @else
                                            <td>{{ $edit_custom_clock->content_name }}</td>
                                        @endif
                                        <td>{{ $edit_custom_clock->content_type }}</td>
                                        @if (
                                            $edit_custom_clock->content_type == "Video" ||
                                                $edit_custom_clock->content_type == "Audio" ||
                                                $edit_custom_clock->content_type == "Playlist")
                                            <td><input type="text" class="form-control border p-2"
                                                    placeholder="Enter duration"
                                                    value="{{ $edit_custom_clock->duration }}" disabled></td>
                                        @else
                                            <td><input type="text" class="form-control border p-2"
                                                    placeholder="Enter duration"
                                                    value="{{ $edit_custom_clock->duration }}"></td>
                                        @endif
                                        <td>{{ $edit_custom_clock->audio }}</td>
                                        <td><button type="button"
                                                class="btn btn-danger btn-sm delete-row">Delete</button>
                                        </td>

                                        </tr>
                                        @endforeach

                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id='custom_layout_weather_content'
                                    class="d-none justify-content-between m-4 p-4 mt-0 mb-5 tables"
                                    style="background-color: #ffffff; border-radius: 8px;">
                                    <div id="custom_layout_weather_mediaTable" class="table-responsive">
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
                                                @foreach ($edit_custom_weathers as $edit_custom_weather)
                                                    <tr class="draggable-row">
                                                        <td class="d-none">{{ $edit_custom_weather->content_id }}
                                                        </td>
                                                        @if ($edit_custom_weather->content_type == "Image")
                                                            <td> <img
                                                                    src="{{ asset("contents/images/" . $edit_custom_weather->content_name) }}"
                                                                    class="img-thumbnail" alt="Image"
                                                                    width="80" height="80">
                                                            </td>
                                                        @elseif ($edit_custom_weather->content_type == "Video")
                                                            <td> <video
                                                                    src="{{ asset("contents/videos/" . $edit_custom_weather->content_name) }}"
                                                                    class="img-thumbnail" alt="Video Thumbnail"
                                                                    width="80" height="80"></td>
                                                        @elseif ($edit_custom_weather->content_type == "Audio")
                                                            <td> <audio width="80" height="auto" controls
                                                                    style="width: 80;">
                                                                    <source
                                                                        src="{{ asset("contents/audios/" . $edit_custom_weather->content_name) }}"
                                                                        type="audio/mpeg">
                                                                </audio></td>
                                                        @elseif ($edit_custom_weather->content_type == "App")
                                                            <td>
                                                                @if ($edit_custom_weather->content_name == "Digital Clock 1")
                                                                    <img src="{{ asset("contents/clock/digital-clock-1.png") }}"
                                                                        class="img-thumbnail" alt="Digital Clock 1"
                                                                        width="80" height="80">
                                                                @elseif ($edit_custom_weather->content_name == "Digital Clock 2")
                                                                    <img src="{{ asset("contents/clock/digital-clock-2.png") }}"
                                                                        class="img-thumbnail" alt="Digital Clock 2"
                                                                        width="80">
                                                                @elseif ($edit_custom_weather->content_name == "Digital Clock 3")
                                                                    <img src="{{ asset("contents/clock/digital-clock-3.png") }}"
                                                                        class="img-thumbnail" alt="Digital Clock 3"
                                                                        width="80">
                                                                @elseif ($edit_custom_weather->content_name == "Weather")
                                                                    <img src="{{ asset("contents/clock/weather.jpg") }}"
                                                                        class="img-thumbnail" alt="Weather"
                                                                        width="80">
                                                                @elseif (substr($edit_custom_weather->content_name, 0, 7) === "Banner:")
                                                                    <img src="{{ asset("contents/clock/banner0.png") }}"
                                                                        class="img-thumbnail" alt="Banner"
                                                                        width="80">
                                                                @endif

                                                            </td>
                                                        @elseif ($edit_custom_weather->content_type == "Link")
                                                            <td>
                                                                <div class="link-wrapper">
                                                                    @php
                                                                        $content = $edit_custom_weather->content_name;
                                                                        $fileExtension = strtolower(
                                                                            pathinfo($content, PATHINFO_EXTENSION),
                                                                        );

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
                                                                        <iframe
                                                                            src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                            frameborder="0"height="80" width="80"
                                                                            allow="accelerometer; encrypted-media; gyroscope;"
                                                                            allowfullscreen></iframe>
                                                                    @elseif(filter_var($content, FILTER_VALIDATE_URL))
                                                                        <iframe id="iframe-{{ $content }}"
                                                                            src="{{ $content }}"
                                                                            frameborder="0" height="80"
                                                                            width="80"style="border: none;"
                                                                            allowfullscreen
                                                                            onerror="handleIframeError(this, '{{ $content }}')">
                                                                        </iframe>
                                                                    @else
                                                                        <a href="{{ asset($content) }}"
                                                                            target="_blank">
                                                                            <button class="btn btn-link">View
                                                                                Link</button>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        @elseif ($edit_custom_weather->content_type == "Playlist")
                                                            <td>
                                                                <div class="stacked-card"
                                                                    style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                                    @foreach ($edit_custom_weather->playlists as $index => $playlist)
                                                                        @if ($playlist->content_type == "Image")
                                                                            <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                                alt="{{ $playlist->content }}"
                                                                                class="stacked-item"
                                                                                style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                        @elseif ($playlist->content_type == "Video")
                                                                            <video
                                                                                src="{{ asset("contents/videos/" . $playlist->content) }}"
                                                                                class="stacked-item"
                                                                                style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                                muted>
                                                                            </video>
                                                                        @elseif ($playlist->content_type == "Link")
                                                                            <iframe src="{{ $playlist->content }}"
                                                                                class="stacked-item"
                                                                                style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                            </iframe>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                    </div>
                                    </td>
                                    @endif
                                    @if ($edit_custom_weather->content_type == "Link")
                                        <td>
                                            <a href="{{ $edit_custom_weather->content_name }}" target="_blank">
                                                <button
                                                    class="btn btn-link">{{ $edit_custom_weather->content_name }}</button>
                                            </a>
                                        </td>
                                    @else
                                        <td>{{ $edit_custom_weather->content_name }}</td>
                                    @endif
                                    <td>{{ $edit_custom_weather->content_type }}</td>
                                    @if (
                                        $edit_custom_weather->content_type == "Video" ||
                                            $edit_custom_weather->content_type == "Audio" ||
                                            $edit_custom_weather->content_type == "Playlist")
                                        <td><input type="text" class="form-control border p-2"
                                                placeholder="Enter duration"
                                                value="{{ $edit_custom_weather->duration }}" disabled></td>
                                    @else
                                        <td><input type="text" class="form-control border p-2"
                                                placeholder="Enter duration"
                                                value="{{ $edit_custom_weather->duration }}"></td>
                                    @endif
                                    <td>{{ $edit_custom_weather->audio }}</td>
                                    <td><button type="button"
                                            class="btn btn-danger btn-sm delete-row">Delete</button>
                                    </td>

                                    </tr>
                                    @endforeach

                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id='custom_layout_banner_content'
                                class="d-none justify-content-between m-4 p-4 mt-0 mb-5 tables"
                                style="background-color: #ffffff; border-radius: 8px;">
                                <div id="custom_layout_banner_mediaTable" class="table-responsive">
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
                                            @foreach ($edit_custom_banners as $edit_custom_banner)
                                                <tr class="draggable-row">
                                                    <td class="d-none">{{ $edit_custom_banner->content_id }}</td>
                                                    @if ($edit_custom_banner->content_type == "Image")
                                                        <td> <img
                                                                src="{{ asset("contents/images/" . $edit_custom_banner->content_name) }}"
                                                                class="img-thumbnail" alt="Image" width="80"
                                                                height="80">
                                                        </td>
                                                    @elseif ($edit_custom_banner->content_type == "Video")
                                                        <td> <video
                                                                src="{{ asset("contents/videos/" . $edit_custom_banner->content_name) }}"
                                                                class="img-thumbnail" alt="Video Thumbnail"
                                                                width="80"height="80" height="80"></td>
                                                    @elseif ($edit_custom_banner->content_type == "Audio")
                                                        <td> <audio width="80" height="auto" controls
                                                                style="width: 80;">
                                                                <source
                                                                    src="{{ asset("contents/audios/" . $edit_custom_banner->content_name) }}"
                                                                    type="audio/mpeg">
                                                            </audio></td>
                                                    @elseif ($edit_custom_banner->content_type == "App")
                                                        <td>
                                                            @if ($edit_custom_banner->content_name == "Digital Clock 1")
                                                                <img src="{{ asset("contents/clock/digital-clock-1.png") }}"
                                                                    class="img-thumbnail" alt="Digital Clock 1"
                                                                    width="80" height="80">
                                                            @elseif ($edit_custom_banner->content_name == "Digital Clock 2")
                                                                <img src="{{ asset("contents/clock/digital-clock-2.png") }}"
                                                                    class="img-thumbnail" alt="Digital Clock 2"
                                                                    width="80" height="80">
                                                            @elseif ($edit_custom_banner->content_name == "Digital Clock 3")
                                                                <img src="{{ asset("contents/clock/digital-clock-3.png") }}"
                                                                    class="img-thumbnail" alt="Digital Clock 3"
                                                                    width="80" height="80">
                                                            @elseif ($edit_custom_banner->content_name == "Weather")
                                                                <img src="{{ asset("contents/clock/weather.jpg") }}"
                                                                    class="img-thumbnail" alt="Weather"
                                                                    width="80" height="80">
                                                            @elseif (substr($edit_custom_banner->content_name, 0, 7) === "Banner:")
                                                                <img src="{{ asset("contents/clock/banner0.png") }}"
                                                                    class="img-thumbnail" alt="Banner"
                                                                    width="80" height="80">
                                                            @endif

                                                        </td>
                                                    @elseif ($edit_custom_banner->content_type == "Link")
                                                        <td>
                                                            <div class="link-wrapper">
                                                                @php
                                                                    $content = $edit_custom_banner->content_name;
                                                                    $fileExtension = strtolower(
                                                                        pathinfo($content, PATHINFO_EXTENSION),
                                                                    );

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
                                                                    <iframe
                                                                        src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                        frameborder="0"height="80" width="80"
                                                                        allow="accelerometer; encrypted-media; gyroscope;"
                                                                        allowfullscreen></iframe>
                                                                @elseif(filter_var($content, FILTER_VALIDATE_URL))
                                                                    <iframe id="iframe-{{ $content }}"
                                                                        src="{{ $content }}" frameborder="0"
                                                                        height="80"
                                                                        width="80"style="border: none;"
                                                                        allowfullscreen
                                                                        onerror="handleIframeError(this, '{{ $content }}')">
                                                                    </iframe>
                                                                @else
                                                                    <a href="{{ asset($content) }}" target="_blank">
                                                                        <button class="btn btn-link">View
                                                                            Link</button>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    @elseif ($edit_custom_banner->content_type == "Playlist")
                                                        <td>
                                                            <div class="stacked-card"
                                                                style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                                @foreach ($edit_custom_banner->playlists as $index => $playlist)
                                                                    @if ($playlist->content_type == "Image")
                                                                        <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                            alt="{{ $playlist->content }}"
                                                                            class="stacked-item"
                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                    @elseif ($playlist->content_type == "Video")
                                                                        <video
                                                                            src="{{ asset("contents/videos/" . $playlist->content) }}"
                                                                            class="stacked-item"
                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                            muted>
                                                                        </video>
                                                                    @elseif ($playlist->content_type == "Link")
                                                                        <iframe src="{{ $playlist->content }}"
                                                                            class="stacked-item"
                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                        </iframe>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                </div>
                                </td>
                                @endif
                                @if ($edit_custom_banner->content_type == "Link")
                                    <td>
                                        <a href="{{ $edit_custom_banner->content_name }}" target="_blank">
                                            <button
                                                class="btn btn-link">{{ $edit_custom_banner->content_name }}</button>
                                        </a>
                                    </td>
                                @else
                                    <td>{{ $edit_custom_banner->content_name }}</td>
                                @endif
                                <td>{{ $edit_custom_banner->content_type }}</td>
                                @if (
                                    $edit_custom_banner->content_type == "Video" ||
                                        $edit_custom_banner->content_type == "Audio" ||
                                        $edit_custom_banner->content_type == "Playlist")
                                    <td><input type="text" class="form-control border p-2"
                                            placeholder="Enter duration" value="{{ $edit_custom_banner->duration }}"
                                            disabled></td>
                                @else
                                    <td><input type="text" class="form-control border p-2"
                                            placeholder="Enter duration"
                                            value="{{ $edit_custom_banner->duration }}"></td>
                                @endif
                                <td>{{ $edit_custom_banner->audio }}</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button>
                                </td>

                                </tr>
                                @endforeach

                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div id='background_content' class="d-none justify-content-between m-4 p-4 mt-0 mb-5 tables"
                            style="background-color: #ffffff; border-radius: 8px;">
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
                                        @foreach ($edit_backgrounds as $edit_background)
                                            <tr class="draggable-row">
                                                <td class="d-none">{{ $edit_background->content_id }}</td>
                                                @if ($edit_background->content_type == "Image")
                                                    <td> <img
                                                            src="{{ asset("contents/images/" . $edit_background->content_name) }}"
                                                            class="img-thumbnail" alt="Image" width="80"
                                                            height="80">
                                                    </td>
                                                @elseif ($edit_background->content_type == "Video")
                                                    <td> <video
                                                            src="{{ asset("contents/videos/" . $edit_background->content_name) }}"
                                                            class="img-thumbnail" alt="Video Thumbnail"
                                                            width="80" height="80"></td>
                                                @elseif ($edit_background->content_type == "Audio")
                                                    <td> <audio width="80" height="auto" controls
                                                            style="width: 15ch;">
                                                            <source
                                                                src="{{ asset("contents/audios/" . $edit_background->content_name) }}"
                                                                type="audio/mpeg">
                                                        </audio></td>
                                                @elseif ($edit_background->content_type == "Link")
                                                    <td>
                                                        <div class="link-wrapper">
                                                            @php
                                                                $content = $edit_background->content_name;
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
                                                                <iframe
                                                                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                    frameborder="0"
                                                                    allow="accelerometer; encrypted-media; gyroscope;"
                                                                    allowfullscreen></iframe>
                                                            @elseif(filter_var($content, FILTER_VALIDATE_URL))
                                                                {{-- Attempt to Embed as Iframe or Open in New Tab if Blocked --}}
                                                                <iframe id="iframe-{{ $content }}"
                                                                    src="{{ $content }}" frameborder="0"
                                                                    style="border: none;" allowfullscreen
                                                                    onerror="handleIframeError(this, '{{ $content }}')">
                                                                </iframe>
                                                            @else
                                                                {{-- Default Link --}}
                                                                <a href="{{ asset($content) }}" target="_blank">
                                                                    <button class="btn btn-link">View
                                                                        Link</button>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @elseif ($edit_background->content_type == "Playlist")
                                                    <td>
                                                        <div class="stacked-container"
                                                            style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                            @foreach ($edit_background->playlists as $index => $playlist)
                                                                @if ($playlist->content_type == "Image")
                                                                    <div class="preview-container"
                                                                        style="position: relative;">
                                                                        <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                            alt="{{ $playlist->content }}"
                                                                            class="stacked-item"
                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                        <div class="hover-preview"
                                                                            style="position: absolute; top: 0; left: 0; transform: translate(-50%, -50%); display: none;">
                                                                            <img src="{{ asset("contents/images/" . $playlist->content) }}"
                                                                                alt="{{ $playlist->content }}"
                                                                                style="width: 80px; height: auto; border-radius: 8px;">
                                                                        </div>
                                                                    </div>
                                                                @elseif ($playlist->content_type == "Video")
                                                                    <div class="preview-container"
                                                                        style="position: relative;">
                                                                        <video
                                                                            src="{{ asset("contents/videos/" . $playlist->content) }}"
                                                                            class="stacked-item"
                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                            muted>
                                                                        </video>

                                                                    </div>
                                                                @elseif ($playlist->content_type == "Link")
                                                                    <div class="preview-container"
                                                                        style="position: relative;">
                                                                        <iframe src="{{ $playlist->content }}"
                                                                            class="stacked-item"
                                                                            style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                        </iframe>

                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                        </div>
                                                    </td>
                                                @endif
                                                @if ($edit_background->content_type == "Link")
                                                    <td>
                                                        <a href="{{ $edit_background->content_name }}"
                                                            target="_blank">

                                                            <button
                                                                class="btn btn-link">{{ $edit_background->content_name }}</button>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>{{ $edit_background->content_name }}</td>
                                                @endif
                                                <td>{{ $edit_background->content_type }}</td>
                                                @if (
                                                    $edit_background->content_type == "Video" ||
                                                        $edit_background->content_type == "Audio" ||
                                                        $edit_background->content_type == "Playlist")
                                                    <td><input type="text" class="form-control border p-2"
                                                            placeholder="Enter duration"
                                                            value="{{ $edit_background->duration }}" disabled></td>
                                                @else
                                                    <td><input type="text" class="form-control border p-2"
                                                            placeholder="Enter duration"
                                                            value="{{ $edit_background->duration }}"></td>
                                                @endif
                                                <td>{{ $edit_background->audio }}</td>
                                                <td><button type="button"
                                                        class="btn btn-danger btn-sm delete-row">Delete</button>
                                                </td>

                                            </tr>
                                        @endforeach
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
                            <div class="orientation" id="zone"
                                data-layout_type="{{ $template->template_type }}"
                                data-layout_name="{{ $template->template_layout }}">
                            </div>
                        </div>
                        <div class="">
                            <label class="form-label m-2 p-2 fs-6 text-white" id="background_audio"
                                style="background-color: #000000; border-radius: 20px; width: 90%;">Background
                                Audio</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <x-footers.auth></x-footers.auth>
        </div>

        {{-- Content --}}
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Select Media</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="height: 60vh; overflow-y: auto;">
                        <div class="row">
                            <!-- Vertical Tabs Navigation -->
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills" id="mediaTab" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-link active" id="playlists-tab" data-bs-toggle="pill"
                                        data-bs-target="#playlists" type="button" role="tab"
                                        aria-controls="playlists" aria-selected="true">Playlists</button>
                                    <button class="nav-link" id="images-tab" data-bs-toggle="pill"
                                        data-bs-target="#images" type="button" role="tab"
                                        aria-controls="images" aria-selected="true">Images</button>
                                    <button class="nav-link" id="videos-tab" data-bs-toggle="pill"
                                        data-bs-target="#videos" type="button" role="tab"
                                        aria-controls="videos" aria-selected="false">Videos</button>
                                    <button class="nav-link" id="audios-tab" data-bs-toggle="pill"
                                        data-bs-target="#audios" type="button" role="tab"
                                        aria-controls="audios" aria-selected="false">Audios</button>
                                    <button class="nav-link" id="links-tab" data-bs-toggle="pill"
                                        data-bs-target="#links" type="button" role="tab" aria-controls="links"
                                        aria-selected="false">Links</button>
                                    <button class="nav-link" id="apps-tab" data-bs-toggle="pill"
                                        data-bs-target="#apps" type="button" role="tab" aria-controls="apps"
                                        aria-selected="false">Apps</button>
                                </div>
                            </div>
                            <!-- Tab Content Area -->
                            <div class="col-md-9">
                                <div class="tab-content" id="mediaTabContent">
                                    <!-- Playlists Tab Pane -->
                                    <div class="tab-pane fade show active" id="playlists" role="tabpanel"
                                        aria-labelledby="playlists-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @foreach ($playlists as $playlist)
                                                    <tr>
                                                        <!-- Stacked Content Column -->
                                                        <td class="d-none">{{ $playlist->id }} </td>
                                                        <td class="py-3">
                                                            <div class="stacked-container"
                                                                style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                                @php
                                                                    $contents = explode(",", $playlist->contents);
                                                                    $contentTypes = explode(
                                                                        ",",
                                                                        $playlist->content_types,
                                                                    );
                                                                @endphp

                                                                @foreach ($contents as $index => $content)
                                                                    @if ($contentTypes[$index] == "Image")
                                                                        <div class="preview-container"
                                                                            style="position: relative;">
                                                                            <img src="{{ asset("contents/images/" . $content) }}"
                                                                                alt="{{ $content }}"
                                                                                class="stacked-item"
                                                                                style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                            <div class="hover-preview"
                                                                                style="position: absolute; top: 0; left: 0; transform: translate(-50%, -50%); display: none;">
                                                                                <img src="{{ asset("contents/images/" . $content) }}"
                                                                                    alt="{{ $content }}"
                                                                                    style="width: 80px; height: auto; border-radius: 8px;">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($contentTypes[$index] == "Video")
                                                                        <div class="preview-container"
                                                                            style="position: relative;">
                                                                            <video
                                                                                src="{{ asset("contents/videos/" . $content) }}"
                                                                                class="stacked-item"
                                                                                style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;"
                                                                                muted>
                                                                            </video>
                                                                            <div class="hover-preview"
                                                                                style="position: absolute; top: 0; left: 0; transform: translate(-50%, -50%); display: none;">
                                                                                <video
                                                                                    src="{{ asset("contents/videos/" . $content) }}"
                                                                                    style="width: 80px; height: auto; border-radius: 8px;"
                                                                                    autoplay muted loop>
                                                                                </video>
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($contentTypes[$index] == "Link")
                                                                        <div class="preview-container"
                                                                            style="position: relative;">
                                                                            <iframe src="{{ $content }}"
                                                                                class="stacked-item"
                                                                                style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                            </iframe>
                                                                            <div class="hover-preview"
                                                                                style="position: absolute; top: 0; left: 0; transform: translate(-50%, -50%); display: none;">
                                                                                <iframe src="{{ $content }}"
                                                                                    style="width: 200px; height: 80px; border-radius: 8px; pointer-events: none;">
                                                                                </iframe>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </td>

                                                        <!-- Playlist Name Column -->
                                                        <td>{{ $playlist->playlist_name }}</td>

                                                        <!-- Mute/Unmute Column -->
                                                        <td>
                                                            @if ($playlist->mute == "true")
                                                                Mute
                                                            @else
                                                                Unmute
                                                            @endif
                                                        </td>

                                                        <!-- Total Duration Column -->
                                                        <td>{{ $playlist->total_duration }} Seconds</td>

                                                        <!-- Hidden Data Column -->
                                                        <td class="d-none">{{ $playlist }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    <!-- Images Tab Pane -->
                                    <div class="tab-pane fade" id="images" role="tabpanel"
                                        aria-labelledby="images-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @foreach ($imageLists as $imageList)
                                                    <tr>
                                                        <td class="d-none">{{ $imageList->id }} </td>

                                                        <td>
                                                            <img src="{{ asset("contents/images/{$imageList->content}") }}"
                                                                class="img-thumbnail" alt="Image"
                                                                width="80"hieght="80">
                                                        </td>
                                                        <td>{{ $imageList->content }}</td>
                                                        {{-- <td>{{ $imageList->content_type }}</td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Videos Tab Pane -->
                                    <div class="tab-pane fade" id="videos" role="tabpanel"
                                        aria-labelledby="videos-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @if (!is_null($videoLists))
                                                    @foreach ($videoLists as $videoList)
                                                        <tr>
                                                            <td class="d-none">{{ $videoList->id }} </td>

                                                            <td>
                                                                <video width="80" height="80" controls>
                                                                    <source
                                                                        src="{{ asset("contents/videos/" . $videoList->content) }}"
                                                                        type="video/mp4">
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
                                    <div class="tab-pane fade" id="audios" role="tabpanel"
                                        aria-labelledby="audios-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @if (!is_null($audioLists))
                                                    @foreach ($audioLists as $audioList)
                                                        <tr>
                                                            <td class="d-none">{{ $audioList->id }} </td>
                                                            <td>
                                                                <audio width="80" height="80" controls
                                                                    style="width: 80;">
                                                                    <source
                                                                        src="{{ asset("contents/audios/" . $audioList->content) }}"
                                                                        type="audio/mpeg">
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
                                    <div class="tab-pane fade" id="links" role="tabpanel"
                                        aria-labelledby="links-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                @if (!is_null($linkLists))
                                                    @foreach ($linkLists as $linkList)
                                                        <tr>
                                                            <td class="d-none">{{ $linkList->id }} </td>
                                                            <td>
                                                                <div class="link-wrapper">
                                                                    @php
                                                                        $content = $linkList->content;
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
                                                                        <iframe
                                                                            src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                            frameborder="0"
                                                                            allow="accelerometer; encrypted-media; gyroscope;"style="height:80px; width:80px;"
                                                                            allowfullscreen></iframe>
                                                                    @elseif (filter_var($content, FILTER_VALIDATE_URL))
                                                                        {{-- Attempt to Embed as Iframe or Open in New Tab if Blocked --}}
                                                                        <iframe id="iframe-{{ $content }}"
                                                                            src="{{ $content }}"
                                                                            frameborder="0"
                                                                            style="border: none;height:80px; width:80px;"
                                                                            allowfullscreen
                                                                            onerror="handleIframeError(this, '{{ $content }}')">
                                                                        </iframe>
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
                                                                <a href="{{ $linkList->content }}" target="_blank">
                                                                    <button
                                                                        class="btn btn-link">{{ $linkList->content }}</button>
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
                                    <div class="tab-pane fade" id="apps" role="tabpanel"
                                        aria-labelledby="apps-tab">
                                        <table class="table ">
                                            <tbody style="text-align: center; vertical-align: middle;">
                                                {{-- @if (!is_null($linkLists)) --}}
                                                <tr>
                                                    <td class="d-none">1</td>
                                                    <td width= "30% ">
                                                        <div style="height:100px; width: 180px">
                                                            @include("components.clock1")
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Digital Clock 1
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-none">2</td>
                                                    <td>
                                                        <div style="height:100px; width: 180px">

                                                            @include("components.clock2")
                                                        </div>

                                                    </td>
                                                    <td>
                                                        Digital Clock 2
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="d-none">4</td>
                                                    <td>
                                                        <img src="{{ asset("contents/clock/weather.jpg") }}"
                                                            class="img-thumbnail" alt="Image"
                                                            width="80"hieght="80">
                                                    </td>
                                                    <td>
                                                        Weather
                                                    </td>
                                                </tr>
                                                @foreach ($banners as $banner)
                                                    <tr>
                                                        <td class="d-none">{{ $banner->id }}</td>
                                                        <td>
                                                            <div style="height:100px; width: 180px">
                                                                @include("components.moving-banner", [
                                                                    "banner" => $banner->content,
                                                                ])
                                                            </div>
                                                        </td>
                                                        <td>
                                                            Banner
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                {{-- @else
                                                <tr>
                                                    <td colspan="3" class="text-center">No links found.</td>
                                                </tr>
                                                @endif --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            id="saveMedia">Select</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-plugins></x-plugins>
    @push("js")
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

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
                } else if (layout_type == 'Landscape' && layout_name == '4 Zones Layout') {

                    $('#zone').addClass('landscape-custom-layout');
                    $('#zone').append('<div class="custom-layout-signage"></div>');
                    $('#zone').append('<div class="custom-layout-banner"></div>');
                    $('#zone').append('<div class="custom-layout-clock"></div>');
                    $('#zone').append('<div class="custom-layout-weather"></div>');

                    $('#option').prepend('<option value="custom_layout_weather"> Vertically Rigt Zone</option>');
                    $('#option').prepend('<option value="custom_layout_clock">Fotter Right Zone</option>');
                    $('#option').prepend('<option value="custom_layout_banner">Footer Zone</option>');
                    $('#option').prepend('<option value="custom_layout_signage">Main Zone</option>');

                }

                // CSS
                $(document).ready(function() {
                    $('.layout').css({
                        'margin': '0 auto',
                    });

                    $('.landscape-full-screen').css({
                        'width': '100%',
                        'height': '100%',
                        'top': '0px',
                        'left': '0px',
                        'z-index': '10',
                        'overflow': 'hidden',
                        'background-color': '#a09d9d',
                        'height': '100px',
                        'margin': '0 auto',
                        'border-radius': '8px'
                    });

                    $('.landscape-full-screen-with-background').css({
                        width: '100%',
                        height: '100%',
                        background: 'rgb(100, 94, 94)',
                        'z-index': 1,
                        'height': '100px',
                        'position': 'relative',
                        'margin': '0 auto',
                        'border-radius': '8px'
                    });
                    $('.landscape-full-screen-with-background-zone-1').css({
                        width: '85%',
                        height: '85%',
                        top: '8%',
                        left: '8%',
                        'z-index': 3,
                        position: 'absolute',
                        'border-radius': '4px',
                        overflow: 'hidden',
                        'background-color': '#a09d9d',
                        'box-shadow': 'rgba(0, 0, 0, 0.4) 0px 0px 30px'
                    });

                    $('.portrait-full-screen').css({
                        'width': '100%',
                        'height': '100%',
                        'top': '0px',
                        'left': '0px',
                        'z-index': '10',
                        'overflow': 'hidden',
                        'background-color': '#a09d9d',
                        'height': '100px',
                        'width': '70px',
                        'margin': '0 auto',
                        'border-radius': '8px'
                    });

                    $('.portrait-full-screen-with-background').css({
                        width: '100%',
                        height: '100%',
                        background: 'rgb(100, 94, 94)',
                        'z-index': 1,
                        'height': '100px',
                        'position': 'relative',
                        'height': '100px',
                        'width': '70px',
                        'margin': '0 auto',
                        'border-radius': '8px'
                    });
                    $('.portrait-full-screen-with-background-zone-1').css({
                        width: '85%',
                        height: '85%',
                        top: '8%',
                        left: '8%',
                        'z-index': 3,
                        position: 'absolute',
                        'border-radius': '4px',
                        overflow: 'hidden',
                        'background-color': '#a09d9d',
                        'box-shadow': 'rgba(0, 0, 0, 0.4) 0px 0px 30px'
                    });
                    $('.landscape-custom-layout').css({
                        'width': '100%',
                        'height': '100%',
                        'top': '0px',
                        'left': '0px',
                        'z-index': '10',
                        'position': 'relative',
                        'overflow': 'hidden',
                        'background-color': '#a09d9d',
                        'height': '100px',
                        'margin': '0 auto',
                        'border-radius': '8px',
                    });

                    $('.custom-layout-signage').css({
                        width: '70%',
                        height: '70%',
                        position: 'relative',
                        top: '0',
                        left: '0',
                        'background-color': '#e0e0e0',
                        // 'border-radius': '4px',
                    });

                    $('.custom-layout-banner').css({
                        width: '70%',
                        height: '30%',
                        position: 'absolute',
                        bottom: '0',
                        left: '0',
                        'background-color': '#c0c0c0',
                        // 'border-radius': '4px',
                    });

                    $('.custom-layout-clock').css({
                        width: '30%',
                        height: '30%',
                        position: 'absolute',
                        bottom: '0',
                        right: '0',
                        'background-color': '#a0a0a0',
                        // 'border-radius': '4px',
                    });

                    $('.custom-layout-weather').css({
                        width: '30%',
                        height: '70%',
                        position: 'absolute',
                        top: '0',
                        right: '0',
                        'background-color': '#b0b0b0',
                        // 'border-radius': '4px',
                    });
                });
            });

            $("#edit_template_name").hover(
                function() {
                    $('#edit_template_name_icon').removeAttr('hidden');
                },
                function() {
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
                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');
                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');

                    $('#main_content').removeClass('d-flex');
                    $('#background_content').removeClass('d-flex');
                    $('#audio_content').removeClass('d-flex');

                    $('#main_content').removeClass('d-none');
                    $('#audio_content').removeClass('d-none');

                    $('#main_content').addClass('d-none');
                    $('.tables').addClass('d-none');
                    $('#audio_content').addClass('d-flex');
                    $('#background_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');


                } else if (selectedValue == 'custom_layout_signage') {
                    $("#zone .custom-layout-signage").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');

                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');

                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_main_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');

                } else if (selectedValue == 'custom_layout_clock') {
                    $("#zone .custom-layout-clock").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');

                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');
                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');

                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_clock_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');

                } else if (selectedValue == 'custom_layout_banner') {
                    $("#zone .custom-layout-banner").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');

                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');


                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_banner_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');

                } else if (selectedValue == 'custom_layout_weather') {
                    $("#zone .custom-layout-weather").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');

                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');

                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_weather_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');

                }
            });

            $(document).ready(function() {
                $('#background_audio').click(function() {
                    $("#zone").css("background-color", '#a09d9d');
                    $("#background").css("background-color", 'rgb(100, 94, 94)');
                    $("#background_audio").css("background-color", 'rgb(0, 0, 0)');
                    $('#option').val('background_audio').change();
                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');
                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');

                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#audio_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');


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
                $('#zone .custom-layout-signage').click(function(event) {
                    event.stopPropagation();
                    $("#zone .custom-layout-signage").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');
                    $('#option').val('custom_layout_signage').change();

                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');

                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_main_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');

                });
                $('#zone .custom-layout-clock').click(function(event) {
                    event.stopPropagation();
                    $("#zone .custom-layout-clock").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');
                    $('#option').val('custom_layout_clock').change();

                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');
                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');

                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_clock_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');
                });
                $('#zone .custom-layout-banner').click(function(event) {
                    event.stopPropagation();
                    $("#zone .custom-layout-banner").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');
                    $('#option').val('custom_layout_banner').change();

                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-weather").css("background-color", '#b0b0b0');


                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_banner_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');
                });
                $('#zone .custom-layout-weather').click(function(event) {
                    event.stopPropagation();
                    $("#zone .custom-layout-weather").css("background-color", 'rgb(0, 0, 0)');
                    $("#background_audio").css("background-color", 'rgb(100, 94, 94)');
                    $('#option').val('custom_layout_weather').change();

                    $("#zone .custom-layout-banner").css("background-color", '#c0c0c0');
                    $("#zone .custom-layout-clock").css("background-color", '#a0a0a0');
                    $("#zone .custom-layout-signage").css("background-color", '#e0e0e0');

                    $('.tables').removeClass('d-flex');

                    $('.tables').addClass('d-none');
                    $('#custom_layout_weather_content').removeClass('d-none');
                    $('.tables').addClass('d-flex');
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
                var selectedApps = [];
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
                    selectedApps = [];

                    $('#imageModal').find('#playlists table tr.bg-selected').each(function() {
                        var playlistContent = $(this).find('td').eq(5).text();
                        var id = $(this).find('td').eq(0).text();
                        selectedPlaylists.push({
                            id: id,
                            playlistContent: playlistContent
                        });
                    });

                    $('#imageModal').find('#images table tr.bg-selected').each(function() {
                        var imageContent = $(this).find('td').eq(2).text();
                        var id = $(this).find('td').eq(0).text();
                        selectedImages.push({
                            id: id,
                            content: imageContent
                        });
                    });

                    $('#imageModal').find('#videos table tr.bg-selected').each(function() {
                        var videoContent = $(this).find('td').eq(2).text();
                        var id = $(this).find('td').eq(0).text();
                        selectedVideos.push({
                            id: id,
                            content: videoContent
                        });
                    });

                    $('#imageModal').find('#audios table tr.bg-selected').each(function() {
                        var audioContent = $(this).find('td').eq(2).text();
                        var id = $(this).find('td').eq(0).text();
                        selectedAudios.push({
                            id: id,
                            content: audioContent
                        });

                    });

                    $('#imageModal').find('#links table tr.bg-selected').each(function() {
                        var linkContent = $(this).find('td').eq(2).text();
                        var id = $(this).find('td').eq(0).text();
                        selectedLinks.push({
                            id: id,
                            content: linkContent
                        });
                    });
                    $('#imageModal').find('#apps table tr.bg-selected').each(function() {
                        var id = $(this).find('td').eq(0).text();
                        var appContent = $(this).find('td').eq(1).text();
                        var type = $(this).find('td').eq(2).text();
                        selectedApps.push({
                            id: id,
                            content: appContent,
                            type: type
                        });
                    });

                    selectedPlaylists.forEach(function(playlistData) {
                        // Accessing playlistContent directly from the object
                        let parsedData = JSON.parse(playlistData.playlistContent);
                        let audio = parsedData.mute === 'false' ? 'Unmute' : 'Mute';

                        if (parsedData) {
                            let tdElement = $('<td class="py-3"></td>');
                            let stackedCardDiv = $(
                                '<div class="stacked-card" style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;"></div>'
                            );

                            let contents = parsedData.contents.split(',');
                            let contentTypes = parsedData.content_types.split(',');

                            contents.forEach(function(content, index) {
                                let contentType = contentTypes[index];

                                if (contentType === "Image") {
                                    let imgElement = $('<img>')
                                        .attr('src', '/contents/images/' + content)
                                        .attr('alt', content)
                                        .addClass('stacked-image')
                                        .css({
                                            width: '50px',
                                            height: '50px',
                                            borderRadius: '8px',
                                            marginLeft: (index == 0 ? 0 : -10) + 'px',
                                            border: '1px solid #ccc',

                                        });
                                    stackedCardDiv.append(imgElement);
                                } else if (contentType === "Video") {
                                    let videoElement = $('<video>')
                                        .attr('src', '/contents/videos/' + content)
                                        .addClass('stacked-image')
                                        .css({
                                            width: '80px',
                                            height: '80px',
                                            borderRadius: '8px',
                                            marginLeft: (index == 0 ? 0 : -10) + 'px',
                                            border: '1px solid #ccc',
                                        })
                                        .prop('muted', true)
                                        .prop('autoplay', true)
                                        .prop('loop', true);
                                    stackedCardDiv.append(videoElement);
                                } else if (contentType === "Link") {


                                    let linkElement = $('<iframe>')
                                        .attr('src', content)

                                        .css({
                                            width: '80px',
                                            height: '80px',
                                            borderRadius: '8px',
                                            marginLeft: (index == 0 ? 0 : -10) + 'px',
                                            border: '1px solid #ccc',
                                        });
                                    stackedCardDiv.append(linkElement);

                                }
                            });

                            tdElement.append(stackedCardDiv);

                            $('#' + option + '_mediaTable tbody').append(`
                                <tr class="draggable-row">
                                    <td class="d-none">${playlistData.id}</td>
                                    ${tdElement.prop('outerHTML')}
                                    <td>${parsedData.playlist_name}</td>
                                    <td>Playlist</td>
                                    <td><input type="text" class="form-control" value="${parseInt(parsedData.total_duration)}" disabled></td>
                                    <td>${audio}</td>
                                    <td><button type="button" class="btn btn-danger btn-link delete-row"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            `);
                        }
                    });



                    selectedImages.forEach(function(imageContent) {
                        $('#' + option + '_mediaTable tbody').append(`
                                <tr class="draggable-row">
                                    <td class="d-none">${imageContent.id}</td>
                                    <td><img src="{{ asset("contents/images/") }}/${imageContent.content}" class="img-thumbnail" alt="Image" width="80" height="80"></td>
                                    <td>${imageContent.content}</td>
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
                                <td class="d-none">${videoContent.id}</td>
                                <td>
                                    <video width="80" height="80" controls>
                                        <source src="{{ asset("contents/videos/") }}/${videoContent.content}" type="video/mp4">
                                    </video>
                                </td>
                                <td>${videoContent.content}</td>
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
                                <td class="d-none">${audioContent.id}</td>

                                <td>
                                    <audio width="80" height="80" controls>
                                        <source src="{{ asset("contents/audios/") }}/${audioContent.content}" type="audio/mpeg">
                                    </audio>
                                </td>
                                <td>${audioContent.content}</td>
                                <td>Audio</td>
                                <td><input type="text" class="form-control" id="duration" disabled></td>
                                <td>Unmute</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>`;

                        $('#' + option + '_mediaTable tbody').append(audioRow);
                        var audioElement = $('#' + option + '_mediaTable tbody tr:last-child audio')[0];
                        getVideoDuration(audioElement);
                    });

                    selectedLinks.forEach(function(linkData) {
                        var content = linkData.content; // Accessing the content
                        var id = linkData.id; // Accessing the id
                        var fileExtension = content.split('.').pop().toLowerCase();
                        var youtubeId = null;
                        var youtubeRegex =
                            /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                        var matches = content.match(youtubeRegex);

                        if (matches) {
                            youtubeId = matches[1];
                        }
                        var mediaContainer = '';

                        if (youtubeId) {
                            // YouTube Video Embed
                            mediaContainer = `
                            <iframe src="https://www.youtube-nocookie.com/embed/${youtubeId}"  height="80"
                            width="80" style="border: none;" frameborder="0" allow="accelerometer; encrypted-media; gyroscope;" allowfullscreen>Your browser does not support this file.</iframe>
                        `;
                        } else if (isValidUrl(content)) {
                            // Attempt to Embed as Iframe or Open in New Tab if Blocked
                            mediaContainer = `
                            <iframe id="iframe" src="${content}" height="80"
                            width="80" style="border: none;" frameborder="0" allow="accelerometer; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
                        `;
                        } else {
                            // Default Link
                            mediaContainer = `
                            <a href="${content}" target="_blank">
                                <button class="btn btn-link">View Link</button>
                            </a>
                        `;
                        }

                        // Function to validate URL
                        function isValidUrl(string) {
                            var res = string.match(/(http|https):\/\/[^\s]+/g);
                            return res !== null;
                        }

                        var linkRow = `
                            <tr class="draggable-row">
                                <td class="d-none">${id}</td>
                                <td>
                                    <div class="link-wrapper">
                                        ${mediaContainer}
                                    </div>
                                </td>
                                <td>
                                    <a href="${content}" target="_blank">
                                        <button class="btn btn-link">${content}</button>
                                    </a>
                                </td>
                                <td>Link</td>
                                <td><input type="text" class="form-control border p-2" placeholder="Enter duration" value="05"></td>
                                <td>Unmute</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>`;

                        $('#' + option + '_mediaTable tbody').append(linkRow);
                    });

                    selectedApps.forEach(function(appContent) {
                        let dynamicContent = '';

                        // Define a mapping for app types to their respective content
                        const contentMap = (type) => {
                            // Check if type starts with 'Banner:'
                            if (type.startsWith('Banner:')) {
                                return `<img src="{{ asset("contents/clock/") }}/banner0.png" class="img-thumbnail" alt="Banner" width="80" height="80">`;
                            }

                            // Predefined content mapping for other types
                            const predefinedMap = {
                                'Digital Clock 1': `<img src="{{ asset("contents/clock/") }}/clock.webp" class="img-thumbnail" alt="Digital Clock 1" width="80" height="80">`,
                                'Digital Clock 2': `<img src="{{ asset("contents/clock/") }}/clock.webp" class="img-thumbnail" alt="Digital Clock 2" width="80" height="80">`,
                                'Digital Clock 3': `<img src="{{ asset("contents/clock/") }}/clock.webp" class="img-thumbnail" alt="Digital Clock 3" width="80" height="80">`,
                                'Weather': `<img src="{{ asset("contents/clock/") }}/weather.jpg" class="img-thumbnail" alt="Weather" width="80" height="80">`,
                                'Banner': `<img src="{{ asset("contents/clock/") }}/banner0.png" class="img-thumbnail" alt="Banner" width="80" height="80">`,
                            };

                            // Return the corresponding content or a fallback
                            return predefinedMap[type] || '<span>Unknown Type</span>';
                        };

                        // Resolve dynamic content
                        const appType = appContent.type.trim(); // Get the app type
                        dynamicContent = contentMap(appType); // Use the function to resolve content

                        // Append the row with the resolved content
                        $('#' + option + '_mediaTable tbody').append(`
        <tr class="draggable-row">
            <td class="d-none">${appContent.id}</td>
            <td>${dynamicContent}</td>
            <td>${appContent.type}</td>
            <td>App</td>
            <td><input type="text" class="form-control border p-2" placeholder="Enter duration" value="05"></td>
            <td>Mute</td>
            <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
        </tr>
    `);
                    });






                    $('#imageModal').modal('hide');
                    $('#imageModal').find('table tr').removeClass('bg-selected');
                });



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
                    content["id"] = $(this).find("td:eq(0)").text().trim();
                    content["content_name"] = $(this).find("td:eq(2)").text().trim();
                    content["content_type"] = $(this).find("td:eq(3)").text();
                    content["duration"] = $(this).find("td:eq(4) input").val();
                    content["audio"] = $(this).find("td:eq(5)").text();

                    background_audio.push(content);
                });
                var main_zone = [];
                $('#main_zone_mediaTable tbody > tr').each(function() {
                    let content = {};
                    content["id"] = $(this).find("td:eq(0)").text().trim();
                    content["content_name"] = $(this).find("td:eq(2)").text().trim();
                    content["content_type"] = $(this).find("td:eq(3)").text();
                    content["duration"] = $(this).find("td:eq(4) input").val();
                    content["audio"] = $(this).find("td:eq(5)").text();

                    main_zone.push(content);
                });
                var background = [];
                $('#background_mediaTable tbody > tr').each(function() {
                    let content = {};
                    content["id"] = $(this).find("td:eq(0)").text().trim();
                    content["content_name"] = $(this).find("td:eq(2)").text().trim();
                    content["content_type"] = $(this).find("td:eq(3)").text();
                    content["duration"] = $(this).find("td:eq(4) input").val();
                    content["audio"] = $(this).find("td:eq(5)").text();

                    background.push(content);
                });
                var custom_main = [];
                $('#custom_layout_signage_mediaTable tbody > tr').each(function() {
                    let content = {};
                    content["id"] = $(this).find("td:eq(0)").text().trim();
                    content["content_name"] = $(this).find("td:eq(2)").text().trim();
                    content["content_type"] = $(this).find("td:eq(3)").text();
                    content["duration"] = $(this).find("td:eq(4) input").val();
                    content["audio"] = $(this).find("td:eq(5)").text();

                    custom_main.push(content);
                });
                var custom_clock = [];
                $('#custom_layout_clock_mediaTable tbody > tr').each(function() {
                    let content = {};
                    content["id"] = $(this).find("td:eq(0)").text().trim();
                    content["content_name"] = $(this).find("td:eq(2)").text().trim();
                    content["content_type"] = $(this).find("td:eq(3)").text();
                    content["duration"] = $(this).find("td:eq(4) input").val();
                    content["audio"] = $(this).find("td:eq(5)").text();

                    custom_clock.push(content);
                });
                var custom_banner = [];
                $('#custom_layout_banner_mediaTable tbody > tr').each(function() {
                    let content = {};
                    content["id"] = $(this).find("td:eq(0)").text().trim();
                    content["content_name"] = $(this).find("td:eq(2)").text().trim();
                    content["content_type"] = $(this).find("td:eq(3)").text();
                    content["duration"] = $(this).find("td:eq(4) input").val();
                    content["audio"] = $(this).find("td:eq(5)").text();

                    custom_banner.push(content);
                });
                var custom_weather = [];
                $('#custom_layout_weather_mediaTable tbody > tr').each(function() {
                    let content = {};
                    content["id"] = $(this).find("td:eq(0)").text().trim();
                    content["content_name"] = $(this).find("td:eq(2)").text().trim();
                    content["content_type"] = $(this).find("td:eq(3)").text();
                    content["duration"] = $(this).find("td:eq(4) input").val();
                    content["audio"] = $(this).find("td:eq(5)").text();

                    custom_weather.push(content);
                });

                data["background_audio_contents"] = background_audio;
                data["main_zone_contents"] = main_zone;
                data["background_contents"] = background;
                data["custom_main"] = custom_main;
                data["custom_clock"] = custom_clock;
                data["custom_banner"] = custom_banner;
                data["custom_weather"] = custom_weather;
                data["mute"] = $('#muteCheckbox').is(':checked') ? true : false;
                data["template_name"] = $('#template_name').text().trim();
                data["template_id"] = $('#template_name').data('template_id');
                data["template_type"] = $('#zone').data('layout_type');
                data["template_layout"] = $('#zone').data('layout_name');

                console.log("Data to be sent:", data);

                $.ajax({
                    type: "post",
                    url: "{{ route("template.update") }}",
                    data: JSON.stringify(data),
                    dataType: "json",
                    contentType: "application/json",
                    success: function(response) {
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
            $(document).ready(function() {

                $('#background_audio_mediaTable tbody').sortable({
                    items: 'tr.draggable-row',
                    cursor: 'move',
                    update: function(event, ui) {}
                });
                $('#main_zone_mediaTable tbody').sortable({
                    items: 'tr.draggable-row',
                    cursor: 'move',
                    update: function(event, ui) {}
                });
                $('#background_mediaTable tbody').sortable({
                    items: 'tr.draggable-row',
                    cursor: 'move',
                    update: function(event, ui) {}
                });
                $('#custom_layout_signage_mediaTable tbody').sortable({
                    items: 'tr.draggable-row',
                    cursor: 'move',
                    update: function(event, ui) {}
                });
                $('#custom_layout_clock_mediaTable tbody').sortable({
                    items: 'tr.draggable-row',
                    cursor: 'move',
                    update: function(event, ui) {}
                });
                $('#custom_layout_banner_mediaTable tbody').sortable({
                    items: 'tr.draggable-row',
                    cursor: 'move',
                    update: function(event, ui) {}
                });
                $('#custom_layout_weather_mediaTable tbody').sortable({
                    items: 'tr.draggable-row',
                    cursor: 'move',
                    update: function(event, ui) {}
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                function updateClock() {
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, "0");
                    const minutes = String(now.getMinutes()).padStart(2, "0");
                    const seconds = String(now.getSeconds()).padStart(2, "0");

                    updateDigits("hour-first", hours[0]);
                    updateDigits("hour-second", hours[1]);
                    updateDigits("minute-first", minutes[0]);
                    updateDigits("minute-second", minutes[1]);
                    updateDigits("second-first", seconds[0]);
                    updateDigits("second-second", seconds[1]);
                }

                function updateDigits(id, newDigit) {
                    const element = document.getElementById(id);
                    if (element.textContent !== newDigit) {
                        element.classList.add("flip-out");
                        setTimeout(() => {
                            element.textContent = newDigit;
                            element.classList.remove("flip-out");
                            element.classList.add("flip-in");
                        }, 300); // Delay to match the flip-out animation
                    }
                }

                // Update the clock every second
                updateClock();
                setInterval(updateClock, 1000);
            });
        </script>
    @endpush
</x-layout>
