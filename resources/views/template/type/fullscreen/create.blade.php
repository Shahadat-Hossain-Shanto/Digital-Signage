<x-layout titlePage="Create Full Screen Template" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='template.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Create Full Screen Template" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/template"> Template</a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/fullscreen-template-list">Full Screen Template List</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Create Full Screen Template </strong></h6>
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
                                   <div class=" row">
                                    <div class="col-md-6">
                                        <form action="" method="" id="addForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-md-6 mb-1 form-group">
                                                    <label for="form-label">Template Name</label>
                                                    <input type="text" class="form-control border border-2 p-2" name="template_name" id="template_name">
                                                    <div class="template_nameError text-danger errors d-none"></div>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <label for="form-label">Rotation</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="rotation" id="rotation" >
                                                            <option disabled selected>Please Select any option</option>
                                                            <option value="false">Off</option>
                                                            <option value="true">On</option>
                                                        </select>
                                                    <div class="rotationError text-danger errors d-none"></div>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <label for="form-label">Playlist Name</label>
                                                    <select class="form-select mb-3" aria-label="Default select example" name="playlist_name" id="playlist_name" >
                                                        <option disabled selected>Please Select a Playlist</option>
                                                    </select>
                                                    <div class="playlist_nameError text-danger errors d-none"></div>
                                                </div>
                                                <div class="col-md-6 mt-4 pt-2">
                                                    <button id="addtotable" class="btn bg-gradient-primary mb-0" type="submit">
                                                        Create
                                                    </button>
                                                    <button class="btn bg-gradient-danger mb-0" type="reset">
                                                        Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
  
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Playlist name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
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
    </div>
    @push('js')


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: "{{ route('template.createList') }}",
                data: {
                        value: "full",
                    },
                success: function (res) {
                    // console.log(res);
                    // Clear existing options
                    $("#playlist_name").empty();
                    $("#playlist_name").append('<option disabled selected>Please Select a Playlist</option>');
                    $("#playlist_name").append('<option disabled>Image Playlist</option>');
                    // Add new options based on response
                    $.each(res.ImagePlaylists, function(key, value) {
                        $("#playlist_name").append('<option value="' + value.playlist_name + '">' + value.playlist_name + '</option>');
                    });
                    $("#playlist_name").append('<option disabled>Video Playlist</option>');
                    // Add new options based on response
                    $.each(res.VideoPlaylists, function(key, value) {
                        $("#playlist_name").append('<option value="' + value.playlist_name + '">' + value.playlist_name + '</option>');
                    });
                }
            });

            $("#playlist_name").change(function () {

                var playlist_name          =$(this).val();
                $('#tbody').append(`
                    <tr>
                        <td>${playlist_name}</td>
                        <td><a class="delete-row text-danger ms-2 h5"><i class="material-icons">remove_circles</i></a></td> <!-- Delete button -->
                    </tr>`);

                // Event delegation for dynamically created delete buttons
                $('#tbody').on('click', '.delete-row', function() {
                    $(this).closest('tr').remove(); // Remove the closest parent row
                });
            });

            // Add data
            $(document).on('submit', '#addForm', function (e) {
                e.preventDefault();

                var template_name   =$('#template_name').val();
                var rotation        =$('#rotation').val();

                let data= {};
                var playlists=[];

                $('.table tbody > tr').each(function () {
                    const playlist = {};
                    playlist["playlist_name"] = $(this).find("td:eq(0)").text();

                    playlists.push(playlist);
                });

                data["template_name"]   =template_name;
                data["full_screen"]     ="true";
                data["height"]          =0;
                data["width"]           =0;
                data["footer"]          ="false";
                data["left_sidebar"]    ="false";
                data["right_sidebar"]   ="false";
                data["rotation"]        =rotation;
                data["playlists"]       =playlists;

                console.log(data);
                $.ajax({
                    type: "POST",
                    url: "{{ route('template.store') }}",
                    data: JSON.stringify(data),
                    dataType: "json",
                    contentType: "application/json",
                    success: function (res) {
                        console.log(res);

                        if (res.status == 400) {
                            if(res.errors){
                                $('.errors').html('');
                                $('.errors').removeClass('d-none');

                                $('.template_nameError').text(res.errors.template_name);
                                $('.rotationError').text(res.errors.rotation);
                                alertify.set('notifier','position', 'top-right');
                                alertify.error('Unsuccessfully!');

                            }
                            else{
                                alertify.set('notifier','position', 'top-right');
                                alertify.error(res.messsege);
                            }
                        } else {
                            $('#addForm')[0].reset();
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');
                            // $('.table').load(location.href+' .table');
                            // Redirect to another page
                            window.location.href = "{{ route('template.fullscreen.view') }}";

                            alertify.set('notifier','position', 'top-right');
                            alertify.success('Added successfully!');
                        }
                    }
                });
            });
        });
    </script>
    @endpush
</x-layout>











