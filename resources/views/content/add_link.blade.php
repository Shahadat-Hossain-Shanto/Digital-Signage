<x-layout titlePage="Add Link Content" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Link Content" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content">Content types</a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content-link-list">Links</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong>Create Content Link</strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('content.link.list') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('content.store.link') }}" method="POST" id="addForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-12">

                                                <label class="form-label">Content Link</label>
                                                <input type="text" class="form-control border border" name="content_links[]" id="content_links" style="padding-left: 5px;" placeholder="Enter link here"  multiple>
                                                <div class="content_linkError text-danger errors d-none"></div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">
                                                <i class="material-icons text-sm">check</i>&nbsp;&nbsp;Submit
                                            </button>
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
</x-layout>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#addForm').submit(function(e) {
                e.preventDefault(); // Prevent form from submitting normally

                let links = $('#content_links').val(); // Get the value of links input

                // Validate if links are entered
                if (links.length === 0) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Please enter at least one link.');
                    return;
                }

                // Send form data to backend
                $.ajax({
                    url: "{{ route('content.store.link') }}",
                    type: "POST",
                    data: {
                        _token: $("input[name='_token']").val(),
                        content_links: links.split(','), // Split links into an array
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success('Links uploaded successfully');
                            window.location.href = "{{ route('content.link.list') }}";
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error('Upload failed!');
                        }
                    },
                    error: function() {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('There was an error with the request.');
                    }
                });
            });
        });
    </script>
@endpush
