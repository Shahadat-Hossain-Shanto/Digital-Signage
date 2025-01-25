<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .nav-link.active {
        color: black !important;
        font-weight: bold;
        background-color: rgb(0, 208, 255) !important;
        position: relative;
        border-radious: 0px;
    }

    #imageModal .nav-link.active:after {
        content: ' ';
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        border-left: 10px solid rgb(0, 208, 255);
        border-top: 13px solid transparent;
        border-bottom: 13px solid transparent;
        padding-right: 10px;
    }

    .link-wrapper {
        position: relative;
        display: inline-block;
    }

    #card-container .card {
        min-height: 100px;
        /* Adjust as needed */
    }

    #card-container .logo-container svg {
        width: 50px;
        height: 50px;
        color: #007bff;
    }

    .custom-hr {
        margin: 0 auto;
        /* Center the line horizontally */
        width: 80%;
        /* Adjust the width to fit inside the container */
        border: 0;
        /* Remove default border */
        border-top: 1px solid lightblack;
        /* Custom border style */
        height: 1px;
        /* Set a fixed height */
    }

    .content_name {
        word-wrap: break-word;
        /* For legacy browsers */
        overflow-wrap: break-word;
        /* Modern approach */
        white-space: normal;
        /* Allows the text to wrap */
        hyphens: auto;
        /* Optional: Adds hyphenation for better readability */
    }

    #card-container .button-container {
        margin-left: auto;
        /* Ensures the button is at the right */
    }
