<x-layout titlePage="Template List" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='template.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Template List"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> View @if ($param1 == 'true') Full Screen @endif Template List </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0" href="{{ route('template.create') }}">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Template
                                    </a>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('template.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>SL.</th>
                                                        <th>Template Name</th>
                                                        <th>Template Type</th>
                                                        @if ($param1 == 'false')
                                                        <th>Full Screen</th>
                                                        <th>Screen Height</th>
                                                        <th>Screen Width</th>
                                                        <th>Footer Image</th>
                                                        <th>Left Sidebar</th>
                                                        <th>Right Sidebar</th>
                                                        @endif
                                                        <th>Mute</th>
                                                        <th>Rotation</th>
                                                        <th>Playlist Name</th>
                                                        <th>Audio File</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    @foreach($templateLists as $key => $templateList)
                                                        <tr>
                                                            <th scope="row" class="align-middle text-center">
                                                                <span class="text-secondary text-xs font-weight-bold">{{ ++$key }}</span>
                                                            </th>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $templateList->template_name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $templateList->template_type }}</h6>
                                                                </div>
                                                            </td>
                                                            @if ($param1 == 'false')
                                                                <td>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 ps-3 text-sm">{{ $templateList->full_screen }}</h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 ps-3 text-sm">{{ $templateList->screen_height }}</h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 ps-3 text-sm">{{ $templateList->screen_width }}</h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 ps-3 text-sm">{{ $templateList->footer_image }}</h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 ps-3 text-sm">{{ $templateList->left_sidebar }}</h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 ps-3 text-sm">{{ $templateList->right_sidebar }}</h6>
                                                                    </div>
                                                            </td>
                                                            @endif
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $templateList->mute }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $templateList->rotation }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $templateList->playlist_name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $templateList->audio_file_name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle ps-4">
                                                                <a href="{{ route('template.edit', $templateList->id) }}" ><i class="fas fa-edit" style="color: green"></i></a>
                                                                {{-- <a href="" id="{{ $templateList->id }}" class="deleteIcon"><i class="fas fa-trash" style="color: red"></i></a> --}}
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
            <x-footers.auth></x-footers.auth>
        </div>
        {{-- @include('template.edit') --}}

    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('').DataTable( {
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
                    url: "/template-list-datalist",
                },
                columns: [
                    {
                        data: "id",
                        "render": function ( data, type, row, meta ) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: "template_name" },
                    { data: "template_type" },
                    { data: "full_screen" },
                    { data: "screen_height" },
                    { data: "screen_width" },
                    { data: "mute" },
                    { data: "footer_image" },
                    { data: "left_sidebar" },
                    { data: "right_sidebar" },
                    { data: "rotation" },
                    { data: "playlist_name" },
                    { data: "audio_file_name" },
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

            // delete user ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                // let user_id     = $(this).data('id');
                let id = $(this).attr('id');

                if (confirm('Are you sure to delete this template Screen Info ??')) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('template.delete') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            if (res.status == 200) {
                                // $('.table').load(location.href+' .table');
                                location.reload();

                                alertify.set('notifier','position', 'top-right');
                                alertify.error('Deleted successfully!');
                            }
                        }
                    });
                }
            });
        });
    </script>
    @endpush
</x-layout>

