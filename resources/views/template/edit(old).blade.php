<!-- Modal -->
{{-- <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Template List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="screen_id" id="screen_id">

                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-label" >Template Name </label>
                            <input type="text" class="form-control border border-2 p-2" name="edit_template_name" id="edit_template_name">
                            <div class="edit_template_nameError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Template Type</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_template_type" id="edit_template_type" >
                                    <option disabled>Please Select any option</option>
                                    <option value="Video">Video</option>
                                    <option value="Image">Image</option>
                                </select>
                            <div class="edit_template_typeError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Full Screen</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_full_screen" id="edit_full_screen" >
                                    <option disabled>Please Select any option</option>
                                    <option value="false">Off</option>
                                    <option value="true">On</option>
                                </select>
                            <div class="edit_full_screenError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Screen Height </label>
                            <input type="text" class="form-control border border-2 p-2" name="edit_height" id="edit_height">
                            <div class="edit_heightError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Screen Width </label>
                            <input type="text" class="form-control border border-2 p-2" name="edit_width" id="edit_width">
                            <div class="edit_widthError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Footer Image</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_footer_image" id="edit_footer_image" >
                                    <option disabled>Please Select any option</option>
                                    <option value="false">Off</option>
                                    <option value="true">On</option>
                                </select>
                            <div class="edit_footer_imageError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Audio</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_enable_audio" id="edit_enable_audio" >
                                    <option disabled>Please Select any option</option>
                                    <option value="mute">Mute</option>
                                    <option value="unmute">Unmute</option>
                                </select>
                            <div class="edit_enable_audioError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Left Sidebar</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_left_sidebar" id="edit_left_sidebar" >
                                    <option disabled>Please Select any option</option>
                                    <option value="false">Off</option>
                                    <option value="true">On</option>
                                </select>
                            <div class="edit_left_sidebarError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Right Sidebar</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_right_sidebar" id="edit_right_sidebar" >
                                    <option disabled>Please Select any option</option>
                                    <option value="false">Off</option>
                                    <option value="true">On</option>
                                </select>
                            <div class="edit_right_sidebarError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Rotation</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_rotation" id="edit_rotation" >
                                    <option disabled>Please Select any option</option>
                                    <option value="false">Off</option>
                                    <option value="true">On</option>
                                </select>
                            <div class="edit_rotationError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="form-label">Playlist Name</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="edit_playlist_name" id="edit_playlist_name" >
                                    <option disabled selected>Please Select any option</option>
                                </select>
                            <div class="edit_playlist_nameError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Audio File </label>
                            <input type="text" class="form-control border border-2 p-2" name="edit_audioFile" id="edit_audioFile">
                            <div class="edit_audioFileError text-danger errors d-none"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_user_btn">Update</button>
                </div>
            </div>
        </div>
    </form>
</div> --}}



