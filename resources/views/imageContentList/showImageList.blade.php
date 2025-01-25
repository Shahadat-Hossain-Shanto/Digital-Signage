<style>
    .ui-state-highlight {
        height: 50px;
        background-color: #f0f0f0;
        border: 2px dashed #ddd;
    }

    .delete-column {
        display: none;
        /* Hide delete column by default */
    }

    .content-row:hover .delete-column {
        display: table-cell;
        /* Show delete column on row hover */
    }

    .selected {
        background-color: #dfdfdf;
        /* Light grey */
        border-radius: 8px;
        /* Optional for rounded corners */
    }

    /* Custom styling for active tab */
    .nav-link.active {
        color: black !important;
        font-weight: bold;
        background-color: yellow !important;
        position: relative;
        border-radious: 0px;
    }

    #mediaModal .nav-link.active:after {
        content: '';
        position: absolute;
        left: 100%;
        /* Position the arrow to the right of the tab */
        top: 50%;
        transform: translateY(-50%);
        border-left: 10px solid yellow;
        /* Arrow color */
        border-top: 13px solid transparent;
        border-bottom: 13px solid transparent;
    }
</style>
<style>
    /* Custom styles to make the switch larger */
    .custom-switch .form-check-input {
        width: 2.5em;
        /* Increase width */
        height: 1.5em;
        /* Increase height */
        transform: scale(1.5);
        /* Scale the switch */
    }

    .custom-switch .form-check-input:checked {
        background-color: #0d6efd;
        /* Optional: match primary color */
    }
</style>


