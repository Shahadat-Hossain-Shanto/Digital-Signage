<x-layout titlePage="Video Playlists" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='video.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Video Playlists" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Video Playlists </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                <a class="btn bg-gradient-warning mb-0" href="{{ route('video.playlist.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Playlist
                                </a>
                                @if ( !is_null($playlists) )
                                    <div class="card-body px-0 pb-2" style="text-align: center;">
                                        <div class="row">
                                            @foreach ( $playlists as $playlist )
                                                <div class="col-lg-2">
                                                    <div class="icon-container" style="display: flex; flex-direction: column; align-items: center;">
                                                        <a href="{{ route('video.playlist.contentlist', $playlist->playlist_name)}}"><i class="material-icons" style="font-size: 100px;">video_library</i></a>
                                                        <span class="icon-text" style="margin-top: -15px;">{{ $playlist->playlist_name }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <!-- the jQuery Library -->


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        // new MultiSelectTag('countries')  // id
        new MultiSelectTag('edit_videos', {
            rounded: true,    // default true
            shadow: true,      // default false
            placeholder: 'Search',  // default Search...
            tagColor: {
                textColor: '#327b2c',
                borderColor: '#92e681',
                bgColor: '#eaffe6',
            },
            onChange: function(values) {
                // console.log(values)
            }
        })
    </script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable( {
                processing: true,
                // serverSide: true,
                language: { processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},

                destroy: true,
                order: [[0, 'asc']],
                paging: true,
                pageLength: 10,
                responsive: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax: {
                    url: "/image-playlist-list",
                },
                columns: [
                    {
                        data: "id",
                        "render": function ( data, type, row, meta ) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: "template_name" },
                    { data: "full_screen" },
                    { data: "screen_height" },
                    { data: "screen_width" },
                    { data: "enable_audio" },
                    { data: "footer_image" },
                    { data: "left_sidebar" },
                    { data: "right_sidebar" },
                    { data: "duration" },
                    { data: "image_file_name" },
                    {
                        data: null,
                        "render": function (data, type, row) {
                            // Generate buttons using HTML
                            return '<a href="" id="' + row.id + '" class="editIcon" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i></a>' +
                            '<a href="" id="' + row.id + '" class="deleteIcon"><i class="fas fa-trash" style="color: red"></i></a>';
                        }
                    },
                    /*and so on, keep adding data elements here for all your columns.*/
                ],

            });

            // edit user ajax request
            $(document).on('click', '.editIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                // console.log(id);
                // alert(id);
                $.ajax({
                    type: "GET",
                    url: "",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        // console.log(res);
                        $("#edit_duration").val(res.duration);
                        $("#edit_template_screen").val(res.template_screen);
                        $("#screen_id").val(res.id);
                    }
                });
            });

            // Update data ajax request
            $(document).on('submit', '#updateForm', function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                // let id     = $('#expensiveType_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('video.playlist.update') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (res) {
                        // console.log(res);
                        if (res.status == 400) {
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');

                            $('.edit_durationError').text(res.errors.edit_duration);
                            $('.edit_templateError').text(res.errors.edit_template_screen);
                        } else {
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');
                            $('#updateForm')[0].reset();
                            $("#updateModal").modal('hide');
                            location.reload();
                            // $('.table').load(location.href+' .table');

                            Command: toastr["success"]("Updated!", "Successfully")
                                toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
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
                        }
                    }
                });
            });

            // delete user ajax request

        });
    </script>
    @endpush
</x-layout>

