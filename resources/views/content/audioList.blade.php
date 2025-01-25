<x-layout titlePage="Audios" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Audios"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content">Content types</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Content Audio List </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0" href="{{ route('content.create.audio') }}">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Audio
                                    </a>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('content.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body" style="text-align: center;">
                                    <div class="row">
                                        @if (!is_null($audioLists) && $audioLists->count() > 0)

                                            @foreach ($audioLists as $audioList)
                                                <div class="col-lg-4 mb-2">
                                                    <div class="card border-primary mb-3">
                                                        <div class="card-body text-primary contentItem"
                                                        id="{{ $audioList->audio }}">
                                                        <a href="" id="{{ $audioList->id }}" class="deleteAudio text-end" style="text-decoration: none; position: absolute; top: 10px; right: 10px;">
                                                            <i class="material-icons text-danger">delete</i>

                                                    </a>
                                                                <div class="pt-2">
                                                                    <audio width="300" height="200"
                                                                        class="video-js vjs-theme-city" preload="auto"
                                                                        data-setup="{}" controls>
                                                                        <source
                                                                            src="{{ asset('contents/audios/' . $audioList->content) }}"
                                                                            type="audio/mpeg">
                                                                    </audio>
                                                                    <h6 style="font-size: 12px; margin-top: 5px;">
                                                                        {{ $audioList->centent }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-info" role="alert">
                                                <strong> Sorry ! </strong> No Audio Found.
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        {!! $audioLists->links('vendor.pagination.custom') !!}
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
    <div class="modal fade" id="DELETEaudioMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEaudioFORM" method="POST" enctype="multipart/form-data">

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
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
            $(document).on('click', '.deleteAudio', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $('#id').val(id);
                $('#DELETEaudioFORM').attr('action', '/content-delete-audio/' + id);
                $('#DELETEaudioMODAL').modal('show');

            });

            $(".cancel_btn").click(function(e) {
                e.preventDefault();
                $('#DELETEaudioMODAL').modal('hide');


            });

        </script>
    @endpush
</x-layout>
