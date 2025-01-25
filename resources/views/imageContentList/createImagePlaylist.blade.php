<style>
    .image-card img {
        width: 100%;
        height: 150px;
        /* Set the desired height */
        object-fit: cover;
        /* Ensure the image fills the fixed size */
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
        background-color: rgb(0, 208, 255) !important;
        position: relative;
        border-radious: 0px;
    }

    #imageModal .nav-link.active:after {
        content: '';
        position: absolute;
        left: 100%;
        /* Position the arrow to the right of the tab */
        top: 50%;
        transform: translateY(-50%);
        border-left: 10px solid rgb(0, 208, 255);
        /* Arrow color */
        border-top: 13px solid transparent;
        border-bottom: 13px solid transparent;
    }
    .fade-in {
    animation: fadeInEffect 0.5s ease-in-out;
}

@keyframes fadeInEffect {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.border-bottom-only {
    border: none;
    border-bottom: 2px solid #ccc; /* Customize the color and thickness */
    border-radius: 0; /* Remove any rounded corners */
}

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<x-layout titlePage="Create Image Playlist" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='image.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Create Playlist"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/image-playlist-view"> Playlist</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Create Playlist </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        {{-- <label class="form-label" for="priority">Playlist Name</label> --}}
                                        <input type="text" class="form-control border-bottom border-1 ms-3"
                                            id="playlist_name" placeholder="Playlist name"style="padding-left: 15px;">
                                    </div>
                                    <div class="col-1">

                                    <div class="form-check form-switch d-inline-block custom-switch  pt-2 pe-1">
                                        <input type="checkbox" class="form-check-input" id="muteCheckbox" name="mute" id="mute" style="margin-top: 5px;" >
                                        <label class="form-check-label" for="muteCheckbox">
                                            <h5 class="d-inline" style="vertical-align: middle;">Mute
                                            </h5>
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="col-md-8 mt-xl-2  d-flex flex-column align-items-end justify-content-end">
                                    <button type="button" class="btn btn-primary d-flex " 
                                            id="openImageModal" data-bs-toggle="modal" data-bs-target="#imageModal" style="gap: 0.5rem;">
                                        <i class="bi bi-image-fill mt-1"></i>
                                        Select Contents
                                    </button>
                                    <input type="hidden" id="selectedImages" name="selectedImages">
                                </div>
                                
                                    {{-- <div class="col-3">
                                        <div class="text-end">
                                            <a class="btn bg-gradient-dark mb-0" href="{{ route('image.playlist.view') }}">
                                                <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                                
                                <div class="card-body">
                                    <input type="hidden" id="member_id">


                                    <div class="col-12">
                                        <h5 class="project"></h5>
                                        <h5 class="mute"></h5>

                                        <div id="mediaTable" class="table-responsive d-none">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Media</th>
                                                        <th>Content Name</th>
                                                        <th>Content Type</th>
                                                        <th>Duration</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">

                                                    <!-- Add more rows as needed -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row text-end">
                                            <div class="col-12">

                                                <button id="submit" class="btn bg-gradient-success d-none">Submit </button>

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
                                <div class="nav flex-column nav-pills" id="mediaTab" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-link active" id="images-tab" data-bs-toggle="pill"
                                        data-bs-target="#images" type="button" role="tab" aria-controls="images"
                                        aria-selected="true">Images</button>
                                    <button class="nav-link" id="videos-tab" data-bs-toggle="pill"
                                        data-bs-target="#videos" type="button" role="tab" aria-controls="videos"
                                        aria-selected="false">Videos</button>
                                    <button class="nav-link" id="link-tab" data-bs-toggle="pill"
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
                                                                    <video width="80" height="80" controls>
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
                                                                        style="position: relative; width: 80px; height:80px ;">
                                                                        <iframe id="iframe-{{ $linkList->id }}"
                                                                            width="50px" height="50px"
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






    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
        $(document).ready(function() {
    var selectedImages = [];
    var selectedVideos = [];
    var selectedLinks = [];

    $('#imageModal').find('table tr').click(function() {
        $(this).toggleClass('selected');
    });

    // Save selected image/video
    $('#saveMedia').click(function() {
        // $('#mediaTable tbody').empty();
        // $('#mediaTable tbody').empty();

        selectedImages = [];
        selectedVideos = [];
        selectedLinks = [];
        // Get selected images
        $('#imageModal').find('#images table tr.selected').each(function() {
            var imageContent = $(this).find('td').eq(1).text();
            selectedImages.push(imageContent);
        });

        // Get selected videos
        $('#imageModal').find('#videos table tr.selected').each(function() {
            var videoContent = $(this).find('td').eq(1).text();
            selectedVideos.push(videoContent);
        });
        $('#imageModal').find('#links table tr.selected').each(function() {
            var linkContent = $(this).find('td').eq(1).text();
            selectedLinks.push(linkContent);
        });
        // Add selected images to the table
        selectedImages.forEach(function(imageContent) {
            $('#mediaTable tbody').append(`
                <tr class="draggable-row">
                    <td><img src="{{ asset('contents/images/') }}/${imageContent}" class="img-thumbnail" alt="Image" width="80" height="80"></td>
                    <td>${imageContent}</td>
                    <td>Image</td>
                    <td><input type="text" class="form-control border" placeholder="Enter duration"value="05"></td>
                    <td><button type="button" class="btn btn-link btn-lg delete-row"><i class="material-icons">delete</i></button></td>
                </tr>
            `);
        });

        selectedVideos.forEach(function(videoContent) {
            var videoRow = `
                <tr class="draggable-row">
                    <td>
                        <video width="80" height="80" controls>
                            <source src="{{ asset('contents/videos/') }}/${videoContent}" type="video/mp4">
                        </video>
                    </td>
                    <td>${videoContent}</td>
                    <td>Video</td>
                    <td><input type="text" class="form-control" id="duration" disabled></td>
                    <td><button type="button" class="btn btn-link btn-lg delete-row"><i class="material-icons">delete</i></button></td>
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
                                    <td><button type="button" class="btn btn-link delete-row delete-column"><i class="material-icons">delete</i></button></td>

                                </tr>`;

                        $('#mediaTable tbody').append(linkRow);
                    });

        $('#imageModal').modal('hide');
        $('.selected').removeClass('selected');

        // Make the table rows draggable
        makeRowsDraggable();
        // Remove 'd-none' class to show the table
        // Zoom-in animation
            $('#mediaTable').removeClass('d-none').css({
                transform: 'scale(0.5)',
                opacity: '0',
                transition: 'transform 0.5s ease, opacity 0.5s ease'
            });

            setTimeout(() => {
                $('#mediaTable').css({
                    transform: 'scale(1)',
                    opacity: '1'
                });
            }, 10);
            $('#submit').removeClass('d-none').addClass('fade-in');




    });

    function makeRowsDraggable() {
        // Enable draggable functionality on table rows
        $('#mediaTable tbody').sortable({
            items: 'tr.draggable-row',
            cursor: 'move',
            update: function(event, ui) {
                // Optional: Handle any actions when rows are rearranged
            }
        });
    }

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

    $(document).on('click', '.delete-row', function() {
        $(this).closest('tr').remove();
    });
});
$('#submit').click(function(e) {
        e.preventDefault();
        let data = {};

        var datas = [];
        $('#mediaTable tbody > tr').each(function() {
            const playlist_content = {};

            playlist_content["content"] = $(this).find("td:eq(1)").text();
            playlist_content["type"] = $(this).find("td:eq(2)").text();
            playlist_content["duration"] = $(this).find("td:eq(3) input").val();


            datas.push(playlist_content);
        });

        const muteCheckbox = document.getElementById('muteCheckbox');

            var  mute = muteCheckbox.checked ? 'true' : 'false';
            console.log('Mute:', mute); // For debugging: Logs "true" or "false"
        var playlist_name = $('#playlist_name').val();

        data["playlist_contents"] = datas;
        data["mute"] = mute;
        data["playlist_name"] = playlist_name;


        $.ajax({
            type: "post",
            url: "{{ route('image.playlist.store') }}",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
                if (response.status == 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('Successful');

                    $(location).attr('href', '/image-playlist-view');
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
<script>
 


   
</script> 