<x-layout titlePage="Edit Template List" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='template.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Template List"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Edit Template List </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                {{-- <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('template.screenwise') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div> --}}
                                <div class="card-body">
                                    <form action="{{ route('template.update', $templateList->id) }}" method="POST" id="updateForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Template Name</label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_template_name" id="edit_template_name" value="{{ $templateList->template_name }}" readonly>
                                                <div class="edit_template_nameError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Template Type</label>
                                                    <select class="form-select mb-3" aria-label="Default select example" name="edit_template_type" id="edit_template_type" >
                                                        <option disabled selected>Please Select any option</option>
                                                        <option value="Image" @if ( $templateList->template_type == 'Image') selected @endif >Image</option>
                                                        <option value="Video" @if ( $templateList->template_type == 'Video') selected @endif  >Video</option>
                                                    </select>
                                                <div class="edit_template_typeError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Full Screen</label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_full_screen" id="edit_full_screen" value="{{ $templateList->full_screen }}" readonly>
                                                    {{-- <select class="form-select mb-3" aria-label="Default select example" name="edit_full_screen" id="edit_full_screen">
                                                        <option disabled selected>Please Select any option</option>
                                                        <option value="false" @if ( $templateList->full_screen == 'false') selected @endif >False</option>
                                                        <option value="true" @if ( $templateList->full_screen == 'true') selected @endif  >True</option>
                                                    </select> --}}
                                                <div class="edit_full_screenError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" >Screen Height </label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_height" id="edit_height" value="{{ $templateList->screen_height }}" readonly>
                                                <div class="heightError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" >Screen Width </label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_width" id="edit_width" value="{{ $templateList->screen_width }}" readonly>
                                                <div class="widthError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Mute</label>
                                                    <select class="form-select mb-3" aria-label="Default select example" name="edit_enable_audio" id="edit_enable_audio" >
                                                        <option disabled selected>Please Select any option</option>
                                                        <option value="false" @if ( $templateList->mute == 'false') selected @endif >Mute</option>
                                                        <option value="true" @if ( $templateList->mute == 'true') selected @endif  >Unmute</option>
                                                    </select>
                                                <div class="edit_enable_audioError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Footer Image</label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_footer_image" id="edit_footer_image" value="{{ $templateList->footer_image }}" readonly>
                                                    {{-- <select class="form-select mb-3" aria-label="Default select example" name="edit_footer_image" id="edit_footer_image" >
                                                        <option disabled selected>Please Select any option</option>
                                                        <option value="false" @if ( $templateList->footer_image == 'false') selected @endif >Off</option>
                                                        <option value="true" @if ( $templateList->footer_image == 'true') selected @endif  >On</option>
                                                    </select> --}}
                                                <div class="edit_footer_imageError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Right Sidebar</label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_right_sidebar" id="edit_right_sidebar" value="{{ $templateList->right_sidebar }}" readonly>
                                                    {{-- <select class="form-select mb-3" aria-label="Default select example" name="edit_right_sidebar" id="edit_right_sidebar" >
                                                        <option disabled selected>Please Select any option</option>
                                                        <option value="false" @if ( $templateList->right_sidebar == 'false') selected @endif >Off</option>
                                                        <option value="true" @if ( $templateList->right_sidebar == 'true') selected @endif  >On</option>
                                                    </select> --}}
                                                <div class="edit_right_sidebarError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Left Sidebar</label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_left_sidebar" id="edit_left_sidebar" value="{{ $templateList->left_sidebar }}" readonly>
                                                    {{-- <select class="form-select mb-3" aria-label="Default select example" name="edit_left_sidebar" id="edit_left_sidebar" >
                                                        <option disabled selected>Please Select any option</option>
                                                        <option value="false" @if ( $templateList->left_sidebar == 'false') selected @endif >Off</option>
                                                        <option value="true" @if ( $templateList->left_sidebar == 'true') selected @endif  >On</option>
                                                    </select> --}}
                                                <div class="edit_left_sidebarError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Rotation</label>
                                                <input type="text" class="form-control border border-2 p-2" name="edit_rotation" id="edit_rotation" value="{{ $templateList->rotation }}" readonly>
                                                    {{-- <select class="form-select mb-3" aria-label="Default select example" name="edit_rotation" id="edit_rotation" >
                                                        <option disabled selected>Please Select any option</option>
                                                        <option value="false" @if ( $templateList->rotation == 'false') selected @endif >Off</option>
                                                        <option value="true" @if ( $templateList->rotation == 'true') selected @endif  >On</option>
                                                    </select> --}}
                                                <div class="edit_rotationError text-danger errors d-none"></div>
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <label for="form-label">Playlist Name</label>
                                                <select class="form-select mb-3" aria-label="Default select example" name="edit_playlist_name" id="edit_playlist_name">
                                                {{-- <select class="selectpicker form-control border border-2 p-2" data-live-search="true" name="playlist_name" id="playlist_name"> --}}
                                                    <option disabled selected>Please Select a playlist</option>
                                                    <option selected>{{ $templateList->playlist_name }}</option>
                                                </select>
                                                <div class="edit_playlist_nameError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <div class="audio_group">
                                                    <label for="form-label">Audio File Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control border border-2 p-2" name="edit_audioFile" id="edit_audioFile" placeholder="Choose a audio" value="{{ $templateList->audio_file_name }}" readonly>
                                                        <a class="btn bg-gradient-warning mb-0" data-bs-toggle="modal" data-bs-target="#updateModal">Click Here</a>
                                                    </div>
                                                    <div class="edit_audioFileError text-danger errors d-none"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-2">
                                                <button type="submit" class="btn bg-gradient-primary mb-0">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <form action="" method="" id="" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="updateModalLabel">CHOOSE ANY AUDIO</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body" style="text-align: center;">
                            <div class="row">
                                @if (!is_null( App\Models\Content::where('audio', '<>' , null)->get()) )
                                    @foreach (App\Models\Content::where('audio', '<>' , null)->get() as $audioList)
                                        <div class="col-lg-4 mb-2">
                                            <div class="card border-primary mb-3">
                                                <div class="card-body text-primary contentItem" id="{{ $audioList->audio }}">
                                                    <div class="pt-2">
                                                        <audio width="300" height="200" class="video-js vjs-theme-city" preload="auto" data-setup="{}" controls>
                                                            <source src="{{ asset('contents/audios/' . $audioList->audio ) }}" type="audio/mpeg">
                                                        </audio>
                                                        <h6 style="font-size: 12px; margin-top: 5px;">{{ $audioList->audio }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info" role="alert">
                                        <strong> Sorry ! </strong> No Found in <b>Any Audio</b>.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <!-- the jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

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
		@if ( Session::has('message') )
			var type = "{{ Session::get('alert-type', 'info') }}" ;

			switch (type) {
				case 'info':
					toastr.info( "{{ Session::get('message') }}" );
				break;
				case 'success':
					toastr.success( "{{ Session::get('message') }}" );
				break;
				case 'warning':
					toastr.warning( "{{ Session::get('message') }}" );
				break;
				case 'error':
					toastr.error( "{{ Session::get('message') }}" );
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
    <script>
        $(document).ready(function () {
            // ajax request
            $(document).on('click', '.contentItem', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $("#edit_audioFile").val(id);
                $('.bg-primary').removeClass('bg-primary');
                $(this).parent().addClass('bg-primary');
                // $("#updateModal").modal('hide');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#edit_template_type").click(function () {
                var selectedValue = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('template.createList') }}",
                    data: {
                        value: selectedValue,
                    },
                    success: function (res) {
                        // console.log(res);
                        // Clear existing options
                        $("#edit_playlist_name").empty();
                        // Add new options based on response
                        $.each(res, function(key, value) {
                            $("#edit_playlist_name").append('<option value="' + value.playlist_name + '">' + value.playlist_name + '</option>');
                        });
                        // Show the audio group
                        if (selectedValue === "Image") {
                            $('.audio_group').removeAttr("hidden");
                        }
                    }
                });
            });

        });
    </script>
    @endpush
</x-layout>
