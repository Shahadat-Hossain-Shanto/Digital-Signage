<x-layout titlePage="Links" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Links"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content">Content types</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <style>
            .link-wrapper {
                position: relative;
                display: inline-block;
            }

            .menu-container {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 10;
                border: 0;
            }

           


        </style>


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                    <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white mx-3"><strong>Links</strong></h6>
                            </div>
                        </div>
                    </div>
                    <div class="me-3 my-3">
                        <div class="text-end">
                            <a class="btn bg-gradient-warning mb-0" href="{{ route('content.create.link') }}">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Link
                            </a>
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('content.view') }}">
                                <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                @if ($linkLists && $linkLists->count() > 0)
                                    @foreach ($linkLists as $linkList)
                                        <div class="col-lg-4 mb-2">
                                            <div class="link-wrapper">
                                                @php
                                                    $content = $linkList->content;
                                                    $videoExtensions = ['.mp4', '.webm', '.ogg'];
                                                    $audioExtensions = ['.mp3', '.ogg', '.wav'];
                                                    $fileExtension = strtolower(pathinfo($content, PATHINFO_EXTENSION));

                                                    // Detect YouTube link and extract ID
                                                    $youtubeId = null;
                                                    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $content, $matches)) {
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
                                                    <div class="iframe-container" style="position: relative; width: 350px; height: 200px;overflow: hidden;">
                                                        <iframe id="iframe-{{ $linkList->id }}" width="100%" height="100%" src="{{ $content }}" frameborder="0" style="border: none;" 
                                                            scrolling="no"   onerror="handleIframeError(this, '{{ $content }}')">
                                                        </iframe>
                                                       
                                                    </div>
                                                @else
                                                    {{-- Default Link --}}
                                                    <a href="{{ asset($content) }}" target="_blank">
                                                        <button class="btn btn-link">View Link</button>
                                                    </a>
                                                @endif

                                                {{-- Delete Button --}}
                                                <div class="menu-container">
                                                    <button class="menu-btn dlt-btn bg-transparent border-0" style="position: absolute; top: 10px; right: 10px;" id="{{ $linkList->id }}">
                                                        <i class="material-icons text-danger">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info" role="alert">
                                        <strong>Sorry!</strong> No links found.
                                    </div>
                                @endif
                            </div>
                            <div class="mt-3">
                                {!! $linkLists->links('vendor.pagination.custom') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footers.auth></x-footers.auth>
</div>

<script>
    // JavaScript to handle fullscreen toggle
    function toggleFullscreen(iframeId) {
        const iframe = document.getElementById(iframeId);
        if (iframe.requestFullscreen) {
            iframe.requestFullscreen();
        } else if (iframe.webkitRequestFullscreen) { // Safari compatibility
            iframe.webkitRequestFullscreen();
        } else if (iframe.msRequestFullscreen) { // IE/Edge compatibility
            iframe.msRequestFullscreen();
        }
    }
</script>





    </main>
    <x-plugins></x-plugins>
    <div class="modal fade" id="DELETElinkMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETElinkFORM" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}


                    <div class="modal-body">
                        <input type="hidden" name="" id="id">
                        <h5 class="text-center">Are you sure you want to delete?</h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel_btn btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="delete btn btn-outline-danger">Yes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @push('js')
    <!-- Video JS -->
    <script src="https://vjs.zencdn.net/8.10.0/link.min.js"></script>

    <!-- Themes for Link.js -->
    <link href="https://unpkg.com/@linkjs/themes@1/dist/city/index.css" rel="stylesheet">
    <link href="https://unpkg.com/@linkjs/themes@1/dist/fantasy/index.css" rel="stylesheet">
    <link href="https://unpkg.com/@linkjs/themes@1/dist/forest/index.css" rel="stylesheet">
    <link href="https://unpkg.com/@linkjs/themes@1/dist/sea/index.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Check for flash messages and display them using alertify
            @if (session('status'))
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('{{ session('status') }}');
            @endif

            @if (session('error'))
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('{{ session('error') }}');
            @endif

            // Handle delete button click
            $(document).on('click', '.dlt-btn', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $('#id').val(id);
                $('#DELETElinkFORM').attr('action', '/content-delete-link/' + id);
                $('#DELETElinkMODAL').modal('show');
            });

            // Close modal when cancel button is clicked
            $(".cancel_btn").click(function(e) {
                e.preventDefault();
                $('#DELETElinkMODAL').modal('hide');
            });

            var player = videojs('my-video', {
                controls: true,
                autoplay: false,
                preload: 'auto'
            });
        });
    </script>

    @endpush
</x-layout>
