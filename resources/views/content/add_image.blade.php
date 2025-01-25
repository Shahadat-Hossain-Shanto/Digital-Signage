<x-layout titlePage="Add Image Content" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Image Content" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href=/content>Content types</a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content-image-list">Images</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Add Image Content </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('content.image.list') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="" method="" id="addForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" >Content Image 
                                                    <i class="fas fa-info-circle text-indo ms-2" title="Only 3 files can be uploaded at a time."></i> </label>

                                                </label>
                                                <div class="file-loading">
                                                    <input id="input-44" name="content_images[]" type="file" accept="image/*" multiple data-overwrite-initial="false">
                                                </div>
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

    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <!-- Bootstrap Icons (latest version) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" crossorigin="anonymous">

    <!-- the fileinput plugin styling CSS file -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- the jQuery Library -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@6.0.1/js/plugins/buffer.min.js" type="text/javascript"></script>

    {{-- creating problem to upload png --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@6.0.1/js/plugins/filetype.min.js" type="text/javascript"></script>
    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
        wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>

    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>

    <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- the main fileinput plugin script JS file -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/LANG.js"></script>

    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#input-44").fileinput({
                maxFileCount: 10,
                theme:'fa',
                allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
                uploadUrl: '/content-upload',
                uploadExtraData:function () {
                    return {
                        _token:$("input[name='_token']").val(),
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

    @endpush
</x-layout>
