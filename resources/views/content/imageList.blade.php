<x-layout titlePage="Images" bodyClass="g-sidenav-show bg-gray-200">
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src="" id="modalImage" class="img-fluid" alt="Image">
                </div>
            </div>
        </div>
    </div>

    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Images" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content">Content types</a></li>'></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Images</strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0" href="{{ route('content.create.image') }}">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Image
                                    </a>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('content.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body" style="text-align: center;">
                                    <div class="row">
                                        @if (!is_null($imageLists) && $imageLists->count() > 0)

                                            @foreach ( $imageLists as $imageList )
                                                <div class="col-sm-3">
                                                    <div class="card" style="margin: 0px 10px 10px 10px">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-image-src="{{ asset('contents/images/'. $imageList->content) }}">
                                                            <img class="card-img-top img-fluid img-thumbnail" width="" src="{{ asset('contents/images/'. $imageList->content) }}" alt="Card image cap">
                                                        </a>
                                                        <a href="#" class="delete-image-btn" data-id="{{ $imageList->id }}" style="position: absolute; top: 10px; right: 10px;">
                                                            <i class="material-icons text-danger">delete</i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        <div class="alert alert-info" role="alert">
                                            <strong> Sorry! </strong> No Images found.
                                        </div>
                                        @endif
                                    </div>
                                    <div class="mt-3" style="margin-right: 10px">
                                        {!! $imageLists->links('vendor.pagination.custom') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>

    <x-plugins></x-plugins>
    <div class="modal fade" id="DELETEimageMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEimageFORM" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="modal-body">
                        <input type="hidden" name="" id="imageid">
                        <h5 class="text-center">Are you sure you want to delete?</h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel_btn btn btn-secondary"
                                data-dismiss="modal">Cancel</button>
                        <button type="submit" class="delete btn btn-outline-danger">Yes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @push('js')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Check for flash messages
            @if(session('status'))
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('{{ session('status') }}');
            @endif

            @if(session('error'))
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('{{ session('error') }}');
            @endif
        });
    </script>
    <script>
        // delete user ajax request
        $(document).on('click', '.delete-image-btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#imageid').val(id);
            $('#DELETEimageFORM').attr('action', '/content-delete-image/' + id);
            $('#DELETEimageMODAL').modal('show');
        });

        $(".cancel_btn").click(function (e) {
            e.preventDefault();
            $('#DELETEimageMODAL').modal('hide');
        });

        // View image in modal
        $(document).on('click', '[data-bs-toggle="modal"]', function() {
            let imageUrl = $(this).data('image-src');
            $('#modalImage').attr('src', imageUrl);

            // Set a fixed maximum width and height for the modal
            $('#imageModal').find('.modal-dialog').css({
                'max-width': '70%',
                'max-height': '70%',
                'margin': '0 auto'
            });

            // Center the image within the modal
            $('#modalImage').css({
                'display': 'block',
                'margin': '0 auto'
            });
        });
    </script>
    @endpush
</x-layout>
