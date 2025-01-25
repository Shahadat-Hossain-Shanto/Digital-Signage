<x-layout titlePage="Show Video Content List" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='video.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Playlist Contents"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/video-playlist-view"> Video Playlists</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Playlist Contents </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">

                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('video.playlist.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                    <a href="/video-playlist-edit/{{ $name }}"
                                        class="updateIcon btn bg-gradient-primary mb-0 ml-5">Update
                                    </a>
                                    <a href=""id="{{ $name }}"
                                        class="deleteIcon btn bg-gradient-danger mb-0 ml-5">Delete
                                    </a>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>SL.</th>
                                                    <th>Video</th>
                                                    <th>Duration</th>
                                                    <th>Repeat</th>
                                                    <th>Mute</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($contentLists as $key => $contentList)
                                                    <tr>
                                                        <th scope="row" class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ ++$key }}</span>
                                                        </th>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    @if (!is_null($contentList->video_file_name))
                                                                        <video width="200" height="200" controls>
                                                                            <source
                                                                                src="{{ asset('contents/videos/' . $contentList->video_file_name) }}"
                                                                                type="video/mp4">
                                                                        </video>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $contentList->duration }}
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    @if ($contentList->repeat == 'true')
                                                                        <span class="badge bg-primary">Yes</span>
                                                                    @elseif($contentList->repeat == 'false')
                                                                        <span class="badge bg-warning">No</span>
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    @if ($contentList->mute == 'true')
                                                                        <span class="badge bg-primary">Yes</span>
                                                                    @elseif($contentList->mute == 'false')
                                                                        <span class="badge bg-warning">No</span>
                                                                    @endif
                                                                </h6>
                                                            </div>
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
            <x-footers.auth></x-footers.auth>
        </div>

    </main>
    <x-plugins></x-plugins>



    <div class="modal fade" id="DELETEvideoMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="DELETEvideoFORM" method="POST" enctype="multipart/form-data">

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
        <!-- the jQuery Library -->

        <script>
            $(document).ready(function() {



                // delete user ajax request
                $(document).on('click', '.deleteIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    // alert(id)
                    $('#id').val(id);
                   $('#DELETEvideoFORM').attr('action', '/video-playlist-delete/' + id);
                   $('#DELETEvideoMODAL').modal('show');

                });

                $(".cancel_btn").click(function(e) {
                    e.preventDefault();
                    $('#DELETEvideoMODAL').modal('hide');


                });
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
        </script>
    @endpush
</x-layout>
