<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css"
    crossorigin="anonymous">

<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css" />

    <style>
        .material-icons:hover {
    color: #007bff; /* Example color change on hover */
}
    </style>
<x-layout titlePage="Content" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Content types" index=""></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> All Content Types </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="card-body" style="text-align: center;">
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <button class="btn bg-gradient-warning mb-0"data-bs-toggle="modal"
                                                data-bs-target="#contentModal">
                                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Content
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="icon-container"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <a href="{{ route('content.video.list') }}"><i class="material-icons"
                                                        style="font-size: 100px;">folder</i></a>
                                                <span class="icon-text" style="margin-top: -20px;">Videos</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="icon-container"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <a href="{{ route('content.image.list') }}"><i class="material-icons"
                                                        style="font-size: 100px;">folder</i></a>
                                                <span class="icon-text" style="margin-top: -20px;">Images</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="icon-container"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <a href="{{ route('content.audio.list') }}"><i class="material-icons"
                                                        style="font-size: 100px;">folder</i></a>
                                                <span class="icon-text" style="margin-top: -20px;">Audios</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="icon-container"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <a href="{{ route('content.link.list') }}"><i class="material-icons"
                                                        style="font-size: 100px;">folder</i></a>
                                                <span class="icon-text" style="margin-top: -20px;">Links</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="icon-container"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <a href="{{ route('content.app.list') }}">
                                                    <i class="material-icons widget-icon"style="font-size: 100px;">folder</i>
                                                </a>
                                                
                                                <span class="icon-text" style="margin-top: -20px;">Apps</span>
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

    <div class="modal  fade" id="contentModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add New Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <!-- Switch -->
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="toggleSwitch">
                            <label class="form-check-label" for="toggleSwitch">Link</label>
                        </div>

                        <!-- File Input -->
                        <div id="inputContainer">

                            <input type="file" class="form-control" id="fileInput" name="file[]"
                                data-overwrite-initial="false" multiple>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    @push('js')
        <!-- the jQuery Library -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@6.0.1/js/plugins/buffer.min.js" type="text/javascript">
        </script>

        {{-- creating problem to upload png --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@6.0.1/js/plugins/filetype.min.js" type="text/javascript">
        </script>
        <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
                wish to resize images before upload. This must be loaded before fileinput.min.js -->
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
            type="text/javascript"></script>

        <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
                This must be loaded before fileinput.min.js -->
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
            type="text/javascript"></script>

        <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
                dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>

        <!-- the main fileinput plugin script JS file -->
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

        <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/LANG.js"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#fileInput").fileinput({
                    maxFileCount: 10,
                    theme: 'fa',
                    allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
                    uploadUrl: '/upload',
                    uploadExtraData: function() {
                        return {
                            _token: $("input[name='_token']").val(),
                        };
                    },
                    // showBrowse: false,
                    showUpload: true,
                    maxFilePreviewSize: 10240,
                    previewFileType: "image",
                    browseClass: "btn btn-success",
                    browseLabel: "Pick Image",
                    browseIcon: "<i class=\"bi-file-image\"></i> ",
                    removeClass: "btn btn-danger",
                    removeLabel: "Delete",
                    removeIcon: "<i class=\"bi-trash\"></i> ",
                    uploadClass: "btn btn-info",
                    uploadLabel: "Upload",
                    uploadIcon: "<i class=\"bi-upload\"></i> "
                }).on('fileuploaded', function(event, data, previewId, index) {
                    // Capture the response status
                    let response = data.response;
                    if (response.status == 400) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('Upload failed!');
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('Upload Successful');
                        window.location.href = "{{ route('content.image.list') }}";

                    }
                });
            });
        </script>
        <script>
          $(document).ready(function() {
    // Toggle between file and text input
    $('#toggleSwitch').on('change', function() {
        if ($(this).is(':checked')) {
            // Switch to text input
            $('#inputContainer').empty().html(
                '<div class="row"> <div class="col-9"><input type="text" class="form-control border" id="textInput" name="content">\
                    </div> <div class="col-3"><button type="button" class="btn btn-primary  text-end" id="saveBtn">Save</button></div></div>');
        } else {
            // Switch back to file input and reinitialize the fileinput plugin
            $('#inputContainer').empty().html(
                '<input type="file" class="form-control" id="fileInput" name="file[]" multiple data-overwrite-initial="false" multiple>'
            );

            // Re-initialize fileinput plugin on the new file input element
            $("#fileInput").fileinput({
                maxFileCount: 10,
                theme: 'fa',
                // allowedFileExtensions: ["jpg", "gif", "png", "jpeg","webp"],
                uploadUrl: '/upload',
                uploadExtraData: function() {
                    return {
                        _token: $("input[name='_token']").val(),
                    };
                },
                showUpload: true,
                maxFilePreviewSize: 10240,
                browseClass: "btn btn-success",
                browseLabel: "Pick filr",
                browseIcon: "<i class=\"bi-file-image\"></i> ",
                removeClass: "btn btn-danger",
                removeLabel: "Delete",
                removeIcon: "<i class=\"bi-trash\"></i> ",
                uploadClass: "btn btn-info",
                uploadLabel: "Upload",
                uploadIcon: "<i class=\"bi-upload\"></i> "
            }).on('fileuploaded', function(event, data, previewId, index) {
                let response = data.response;
                if (response.status == 400) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Upload failed!');
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('Upload Successful');
                    window.location.href = "{{ route('content.image.list') }}";
                }
            });
        }
    });

    // Handle form submission
    $('#inputContainer').on('click', '#saveBtn', function() {
    $('#uploadForm').submit();
});


    $('#uploadForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        let formData = new FormData();
        let isTextInput = $('#toggleSwitch').is(':checked');

        if (isTextInput) {
            // Get text input value and check if it's not empty
            let textContent = $('#textInput').val().trim();
            if (textContent === '') {
                alertify.error('Please enter link.');
                return;
            }
            formData.append('content', textContent); // Add text to formData
        } 

        // Add CSRF token
        formData.append('_token', '{{ csrf_token() }}');
        console.log(formData); // Check the FormData object in the console

        // Send AJAX request
        $.ajax({
            url: "{{ route('upload.store') }}", // Adjust to your route
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('Upload Successful');
                $('#contentModal').modal('hide'); // Hide the modal after success
                window.location.reload();
            },
            error: function(xhr) {
                alertify.error(xhr.responseJSON.message || 'Upload failed');
            }
        });
    });
});

        </script>
    @endpush
</x-layout>