</style>
<x-layout titlePage="Assign Contents" bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar bar activePage=''></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Assign Content"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Assign Content </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="me-3 my-3">

                                <div class="card-body">
                                    <input type="hidden" id="device_id" value="{{ $id }}">
                                    <input type="hidden" id="device" value="{{ $device->device_id }}">
                                    <div class="col-12">
                                        <div class="row" id="card-container">
                                            <div class="col-9">

                                                <div class="card p-0 border border-dark mb-3"style="min-height:8vh;">
                                                    <div class="card-body m-0 p-0 d-flex align-items-center">
                                                        <!-- Logo/Icon -->
                                                        <div class="logo-container ms-2 me-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="36"
                                                                height="36" fill="currentColor" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M21.5 7.5L17 10V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2l4.5 2.5a1 1 0 0 0 1.5-.87v-9.26a1 1 0 0 0-1.5-.87zM15 16H5V8h10v8zm5-1.4-3-1.67v-1.86l3-1.67v5.2z">
                                                                </path>
                                                            </svg>
                                                        </div>

                                                        <!-- Video Name -->
                                                        <div class="text-container flex-grow-1">
                                                            <h5 class="mb-0"id="content_name"></h5>
                                                        </div>

                                                        <!-- Upload Button -->
                                                        <div class="button-container mx-auto my-auto">
                                                            <a class="btn btn-primary btn-md d-flex align-items-center  mx-auto my-auto me-2"
                                                                id="template_add">
                                                                <i class="material-icons text-sm ">upload</i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="text-align: center;" id="layout" hidden>
                                                    <div id="backgroundData"></div>
                                                    <div hidden id='audio'></div>
                                                </div>
                                                {{-- <div class="card mt-3 "style="min-height: 60vh;background-color: #f3f2f2;border-radius:10px;">
                                                        <div class="card-body m-0 p-0 d-flex align-items-center bg-grery">
                                                            <div style="text-align: center;" id="layout" hidden>
                                                                <div id="backgroundData"></div>
                                                                <div hidden id='audio'></div>
                                                            </div>


                                                        </div>
                                                    </div> --}}

                                            </div>
                                            <div
                                                class="col-3  text-center d-flex flex-column align-items-center"style=" background-color: #f3f2f2;border-radius:10px;">
                                                <div class="" style="min-height: 50vh;">
                                                    <!-- Icon of TV or Display -->
                                                    <div class="tv-container">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                                            width="64" height="64">
                                                            <rect x="8" y="10" width="48" height="36"
                                                                rx="3" ry="3" fill="#007bff" />
                                                            <rect x="10" y="12" width="44" height="32"
                                                                rx="2" ry="2" fill="#ffffff" />
                                                            <rect x="20" y="46" width="24" height="4"
                                                                fill="#333" />
                                                            <rect x="16" y="50" width="32" height="6"
                                                                rx="2" ry="2" fill="#555" />
                                                        </svg>
                                                    </div>
                                                    <hr class="custom-hr">

                                                    <!-- Centered Text -->
                                                    <div class="text-container">
                                                        <h6 class="my-2">Device: {{ $device->device_type }}</h6>
                                                        <hr class="custom-hr">
                                                        <h6 class="my-2">Operating System :{{ $device->os }}</h6>
                                                        <hr class="custom-hr">
                                                        <h6 class="my-2"> Resulation :{{ $device->size }}</h6>
                                                        <hr class="custom-hr">
                                                    </div>
                                                    <hr class="custom-hr">

                                                    <!-- New Section for Content -->
                                                    <div class="mt-1">
                                                        <div class="card"
                                                            style="border: none; box-shadow: none; background-color: transparent;">
                                                            <!-- Logo Representing Contents -->
                                                            <!-- Updated Logo Representing Contents -->
                                                            <div class="text-center mb-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 64 64" width="48" height="48"
                                                                    fill="#6c757d">
                                                                    <!-- Outer Circle -->
                                                                    <circle cx="32" cy="32" r="30"
                                                                        fill="#007bff" />
                                                                    <!-- Inner Circle -->
                                                                    <circle cx="32" cy="32" r="22"
                                                                        fill="#ffffff" />
                                                                    <!-- Play Icon -->
                                                                    <polygon points="28,22 28,42 44,32"
                                                                        fill="#007bff" />
                                                                </svg>
                                                            </div>

                                                            <div class="text-center">
                                                                <hr class="custom-hr">
                                                                <h6 id="content_type" class="mb-1">
                                                                    {{ $device->content_type }}</h6>
                                                                <hr class="custom-hr">
                                                                @if ($device->content_type == "templates")
                                                                    <h6 id="template_content_name"
                                                                        class="mb-1 content_name">
                                                                        {{ $content->template_name ?? "" }}</h6>
                                                                    <hr class="custom-hr">
                                                                    <h6 id="template_type" class="mb-1 content_name">
                                                                        {{ $content->template_type ?? "" }}</h6>
                                                                    <hr class="custom-hr">
                                                                @elseif($device->content_type == "play_lists")
                                                                    <h6 id="play_list_content_name"
                                                                        class="mb-1 content_name">
                                                                        {{ $content->playlist_name ?? "" }}</h6>
                                                                    <hr class="custom-hr">
                                                                @elseif($device->content_type == "contents")
                                                                    <h6 id="content" class="mb-1">Content Type:
                                                                        {{ $content->content_type ?? "" }}</h6>
                                                                    <hr class="custom-hr">
                                                                    <h6 id="content_content_name"
                                                                        class="mb-1 pb-2 content_name">Name:
                                                                        {{ $content->content ?? "" }}</h6>
                                                                    <hr class="custom-hr">
                                                                @endif
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
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>

    </main>
    @include("components.contents-modal")

    <x-plugins></x-plugins>
    @push("js")
        <script>
            $('#template_add').click(function(e) {
                e.preventDefault();
                $('#imageModal').modal('show')

            });



            $('#imageModal').find('table tr').click(function() {
                // Remove the class from all rows
                $('#imageModal').find('table tr').removeClass('bg-selected');
                // Add the class to the clicked row
                // $(this).addClass('bg-selected');
                $(this).toggleClass('bg-selected');

            });
            var originTab = ''; // Variable to store the origin tab

            // Detect tab change and store the origin tab
            $('.nav-tabs a').on('shown.bs.tab', function(e) {
                originTab = $(e.target).attr('id'); // Store the ID of the active tab
            });

            // Save the media via AJAX
            $('#saveMedia').click(function() {
                var option = $("#option").val();
                var selectedRow = $('#imageModal').find('table tr.bg-selected'); // Get the selected row
                var sectionId = selectedRow.closest('.tab-pane').attr('id');
                // Identify the section by its ID
                console.log(sectionId) // Variables to hold the selected content
                var selectedContent = null;
                var contentType = '';
                var id = '';
                var contentData = {};
                if (sectionId === 'template') {
                    var TemplateContent = selectedRow.find('td').eq(2).text();
                    console.log('Template Content:', TemplateContent);
                    if (TemplateContent) {
                        contentType = 'templates'; // Fix typo here
                        id = TemplateContent; // Correct typo here too
                    }
                } else if (sectionId === 'playlists') {
                    var playlistContent = selectedRow.find('td').eq(5).text();
                    if (playlistContent) {
                        contentType = 'play_lists';
                        id = playlistContent;

                    }
                } else if (sectionId === 'images') {
                    var imageContent = selectedRow.find('td').eq(2).text();
                    if (imageContent) {
                        contentType = 'contents';
                        id = imageContent;
                    }
                } else if (sectionId === 'videos') {
                    var videoContent = selectedRow.find('td').eq(2).text();
                    if (videoContent) {
                        contentType = 'contents';
                        id = videoContent;
                    }
                } else if (sectionId === 'links') {
                    var linkContent = selectedRow.find('td').eq(2).text();
                    if (linkContent) {
                        contentType = 'contents';
                        id = linkContent;
                    }
                } else if (sectionId === 'apps') {
                    var linkContent = selectedRow.find('td').eq(0).text();
                    if (linkContent) {
                        contentType = 'contents';
                        id = linkContent;
                    }
                }

                // Prepare data for the AJAX request
                var requestData = {
                    origin_tab: originTab,
                    content_type: contentType,
                    id: id,
                };
                console.log(requestData);
                let device_id = $('#device_id').val();
                // Send the data via AJAX
                $.ajax({
                    url: '/register-device-template-assign/' + device_id, // Replace with your server endpoint
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: requestData,
                    success: function(response) {
                        console.log(response);

                        if (response.status === 200) {
                            const device = response.device;
                            const content = response.content;

                            // Update content_type (if element exists)
                            if ($('#content_type').length) {
                                $('#content_type').text(device.content_type);
                            }
                            $('.content_name').hide();
                            // Update fields based on content_type
                            if (device.content_type === "templates") {
                                $('#content_type').text('Template');
                                $('#template_content_name').text(content.template_name || '').show();
                                $('#template_type').text(content.template_type || '');
                            } else if (device.content_type === "play_lists") {
                                $('#content_type').text('Playlist');
                                $('#play_list_content_name').text(content.playlist_name || '').show();
                            } else if (device.content_type === "apps") {
                                $('#content').text('Content Type: ' + ('Apps' || ''));
                                $('#content_content_name').text('Name: ' + (content.content || '')).show();
                            }
                            window.location.reload()
                            // $('html, body').animate({
                            //     scrollTop: $('#content_type').offset().top
                            // }, 500);

                        } else {
                            console.error('Update failed:', response.message);
                        }
                        $('#imageModal').modal('hide');
                        $('#imageModal').find('table tr').removeClass('bg-selected');
                    },
                    error: function(error) {
                        // Handle the error response
                        alert('An error occurred while saving the media.');
                    }
                });
            });
        </script>

        <script>
            let delay = 0;
            let audioDelay = 0;
            let audioContent = '';
            let background = 0;
            async function replaceObject(newData, transition = 'zoom-in') {
                let obj = $('#data');

                if (obj.length) {
                    if (transition == 'zoom-in') {
                        obj.removeClass().addClass('fade-out-zoom');
                    }
                    if (transition == 'fade-in') {
                        obj.removeClass().addClass('fade-out');
                    }
                    if (transition == 'flip-in') {
                        obj.removeClass().addClass('flip-out');
                    }
                    if (transition == 'dissolve') {
                        obj.removeClass().addClass('dissolve-out');
                    }
                    if (transition == 'slide') {
                        obj.removeClass().addClass('slide-out');
                    }
                    if (transition == 'rotate') {
                        obj.removeClass().addClass('rotate-out');
                    }
                    if (transition == 'roll') {
                        obj.removeClass().addClass('roll-out');
                    }
                    if (transition == 'jack-in-box') {
                        obj.removeClass().addClass('jack-out-box');
                    } else
                        obj.removeClass().addClass('fade-out');


                    // await new Promise(resolve => setTimeout(resolve, 500)); // Wait for fade-out
                    obj.remove();
                }
                let newObject = $('<object id="data" data="' + newData +
                    '">Your browser does not support this file.</object>');

                // Add transition only if it's not a video
                if (transition !== 'none') {
                    newObject.addClass(transition); // Add the chosen transition class
                }
                $('#backgroundData').append(newObject);
            }

            async function setVideo(list) {
                replaceObject('/contents/videos/' + list.name, 'none'); // Skip transition for videos
                const obj = document.getElementById('data');

                obj.addEventListener('load', function() {
                    const video = obj.contentDocument?.querySelector('video');
                    if (video) {
                        // Apply styles to the video
                        video.controls = false;
                        video.style.width = '100%';
                        video.style.height = '100%';
                        video.style.objectFit = 'contain';
                        video.muted = list.mute === 'false' ? false : true;

                        // Apply any other styles needed for background or position
                        // video.style.position = 'absolute';
                        // video.style.top = '50%';
                        // video.style.left = '50%';
                        // video.style.transform = 'translate(-50%, -50%)';
                        // video.style.zIndex = background === 1 ? 2 : 1;

                        if (background === 1) {
                            video.style.borderRadius = '20px';
                        }
                    } else {
                        console.warn('Video element not found in the <object> content.');
                    }
                });
            }


            async function setImage(list) {
                replaceObject('/contents/images/' + list.name, 'zoom-in');
                if (background == 1) {
                    var obj = document.getElementById('data');
                    obj.addEventListener('load', function() {
                        var img = obj.contentDocument.querySelector('img');
                        if (img) {
                            img.style.borderRadius = '20px';
                        }
                    });
                }
            }

            async function setAudio(list) {
                replaceObject('/contents/audios/' + list.name, 'fade-in', );
                var obj = document.getElementById('data');
                obj.addEventListener('load', function() {
                    var video = obj.contentDocument.querySelector('video');
                    if (video) {
                        video.controls = false;
                        video.muted = (list.mute === 'false') ? false : true;
                    }
                });
            }

            async function setLink(list) {
                var content = list.name; // Assuming linkList is defined elsewhere
                var videoExtensions = [".mp4", ".webm", ".ogg"];
                var audioExtensions = [".mp3", ".ogg", ".wav"];
                var fileExtension = content.split('.').pop().toLowerCase(); // Get the file extension

                var youtubeId = null;
                var youtubeRegex = /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                var matches = content.match(youtubeRegex);

                if (matches) {
                    youtubeId = matches[1];
                }
                var mediaContainer = $('#data');
                if (mediaContainer) {
                    $('#data').remove();
                    $('#backgroundData').append('<div id="data" class="fade-in"></div>');
                    mediaContainer = $('#data');
                }

                let height = '60vh';
                let border = 'none';
                if (background == 1) {
                    height = '50vh';
                    border = '20px';
                }

                let mute = 0;
                if (list.mute == 'true') {
                    mute = 1;
                }

                if (youtubeId) {
                    // YouTube Video Embed
                    mediaContainer.append(`
                <iframe src="https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${youtubeId}" style="border-radius:${border}; min-width: inherit; min-height: ${height}; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>Your browser does not support this file.</iframe>
            `);
                } else if (videoExtensions.includes('.' + fileExtension)) {
                    // HTML5 Video
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                <video style="border-radius:${border}; min-width: inherit;min-height: 60vh;" autoplay ${amute} loop>
                    <source src="${content}" type="video/${fileExtension}">
                    Your browser does not support the video tag.
                </video>
            `);
                } else if (audioExtensions.includes('.' + fileExtension)) {
                    // HTML5 Audio
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                <audio style="border-radius:${border}; min-width: inherit;min-height: ${height};" autoplay ${amute} loop>
                    <source src="${content}" type="audio/${fileExtension}">
                    Your browser does not support the audio tag.
                </audio>
            `);
                } else if (isValidUrl(content)) {
                    // Attempt to Embed as Iframe or Open in New Tab if Blocked
                    // <iframe id="iframe" width="100%" height="100%" src="${content}" style="min-width: inherit;min-height: 60vh; border: none;" frameborder="0" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
                    const iframe = $(`
                <iframe id="iframe" width="100%" height="100%" src="${content}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${content}" style="border-radius:${border}; min-width: inherit;min-height: ${height}; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
            `)
                    // mediaContainer.append(`
            //     <iframe id="iframe" width="100%" height="100%" src="${content}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${content}" style="border-radius:${border}; min-width: inherit;min-height: ${height}; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
            // `);

                    mediaContainer.append(iframe);
                } else {
                    // Default Link
                    mediaContainer.append(`
                <a href="${content}" target="_blank">
                    <button class="btn btn-link">View Link</button>
                </a>
            `);
                    // mediaContainer.addClass('fade-in')

                }
                // mediaContainer.find('iframe').on('load', function () {
                //     $(this).addClass('fade-in');
                // });
                $('#backgroundData').append(mediaContainer);

                // Function to validate URL
                function isValidUrl(string) {
                    var res = string.match(/(http|https):\/\/[^\s]+/g);
                    return (res !== null);
                }
            };


            async function setAudioSource(list) {
                let type = 'audios';
                if (list.type === 'Video') {
                    type = 'videos';
                } else if (list.type === 'Image') {
                    type = 'images';
                } else if (list.type === 'Link') {
                    type = 'Link';
                }

                if (audioContent != list.name) {
                    var obj = $('#audioData');
                    if (obj) {
                        $('#audioData').remove();
                    }
                    audioContent = list.name;

                    if (type != 'Link') {
                        var newObject = $('<object id="audioData" data="/contents/' + type + '/' + list.name +
                            '">Your browser does not support this file.</object>');
                        $('#audio').append(newObject);
                        var obj = document.getElementById('audioData');
                        obj.addEventListener('load', function() {
                            var video = obj.contentDocument.querySelector('video');
                            if (video) {
                                video.loop = true;
                            }
                        });
                    } else {
                        var content = list.name;
                        var youtubeId = null;
                        var youtubeRegex =
                            /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                        var matches = content.match(youtubeRegex);

                        if (matches) {
                            youtubeId = matches[1];
                        }
                        var mediaContainer = $('#audioData');
                        if (mediaContainer) {
                            $('#audioData').remove();
                            $('#audio').append('<div id="audioData"></div>');
                            mediaContainer = $('#audioData');
                        }

                        if (youtubeId) {
                            // YouTube Video Embed
                            mediaContainer.append(`
                        <iframe src="https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&controls=0&loop=1&playlist=${youtubeId}" style="min-width: inherit;min-height: 60vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>Your browser does not support this file.</iframe>
                        `);
                        } else if (isValidUrl(content)) {
                            // Attempt to Embed as Iframe or Open in New Tab if Blocked
                            mediaContainer.append(`
                        <iframe id="iframe" width="100%" height="100%" src="${content}?autoplay=1&controls=0&loop=1&playlist=${youtubeId}" style="min-width: inherit;min-height: 60vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
                        `);
                        } else {
                            // Default Link
                            mediaContainer.append(`
                        <a href="${content}" target="_blank">
                            <button class="btn btn-link">View Link</button>
                        </a>
                        `);
                        }
                        $('#audio').append(mediaContainer);

                        // Function to validate URL
                        function isValidUrl(string) {
                            var res = string.match(/(http|https):\/\/[^\s]+/g);
                            return (res !== null);
                        }
                    }
                }
            }

            async function setBackground(list) {
                var content = list.name; // Assuming linkList is defined elsewhere
                var videoExtensions = [".mp4", ".webm", ".ogg"];
                var audioExtensions = [".mp3", ".ogg", ".wav"];
                var imageExtensions = [".jpg", ".jpeg", ".png", ".gif", ".bmp", ".svg"];
                var fileExtension = content.split('.').pop().toLowerCase(); // Get the file extension

                var youtubeId = null;
                var youtubeRegex = /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                var matches = content.match(youtubeRegex);

                if (matches) {
                    youtubeId = matches[1];
                }
                var mediaContentData = $('#backgroundContentData');
                if (mediaContentData) {
                    $('#backgroundContentData').remove();
                }
                var mediaContainer = $('#backgroundData');

                let mute = 0;
                if (list.mute == 'true') {
                    mute = 1;
                }

                if (youtubeId) {
                    // YouTube Video Embed
                    mediaContainer.append(`
                <iframe id="backgroundContentData" src="https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${youtubeId}" style="min-width: 100%;min-height: 60vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>Your browser does not support this file.</iframe>
            `);
                } else if (videoExtensions.includes('.' + fileExtension)) {
                    // HTML5 Video
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                <video id="backgroundContentData" style="min-width: inherit;min-height: 60vh;" autoplay ${amute} loop>
                    <source src="/contents/videos/${content}" type="video/${fileExtension}">
                    Your browser does not support the video tag.
                </video>
            `);
                } else if (audioExtensions.includes('.' + fileExtension)) {
                    // HTML5 Audio
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                <audio id="backgroundContentData" style="min-width: 100%;min-height: 60vh;" autoplay ${amute} loop>
                    <source src="/contents/audios/${content}" type="audio/${fileExtension}">
                    Your browser does not support the audio tag.
                </audio>
            `);
                } else if (imageExtensions.includes('.' + fileExtension)) {
                    // HTML5 Image
                    mediaContainer.append(`
<img id="backgroundContentData" src="/contents/images/${content}"
    alt="Your browser does not support the img tag"
    style="width: 100%; height: 100%;  position: relative; top: 0; left: 0;">
`);

                } else if (isValidUrl(content)) {
                    // Attempt to Embed as Iframe or Open in New Tab if Blocked
                    mediaContainer.append(`
                <iframe id="backgroundContentData" width="100%" height="100%" src="${content}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${content}" style="min-width: 100%;min-height: 60vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
            `);
                } else {
                    // Default Link
                    mediaContainer.append(`
                <a id="backgroundContentData" href="${content}" target="_blank">
                    <button class="btn btn-link">View Link</button>
                </a>
            `);
                }

                // Function to validate URL
                function isValidUrl(string) {
                    var res = string.match(/(http|https):\/\/[^\s]+/g);
                    return (res !== null);
                }
            };

            function timeToSeconds(time) {
                const parts = time.split(':');
                const hours = parseInt(parts[0], 10);
                const minutes = parseInt(parts[1], 10);
                const seconds = parseInt(parts[2], 10);
                return (hours * 3600) + (minutes * 60) + seconds;
            }

            async function processAudios(details) {
                if (details) {
                    let i = 0;
                    while (i < details.length) {
                        const list = details[i];
                        setAudioSource(list);
                        audioDelay = parseInt(list.duration) * 1000;
                        await new Promise(resolve => setTimeout(resolve, audioDelay));
                        i++;
                        if (i == details.length) {
                            i = 0;
                        }
                    }
                }
            }

            async function processPlaylistDetails(details) {
                if (details) {
                    let i = 0;
                    let j = 0;
                    while (i < details.length) {
                        const list = details[i];
                        if (list.type == 'Image') {
                            setImage(list);
                            delay = parseInt(list.duration) * 1000;
                        } else if (list.type == 'Video') {
                            setVideo(list);
                            delay = parseInt(list.duration) * 1000;
                        } else if (list.type == 'Audio') {
                            setAudio(list);
                            delay = parseInt(list.duration) * 1000;
                        } else if (list.type == 'Link') {
                            setLink(list);
                            delay = parseInt(list.duration) * 1000;
                        }

                        if (background == 1) {
                            $("#backgroundData").css("position", "relative");
                            $("#data").css("position", "absolute");
                            $("#data").css("top", '50%');
                            $("#data").css("left", '50%');
                            $("#data").css("z-index", 2);
                            $("#data").css("min-width", '80%');
                            $("#data").css("min-height", '80%');
                            $("#data").css("max-height", '80%');
                            $("#data").css("object-fit", 'contain');
                            $("#data").css("transform", 'translate(-50%, -50%)');
                        } else {
                            $("#data").css("margin", 0);
                            $("#data").css("padding", 0);
                            $("#data").css("position", "absolute");
                            $("#data").css("top", 0);
                            $("#data").css("left", 0);
                            $("#data").css("z-index", 1);
                            $("#data").css("min-width", '100%');
                            $("#data").css("min-height", '100%');
                            $("#data").css("max-height", '100%');
                            $("#data").css("object-fit", 'contain');
                        }

                        if (i == 0 && j == 0) {
                            j++;
                            openFullscreen();
                        }
                        $("#layout").removeAttr('hidden');
                        $("#fullscreen").removeAttr('hidden');
                        await new Promise(resolve => setTimeout(resolve, delay));

                        i++;
                        if (i == details.length) {
                            i = 0;
                        }
                    }
                    if (details.length == 0) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.warning('Template has no content');
                        $('#data').remove();
                    }
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.warning('Template has no content');
                    $('#data').remove();
                }
            }

            async function processBackgroundDetails(details) {
                if (details) {
                    let i = 0;
                    let j = 0;
                    while (i < details.length) {
                        setBackground(details[i]);
                        delay = parseInt(details[i].duration) * 1000;

                        // $("#backgroundData").css("margin", 0);
                        // $("#backgroundData").css("padding", 0);
                        // $("#backgroundContentData").css("position", "absolute");
                        // $("#backgroundContentData").css("top", 0);
                        // $("#backgroundContentData").css("left", 0);
                        // $("#backgroundContentData").css("z-index", 1);
                        // $("#backgroundData").css("min-width", '100%');
                        // $("#backgroundData").css("min-height", '100%');
                        // $("#backgroundData").css("max-height", '100%');
                        // $("#backgroundData").css("object-fit", 'contain');

                        if (i == 0 && j == 0) {
                            j++;
                            openFullscreen();
                        }
                        $("#layout").removeAttr('hidden');
                        $("#fullscreen").removeAttr('hidden');
                        await new Promise(resolve => setTimeout(resolve, delay));

                        i++;
                        if (i == details.length) {
                            i = 0;
                        }
                    }
                    if (details.length == 0) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.warning('Template has no content');
                        $('#backgroundContentData').remove();
                    }
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.warning('Background has no content');
                    $('#backgroundContentData').remove();
                }
            }

            $(document).ready(function() {

                var obj = $('#data');
                var backgroundObj = $('#backgroundContentData');
                var audioObj = $('#audioData');
                if (obj) {
                    $('#data').remove();
                }
                if (backgroundObj) {
                    $('#backgroundContentData').remove();
                }
                if (audioObj) {
                    $('#audioData').remove();
                }

                let device_id = $('#device').val();
                $.ajax({
                    type: "get",
                    url: "/api/search-device-info/" + device_id,
                    success: function(response) {
                        console.log(response)
                        if (response.status_code == 200) {
                            $("#backgroundData").css("position", 'relative');
                            $("#backgroundData").css("overflow", 'hidden');
                            $("#backgroundData").css("height", '60vh');
                            if (response.data.template_details) {
                                if (response.data.template_details.mute == 'false') {
                                    processAudios(response.data.contents.background_audio)
                                }
                                if (response.data.contents.background) {
                                    background = 1;
                                    processBackgroundDetails(response.data.contents.background)
                                }
                            }
                            processPlaylistDetails(response.data.contents.main_zone);
                            $("#device_id").prop('disabled', true);
                            $("#device_id").css("background-color", 'transparent');



                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.warning('Status Code 200 not returned');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.warning(JSON.parse(jqXHR.responseText).unsuccessful);
                    }
                });
            });

            var elem = document.getElementById("layout");

            function openFullscreen() {
                if (!document.fullscreenElement) {
                    if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                    } else if (elem.webkitRequestFullscreen) {
                        elem.webkitRequestFullscreen();
                    } else if (elem.msRequestFullscreen) {
                        elem.msRequestFullscreen();
                    } else if (elem.mozRequestFullScreen) {
                        elem.mozRequestFullScreen();
                    }
                }
            }

            function closeFullscreen() {
                if (document.fullscreenElement) {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    }
                }
            }

            $(document).on("click", "#refreshBtn", function(e) {
                e.preventDefault();
                location.reload(true)
            });
        </script>
    @endpush
</x-layout>
