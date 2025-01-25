<x-layout titlePage="Videos" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Videos"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content">Content types</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <style>
            .video-wrapper {
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
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Videos </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0" href="{{ route('content.create.video') }}">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Video
                                    </a>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('content.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body" style="text-align: center;">
                                    <div class="row">
                                        @if (!is_null($videoLists) && $videoLists->count() > 0)
                                            @foreach ($videoLists as $videoList)
                                                <div class="col-lg-4 mb-2">
                                                    <div class="video-wrapper">
                                                        <video id="video-{{ $videoList->id }}" width="350"
                                                            height="200" class="video-js vjs-theme-city"
                                                            data-setup="{}" controls>
                                                            <source
                                                                src="{{ asset('contents/videos/' . $videoList->content) }}"
                                                                type="video/mp4">
                                                        </video>
                                                        <div class="menu-container">
                                                            <button class="menu-btn dlt-btn bg-transparent border-0" style="position: absolute; top: 10px; right: 10px;"id="{{ $videoList->id }}">  <i class="material-icons text-danger">delete</i></button>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-info" role="alert">
                                                <strong> Sorry! </strong> No videos found.
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        {!! $videoLists->links('vendor.pagination.custom') !!}
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
    <div class="modal fade" id="DELETEvideoMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEvideoFORM" method="POST" enctype="multipart/form-data">

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
        {{-- Video JS --}}
        <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
        <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>

        <!-- City -->
        <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet">

        <!-- Fantasy -->
        <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">

        <!-- Forest -->
        <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">

        <!-- Sea -->
        <link href="https://unpkg.com/@videojs/themes@1/dist/sea/index.css" rel="stylesheet">
        <script>
            function toggleMenu(event, videoId) {
                event.stopPropagation(); // Prevent event bubbling
                const menu = document.getElementById('menu-' + videoId);
                menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
            }



            // Close all dropdowns when clicking outside
            window.addEventListener('click', function(event) {
                var menus = document.querySelectorAll('.menu-dropdown');
                menus.forEach(function(menu) {
                    if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                        menu.style.display = 'none';
                    }
                });
            });
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
            $(document).on('click', '.dlt-btn', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $('#id').val(id);
                $('#DELETEvideoFORM').attr('action', '/content-delete-video/' + id);
                $('#DELETEvideoMODAL').modal('show');

            });

            $(".cancel_btn").click(function(e) {
                e.preventDefault();
                $('#DELETEvideoMODAL').modal('hide');


            });
        </script>
    @endpush
</x-layout>
