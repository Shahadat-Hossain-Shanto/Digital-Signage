<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<x-layout titlePage="Templates" bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar bar activePage='template.list.view'></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Templates" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Templates </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0" id="template_create">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Template
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="row g-2 no-gutters" id="card-container">
                                            @if (!is_null($templateContents) && count($templateContents) > 0)

                                                @foreach ($templateContents as $template)
                                                    <div class="col-md-3 col-sm-6 col-12 mb-2 p-0">
                                                        <a href="/template-contents/{{ $template["id"] }}"
                                                            style="text-decoration: none;">
                                                            <div class="card border-0 position-relative content-card"
                                                                style="width: 90%; height: 300px; overflow: hidden; border-radius: 15px;">
                                                                <!-- Button in the top-right corner -->
                                                                <button class="btn btn-light hover-button"
                                                                    style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                                                    <i class="bi bi-x-circle"></i>
                                                                </button>

                                                                <div class="card-body p-0 position-relative">
                                                                    @if ($template["content"]["content_type"] == "Image")
                                                                        <img src="{{ asset("contents/images/" . ($template["content"]["content_name"] ?? $template["content"]["content"])) }}"
                                                                            alt="{{ $template["content"]["content_name"] ?? $template["content"] }}"
                                                                            class="img-fluid rounded"
                                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                                    @elseif ($template["content"]["content_type"] == "Video")
                                                                        <video
                                                                            src="{{ asset("contents/videos/" . ($template["content"]["content_name"] ?? $template["content"]["content"])) }}"
                                                                            class="img-fluid rounded"
                                                                            style="width: 100%; height: 100%; object-fit: cover;"
                                                                            muted loop>
                                                                        </video>
                                                                    @elseif ($template["content"]["content_type"] == "Link")
                                                                        <div class="link-wrapper"
                                                                            style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                                                            @php
                                                                                $content =
                                                                                    $template["content"][
                                                                                        "content_name"
                                                                                    ];
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
                                                                                <div
                                                                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #000;">
                                                                                    <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                                                                                        alt="YouTube Video Preview"
                                                                                        style="width: 100%; height: auto; object-fit: cover;">
                                                                                </div>
                                                                            @elseif (filter_var($content, FILTER_VALIDATE_URL))
                                                                                <span
                                                                                    style="color: #007bff; font-weight: bold; text-decoration: none;">
                                                                                    {{ $content }}
                                                                                </span>
                                                                            @else
                                                                                <span
                                                                                    style="color: red; font-weight: bold;">Invalid
                                                                                    Link</span>
                                                                            @endif
                                                                        </div>
                                                                    @else
                                                                        <!-- Fallback for no content -->
                                                                        <div class="no-content"
                                                                            style="width: 100%; height: 100%; background-color: black; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; font-weight: bold;">
                                                                            No Contents Available
                                                                        </div>
                                                                    @endif

                                                                    <!-- Bottom-left text -->
                                                                    <div class="bottom-left-text"
                                                                        style="position: absolute; bottom: 15px; left: 15px; color: white; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8); font-size: 14px;">
                                                                        {{ $template["template_name"] }} <br>
                                                                        {{ $template["template_type"] }} +
                                                                        {{ $template["template_layout"] }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="alert alert-info text-center" role="alert">
                                                    <strong> Sorry! </strong> No Templates found.
                                                </div>
                                            @endif

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

        {{-- @include('template.edit') --}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">New Template</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 mb-1">
                            <label for="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control border border-2 p-2" name="name" id="name"
                                placeholder='Type template name' required>
                            <div class="nameError text-danger errors d-none"></div>
                        </div>
                        <div class="col-12 mb-1">
                            <label for="form-label">Orientation <span class="text-danger">*</span></label>
                            <div class='row p-2 text-center'>
                                <div class='col-6 p-2 pt-4'>
                                    <div class="orientation portrait-full-screen" data-layout="Portrait">
                                    </div>
                                    <label class="form-label">Portrait</label>
                                </div>
                                
                                <div class='col-1 p-2 pt-4'>
                                </div>
                                <div class='col-3 p-2 pt-4'>
                                    <div class="orientation landscape-full-screen" data-layout="Landscape">
                                    </div>
                                    <label class="form-label">Landscape</label>
                                </div>
                                <div class='col-2 p-2 pt-4'>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label">Layout <span class="text-danger">*</span></label>
                            <input type="text" class="form-control border border-2 p-2" name="layout" id="layout"
                                placeholder='Type template layout' required disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <a href="{{ route("template.list.view") }}">
                                Close
                            </a></button>
                        <button type="button" class="btn btn-primary" id="continue">Continue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Layout Modal -->
        <div class="modal fade" id="layoutModal" tabindex="-1" aria-labelledby="layoutModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content"
                    style="height: 80vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <div class="modal-header bg-gradient-primary w-100">
                        <h1 class="modal-title fs-5 text-white" id="layoutModalLabel">Layouts</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body col-12 row layout justify-content-center align-items-center" id="landscape"
                        hidden>
                        <div class="col-3 mb-1 p-4 text-center">
                            <div class="layout-card full-screen landscape-full-screen" data-layout="Full Screen">
                            </div>
                            <label class="form-label">Full Screen</label>
                        </div>
                        <div class="col-3 mb-1 p-4 text-center">
                            <div class="layout-card landscape-full-screen-with-background"
                                data-layout="Full Screen with Background">
                                <div class="landscape-full-screen-with-background-zone-1"></div>
                            </div>
                            <label class="form-label">Full Screen with Background</label>
                        </div>
                        <div class="col-3 mb-1 p-4 text-center">
                            <div class="layout-card landscape-custom-layout" data-layout="4 Zones Layout">
                                <div class="custom-layout-signage"></div>
                                <div class="custom-layout-banner"></div>
                                <div class="custom-layout-clock"></div>
                                <div class="custom-layout-weather"></div>
                            </div>
                            <label class="form-label">4 Zones Layout</label>
                        </div>

                    </div>
                    <div class="modal-body col-12 row layout justify-content-center align-items-center" id="portrait"
                        hidden>
                        <div class="col-3 mb-1 p-4 text-center">
                            <div class="layout-card full-screen portrait-full-screen" data-layout="Full Screen">
                            </div>
                            <label class="form-label">Full Screen</label>
                        </div>
                        <div class="col-3 mb-1 p-4 text-center">
                            <div class="layout-card portrait-full-screen-with-background"
                                data-layout="Full Screen with Background">
                                <div class="portrait-full-screen-with-background-zone-1"></div>
                            </div>
                            <label class="form-label">Full Screen with Background</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <x-plugins></x-plugins>
    <div class="modal fade" id="DELETEtemplateMODAL" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="DELETEtemplateFORM" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}

                    <div class="modal-body">
                        <input type="hidden" name="" id="id">
                        <h5 class="text-center">Are you sure you want to delete?</h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                    </div>

                </form>

            </div>
        </div>
    </div>
    @push("js")
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Select all cards inside the container
                const cards = document.querySelectorAll('.content-card');

                cards.forEach(card => {
                    // Find the button inside each card
                    const button = card.querySelector('.hover-button');

                    // Initially hide the button to ensure it's invisible on page load
                    button.style.opacity = '0';

                    // When mouse enters the card, show the button
                    card.addEventListener('mouseenter', function() {
                        button.style.opacity = '1'; // Make the button visible
                    });

                    // When mouse leaves the card, hide the button
                    card.addEventListener('mouseleave', function() {
                        button.style.opacity = '0'; // Hide the button
                    });
                });
            });
        </script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            $(document).on('click', '#template_create', function(e) {
                $('#exampleModal').modal('show');
                $('#name').val('');
                $('.orientation').parent().removeClass('bg-selected');
                $('#layout').val('');
                // $('.common_property').attr('hidden', true);

                $('.orientation').click(function() {
                    $('.orientation').parent().removeClass('bg-selected');
                    $(this).parent().addClass('bg-selected');

                    var selectedOrientation = $('.orientation').parent('.bg-selected').find('.orientation')
                        .data(
                            'layout');
                    $('#template_type').val(selectedOrientation);
                    if (selectedOrientation == 'Portrait') {
                        $('#portrait').removeAttr('hidden');
                        $('#landscape').attr('hidden', true);
                        $('#layoutModalLabel').text('Portrait Layouts')
                    } else if (selectedOrientation == 'Landscape') {
                        $('#landscape').removeAttr('hidden');
                        $('#portrait').attr('hidden', true);
                        $('#layoutModalLabel').text('Landscape Layouts')
                    }
                    $('#layoutModal').modal('show');
                });

                $('.layout-card').click(function() {
                    $('.layout-card').parent().removeClass('bg-selected');
                    $(this).parent().addClass('bg-selected');
                    // });

                    // $('#select').click(function() {
                    var selectedLayout = $('.layout-card').parent('.bg-selected').find('.layout-card').data(
                        'layout');
                    $('#layout').val(selectedLayout || '');
                    $('#layoutModal').modal('hide');
                });
            });

            $(document).on('click', '#continue', function(e) {
                e.preventDefault();
                let name = $('#name').val();
                let orientation = $('.orientation').parent('.bg-selected').find('.orientation')
                    .data('layout');;
                let layout = $('#layout').val();

                let data = {
                    template_name: name,
                    template_type: orientation,
                    template_layout: layout
                };

                if (name && orientation != 'default' && layout) {
                    console.log(data);

                    // Add Tamplate
                    $.ajax({
                        type: "POST",
                        url: "{{ route("template.create") }}",
                        data: data,
                        success: function(res) {
                            console.log(res);
                            if (res.status == 401) {
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.warning(res.message);
                            } else if (res.status == 200) {
                                $('#exampleModal').modal('hide');

                                alertify.set('notifier', 'position', 'top-right');
                                alertify.success('Template Added Successfully');

                                // Redirect to another page
                                window.location.href = "{{ route("template.edit", ["id" => ":id"]) }}"
                                    .replace(':id', res.id);
                            } else if (res.status == 400) {
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.warning('Fill-up the Required Fields!');
                            }
                        }
                    });
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.warning('Name or Orientation and Layout can not be empty');
                }

            });
        </script>

        <script>
            $(document).ready(function() {


                $(document).on('click', '.deleteIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');

                    $('#id').val(id);
                    $('#DELETEtemplateFORM').attr('action', '/template-list-delete/' + id);
                    $('#DELETEtemplateMODAL').modal('show');
                });
                // delete user ajax request

            });
            $('.cancel_btn').click(function(e) {
                e.preventDefault();
                $('#DELETEtemplateMODAL').modal('hide');

            });
        </script>
    @endpush
</x-layout>