</style>
<x-layout titlePage="Show Image Content List" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='image.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Playlist Contents"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/image-playlist-view"> Playlist </a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> {{ $name }} </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="form-check form-switch d-inline-block ms-5 custom-switch">
                                    <input type="checkbox" class="form-check-input" id="muteCheckbox" name="mute"
                                        {{ $contentLists[0]->mute === 'true' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="muteCheckbox">
                                        <h5 class="d-inline ms-3">Mute</h5>
                                    </label>
                                </div>

                                <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('image.playlist.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                    <button class=" btn btn-success mb-0 ml-5" id="openImageModal"
                                        data-bs-toggle="modal" data-bs-target="#mediaModal">Add</button>
                                    <button class="updateIcon btn bg-gradient-primary mb-0 ml-5">Update
                                    </button>
                                    <a href=""id="{{ $name }}"
                                        class="deleteIcon btn bg-gradient-danger mb-0 ml-5">Delete
                                    </a>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <input type="hidden"id="playlist_name" value={{ $name }}>
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0" id="mediaTable">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Content</th>
                                                    <th>Content Type</th>
                                                    <th>Duration</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($contentLists as $key => $contentList)
                                                    <tr class="content-row">
                                                        <td class="d-none">{{ $contentList->id }}</td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    @if ($contentList->content_type == 'Image')
                                                                        <img src="{{ asset('contents/images/' . $contentList->content) }}"
                                                                            alt="" width="80"
                                                                            class="thumbnail">
                                                                    @elseif ($contentList->content_type == 'Video')
                                                                        <video
                                                                            src="{{ asset('contents/videos/' . $contentList->content) }}"
                                                                            alt="" width="80" height="80"
                                                                            class="thumbnail" controls></video>
                                                                    @elseif ($contentList->content_type == 'Link')
                                                                        <div class="link-wrapper">
                                                                            @php
                                                                                $content = $contentList->content_type;
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
                                                                                        '/(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/',
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
                                                                                    src="{{ $content }}"
                                                                                    frameborder="0"
                                                                                    style="border: none;"
                                                                                    allowfullscreen
                                                                                    onerror="handleIframeError(this, '{{ $content }}')">
                                                                                </iframe>
                                                                            @else
                                                                                {{-- Default Link --}}
                                                                                <a href="{{ asset($contentList->content) }}"
                                                                                    target="_blank">
                                                                                    <button class="btn btn-link">View
                                                                                        Link</button>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $contentList->content }}
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    {{ $contentList->content_type }}</h6>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                @if ($contentList->content_type == 'Image')
                                                                    <input type="text" class="form-control border"
                                                                        placeholder="Enter duration"
                                                                        value="{{ $contentList->duration }}">
                                                                @elseif ($contentList->content_type == 'Video')
                                                                    <input type="text" class="form-control border"
                                                                        placeholder="Enter duration"
                                                                        value="{{ $contentList->duration }} "disabled>
                                                                @elseif ($contentList->content_type == 'Link')
                                                                    <input type="text" class="form-control border"
                                                                        placeholder="Enter duration"
                                                                        value="{{ $contentList->duration }} ">
                                                                @endif

                                                            </div>
                                                        </td>
                                                        <!-- Delete button column -->
                                                        <td class="">
                                                            <button class="btn btn-danger delete-column delete-row"
                                                                data-id="{{ $contentList->id }}">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

    </main>
    <x-plugins></x-plugins>

    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
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
                            <div class="nav flex-column nav-pills" id="mediaTab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="images-tab" data-bs-toggle="pill"
                                    data-bs-target="#images" type="button" role="tab" aria-controls="images"
                                    aria-selected="true">Images</button>
                                <button class="nav-link" id="videos-tab" data-bs-toggle="pill"
                                    data-bs-target="#videos" type="button" role="tab" aria-controls="videos"
                                    aria-selected="false">Videos</button>
                                <button class="nav-link" id="links-tab" data-bs-toggle="pill"
                                    data-bs-target="#links" type="button" role="tab" aria-controls="links"
                                    aria-selected="false">Links</button>

                            </div>
                        </div>
                        <!-- Tab Content Area -->
                        <div class="col-md-9">
                            <div class="tab-content" id="mediaTabContent">
                                <!-- Images Tab Pane -->
                                <div class="tab-pane fade show active" id="images" role="tabpanel"
                                    aria-labelledby="images-tab">
                                    <table class="table ">

                                        <tbody>
                                            @foreach ($imageLists as $imageList)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset("contents/images/{$imageList->content}") }}"
                                                            class="img-thumbnail" alt="Image" width="80">
                                                    </td>
                                                    <td>{{ $imageList->content }}</td>
                                                    <td>{{ $imageList->content_type }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Videos Tab Pane -->
                                <div class="tab-pane fade" id="videos" role="tabpanel"
                                    aria-labelledby="videos-tab">
                                    <table class="table ">

                                        <tbody>
                                            @if (!is_null($videoLists))
                                                @foreach ($videoLists as $videoList)
                                                    <tr>
                                                        <td>
                                                            <video width="80" height="80" controls>
                                                                <source
                                                                    src="{{ asset('contents/videos/' . $videoList->content) }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        </td>
                                                        <td>{{ $videoList->content }}</td>
                                                        <td>{{ $videoList->content_type }}</td>
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
                                <div class="tab-pane fade" id="links" role="tabpanel"
                                    aria-labelledby="links-tab">
                                    <table class="table ">
                                        <tbody style=" vertical-align: middle;">
                                            @if (!is_null($linkLists))
                                                @foreach ($linkLists as $linkList)
                                                    <tr>
                                                        <td>
                                                            <div class="link-wrapper">
                                                                @php
                                                                    $content = $linkList->content;
                                                                    $videoExtensions = ['.mp4', '.webm', '.ogg'];
                                                                    $audioExtensions = ['.mp3', '.ogg', '.wav'];
                                                                    $fileExtension = strtolower(
                                                                        pathinfo($content, PATHINFO_EXTENSION),
                                                                    );

                                                                    $youtubeId = null;
                                                                    if (
                                                                        preg_match(
                                                                            '/(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                                                                            $content,
                                                                            $matches,
                                                                        )
                                                                    ) {
                                                                        $youtubeId = $matches[1];
                                                                    }
                                                                @endphp

                                                                @if ($youtubeId)
                                                                    <iframe width="50" height="50"
                                                                        src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                        frameborder="0"
                                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                                        allowfullscreen></iframe>
                                                                @elseif (in_array($fileExtension, $videoExtensions))
                                                                    <video width="350" height="75" controls>
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
                                                                        style="position: relative; width: 80px; height: 80px;">
                                                                        <iframe id="iframe-{{ $linkList->id }}"
                                                                            width="80px" height="80px"
                                                                            src="{{ $content }}" frameborder="0"
                                                                            style="border: none;" allowfullscreen
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
                                                                    <a href="{{ asset($content) }}" target="_blank">
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
                                                        <td class='d-none'>{{ $linkList->id }}</td>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        id="saveMedia">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DELETEimageMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEimageFORM" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}


                    <div class="modal-body">
                        <input type="hidden" name="" id="id">
                        <h5 class="text-center">Are you sure you want to delete?</h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel_btn btn btn-secondary"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="delete btn btn-outline-danger">Yes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @push('js')
        <!-- the jQuery Library -->
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                var selectedImages = [];
                var selectedVideos = [];
                // Make rows draggable
                $("#tbody").sortable({
                    placeholder: "ui-state-highlight",
                    update: function(event, ui) {
                        // Get the new order of rows
                        let order = $(this).sortable('toArray');

                    }
                });
                $('#mediaModal').find('table tr').click(function() {
                    $(this).toggleClass('selected');
                });

                $('#saveMedia').click(function() {

                    selectedImages = [];
                    selectedVideos = [];
                    selectedLinks = [];

                    // Get selected images
                    $('#mediaModal').find('#images table tr.selected').each(function() {
                        var imageContent = $(this).find('td').eq(1).text();
                        selectedImages.push(imageContent);
                    });

                    // Get selected videos
                    $('#mediaModal').find('#videos table tr.selected').each(function() {
                        var videoContent = $(this).find('td').eq(1).text();
                        selectedVideos.push(videoContent);
                    });
                    $('#mediaModal').find('#links table tr.selected').each(function() {
                        var linkContent = $(this).find('td').eq(1).text();
                        selectedLinks.push(linkContent);
                    });
                    // console.log(selectedImages)
                    // console.log(selectedVideos)


                    // Add selected images to the table
                    selectedImages.forEach(function(imageContent) {
                        $('#mediaTable tbody').append(`
                            <tr class="draggable-row">
                                <td class='d-none'></td>
                                <td><img src="{{ asset('contents/images/') }}/${imageContent}" class="img-thumbnail" alt="Image" width="80" height="80"></td>
                                <td><h6 class="mb-0 text-sm">${imageContent}</h6></td>
                                <td><h6 class="mb-0 text-sm">Image</h6></td>
                                <td><input type="text" class="form-control border" placeholder="Enter duration"value="05"></td>
                                <td><button type="button" class="btn btn-danger delete-row delete-column"><i class="material-icons">delete</i></button></td>
                            </tr>
                        `);
                    });

                    selectedVideos.forEach(function(videoContent) {
                        var videoRow = `
                            <tr class="draggable-row">
                                <td class='d-none'></td>

                                <td>
                                    <video width="80" height="80" controls>
                                        <source src="{{ asset('contents/videos/') }}/${videoContent}" type="video/mp4">
                                    </video>
                                </td>
                                <td><h6 class="mb-0 text-sm">${videoContent}</h6></td>
                                <td><h6 class="mb-0 text-sm">Video</h6></td>
                                <td><input type="text" class="form-control" id="duration" disabled></td>
                                <td><button type="button" class="btn btn-danger delete-row delete-column"><i class="material-icons">delete</i></button></td>
                            </tr>`;
                        $('#mediaTable tbody').append(videoRow);

                        // Get the video element after appending to the table
                        var videoElement = $('#mediaTable tbody tr:last-child video')[0];

                        // Call the function to get video duration
                        getVideoDuration(videoElement);
                    });
                    selectedLinks.forEach(function(linkContent) {
                        var content = linkContent;
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
                                <iframe 
                                    src="https://www.youtube-nocookie.com/embed/${youtubeId}" 
                                    width="80" height="80" 
                                    frameborder="0" 
                                    style="border: none;" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>`;
                        } else if (isValidUrl(content)) {
                            // Attempt to Embed as Iframe or Open in New Tab if Blocked
                            mediaContainer = `
                                    <iframe 
                                        src="${content}" 
                                        width="80" height="80" 
                                        frameborder="0" 
                                        style="border: none;" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen 
                                        onerror="handleIframeError(this, '${content}')">
                                    </iframe>`;
                        } else {
                            // Default Link
                            mediaContainer = `
                                <a href="${content}" target="_blank">
                                    <button class="btn btn-link">View Link</button>
                                </a>`;
                                            }

                        // Function to validate URL
                        function isValidUrl(string) {
                            var urlRegex = /^(http|https):\/\/[^\s]+$/;
                            return urlRegex.test(string);
                        }

                        var linkRow = `
                                <tr class="draggable-row">
                                    <td class='d-none'></td>
                                    <td>
                                        <div class="link-wrapper">
                                            ${mediaContainer}
                                        </div>
                                    </td>
                                    <td><h6 class="mb-0 text-sm">
                                        ${linkContent}</h6>
                                    </td>
                                    <td><h6 class="mb-0 text-sm">Link<h6></td>
                                    <td><input type="text" class="form-control border" placeholder="Enter duration"value="05"></td>
                                    <td><button type="button" class="btn btn-danger delete-row delete-column"><i class="material-icons">delete</i></button></td>

                                </tr>`;

                        $('#mediaTable tbody').append(linkRow);
                    });
                    // Add selected links to the table as iframes


                    $('#mediaModal').modal('hide');

                    // Make the table rows draggable
                });
            });

            function getVideoDuration(videoElement) {
                // Ensure the metadata is loaded
                videoElement.onloadedmetadata = function() {
                    var durationInSeconds = videoElement.duration;
                    var formattedDuration = formatTime(durationInSeconds);

                    // Use jQuery to find the input inside the same <tr>
                    var durationInput = $(videoElement).closest('tr').find('input[type="text"]');
                    durationInput.val(formattedDuration);
                };

                // If the metadata is already loaded, call it manually
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
        </script>
        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // Check for flash messages
                @if (session('status'))
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('{{ session('status') }}');
                @endif

                @if (session('error'))
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('{{ session('error') }}');
                @endif
            });

            // delete user ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');

                $('#id').val(id);
                $('#DELETEimageFORM').attr('action', '/image-playlist-delete/' + id);
                $('#DELETEimageMODAL').modal('show');
            });
            $(".cancel_btn").click(function(e) {
                e.preventDefault();
                $('#DELETEimageMODAL').modal('hide');



            });
            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });
            $(".updateIcon").click(function(e) {
                e.preventDefault();
                let name = $("#playlist_name").val();
                let mute = $('#muteCheckbox').is(':checked') ? true : false;
                console.log(mute)

                var tableData = [];

                // Iterate through each row in the table body
                $('#mediaTable tbody tr').each(function() {
                    // Adjusted cell indices for id, content, content_type, and duration
                    var id = $(this).find('td').eq(0).text().trim(); // Adjusted for dynamic ID assignment
                    var content = $(this).find('td:eq(2) h6').text().trim();
                    var content_type = $(this).find('td:eq(3) h6').text().trim();
                    var duration = $(this).find('td:eq(4) input').val();
                    tableData.push({
                        id: id,
                        content: content,
                        content_type: content_type,
                        duration: duration
                    });
                });

                $.ajax({
                    url: '/image-playlist-update', // Replace with your endpoint URL
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        tableData: tableData,
                        name: name,
                        mute: mute,

                    },
                    success: function(response) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.message);
                        $(location).attr('href', '/image-playlist-show-content/' + name);
                    },
                    error: function(xhr) {
                        // Handle errors if needed
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('An error occurred while saving the playlist.');
                    }
                });

            });
        </script>
    @endpush
</x-layout>
