<x-layout titlePage="Edit Full Screen Template" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='template.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Full Screen Template"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"> Template</a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"> Template List</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Edit Full Screen Template </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('template.fullscreen.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="hidden" id="template_id" value="{{ $id }}">

                                            <form action="" method="POST" id="updateForm"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-md-6 mb-1">
                                                        <label for="form-label">Template Name</label>
                                                        <input type="text" class="form-control border border-2 p-2"
                                                            name="edit_template_name" id="edit_template_name"
                                                            value="{{ $templateList->template_name }}" readonly>
                                                        <div class="edit_template_nameError text-danger errors d-none">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-1" hidden>
                                                        <label for="form-label">Full Screen</label>
                                                        <input type="text" class="form-control border border-2 p-2"
                                                            name="edit_full_screen" id="edit_full_screen"
                                                            value="{{ $templateList->full_screen }}" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-1" hidden>
                                                        <label class="form-label">Screen Height </label>
                                                        <input type="text" class="form-control border border-2 p-2"
                                                            name="edit_height" id="edit_height"
                                                            value="{{ $templateList->screen_height }}" readonly>
                                                        <div class="heightError text-danger errors d-none"></div>
                                                    </div>
                                                    <div class="col-md-6 mb-1" hidden>
                                                        <label class="form-label">Screen Width </label>
                                                        <input type="text" class="form-control border border-2 p-2"
                                                            name="edit_width" id="edit_width"
                                                            value="{{ $templateList->screen_width }}" readonly>
                                                        <div class="widthError text-danger errors d-none"></div>
                                                    </div>



                                                    <div class="col-md-6 mb-1">
                                                        <label for="form-label">Rotation</label>
                                                        <select class="form-select mb-3"
                                                            aria-label="Default select example" name="edit_rotation"
                                                            id="edit_rotation">
                                                            <option disabled selected>Please Select any option</option>
                                                            <option value="false"
                                                                @if ($templateList->rotation == 'false') selected @endif>Off
                                                            </option>
                                                            <option value="true"
                                                                @if ($templateList->rotation == 'true') selected @endif>On
                                                            </option>
                                                        </select>
                                                        <div class="edit_rotationError text-danger errors d-none"></div>
                                                    </div>

                                                    <div class="col-md-6 mb-1">
                                                        <label for="form-label">Playlist Name</label>
                                                        <select class="form-select mb-3"
                                                            aria-label="Default select example"
                                                            name="edit_playlist_name" id="edit_playlist_name">
                                                            <option selected>Please Select a playlist</option>
                                                            <option disabled> Image playlist</option>

                                                            <!-- For Image Playlists -->
                                                            @foreach ($ImagePlaylists as $playlist)
                                                                <option value="{{ $playlist->id }}">
                                                                    {{ $playlist->playlist_name }}</option>
                                                            @endforeach
                                                            <option disabled>video playlist</option>

                                                            <!-- For Video Playlists -->
                                                            @foreach ($VideoPlaylists as $playlist)
                                                                <option value="{{ $playlist->id }}">
                                                                    {{ $playlist->playlist_name }}</option>
                                                            @endforeach

                                                        </select>
                                                        <div class="edit_playlist_nameError text-danger errors d-none">
                                                        </div>
                                                    </div>



                                                    <div class="col-md-3 mt-4 pt-1">
                                                        <button type="submit" class="btn bg-gradient-primary mb-0">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <div class="table-responsive">
                                                <table class="table playlisttable">
                                                    <thead>
                                                        <tr>
                                                            <th>Playlist name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @foreach ($playlists as $playlists)
                                                            <tr>
                                                                <td>{{ $playlists->playlist_name }}</td>
                                                                <td><a class="editIcon text-danger ms-2 h5"data-playlist-name="{{ $playlists->playlist_name }}"
                                                                        style="cursor: pointer;"><i class="fas fa-edit"
                                                                            style="color: rgb(26, 241, 19)"></i></a>
                                                                    <a class="deleteIcon text-danger ms-2 h5"><i
                                                                            class="material-icons"
                                                                            style="cursor: pointer;">remove_circles</i></a>
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
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>



    </main>
    <x-plugins></x-plugins>
    @push('js')
        <!-- the jQuery Library -->


        <!-- Toastr JS  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- Toastr calling JS Methods -->
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        <script>
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";

                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        </script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

        <script>
            $('.deleteIcon').on('click', function() {
                $(this).closest('tr').fadeOut(300, function() {
                    $(this).remove();
                });
            });

            $(".playlisttable tbody").sortable({
                cursor: 'move',
                opacity: 0.6,
            }).disableSelection();

            $("#edit_playlist_name").change(function() {

                var playlist_name = $(this).find('option:selected').text();
                $('#tbody').append(`
                    <tr>
                        <td>${playlist_name}</td>
                        <td><a class="editIcon text-danger ms-2 h5"data-playlist-name="${playlist_name}"><i class="fas fa-edit" style="color: rgb(26, 241, 19)"></i></a>
                            <a class="delete-row text-danger ms-2 h5"onclick="  $(this).closest('tr').fadeOut(300, function() {
                    $(this).remove();});" class="deleteIcon"><i class="material-icons">remove_circles</i></a></td>
                    </tr>`);

                // Event delegation for dynamically created delete buttons
                $('.editIcon').click(function(e) {
                    e.preventDefault();
                    var playlistName = $(this).data('playlist-name');
                    $.ajax({
                        type: "get",
                        url: "/get-playlist-type",
                        data: {
                            playlistName: playlistName
                        },
                        success: function(response) {
                            if (response.type == "Image") {
                                $(location).attr('href', '/image-playlist-edit/' + playlistName);


                            } else if (response.type == "Video") {
                                $(location).attr('href', '/video-playlist-edit/' + playlistName);

                            }

                        }
                    });
                });

            });
            $('.editIcon').click(function(e) {
                e.preventDefault();
                var playlistName = $(this).data('playlist-name');
                $.ajax({
                    type: "get",
                    url: "/get-playlist-type",
                    data: {
                        playlistName: playlistName
                    },
                    success: function(response) {
                        if (response.type == "Image") {
                            $(location).attr('href', '/image-playlist-edit/' + playlistName);


                        } else if (response.type == "Video") {
                            $(location).attr('href', '/video-playlist-edit/' + playlistName);

                        }

                    }
                });
            });
            $(document).on('submit', '#updateForm', function(e) {
                e.preventDefault();
                let id = $('#template_id').val();
                var template_name = $('#edit_template_name').val();
                var rotation = $('#edit_rotation').val();

                let data = {};
                var playlists = [];

                $('.table tbody > tr').each(function() {
                    const playlist = {};
                    playlist["playlist_name"] = $(this).find("td:eq(0)").text();

                    playlists.push(playlist);
                });

                data["template_name"] = template_name;
                data["full_screen"] = "true";
                data["height"] = 0;
                data["width"] = 0;
                data["footer"] = "false";
                data["left_sidebar"] = "false";
                data["right_sidebar"] = "false";
                data["rotation"] = rotation;
                data["playlists"] = playlists;

                $.ajax({
                    type: "POST",
                    url: "/template-list-update/" + id,
                    data: JSON.stringify(data),
                    dataType: "json",
                    contentType: "application/json",
                    success: function(res) {
                        console.log(res)

                        if (res.status == 400) {
                            if (res.errors) {
                                $('.errors').html('');
                                $('.errors').removeClass('d-none');

                                $('.template_nameError').text(res.errors.template_name);
                                $('.rotationError').text(res.errors.rotation);
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.error('Unsuccessfully!');

                            } else {
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.error(res.messsege);
                            }
                        } else {
                            $('#updateForm')[0].reset();
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');
                            // window.location.href = ;

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success('Added successfully!');
                        }
                    }
                });
            });
        </script>
    @endpush
</x-layout>
