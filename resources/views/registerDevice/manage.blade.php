<x-layout titlePage="Registration Device List" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='register.content.device.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Registration Device List"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Show All Registration Device </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0" href="{{ route('register.content.device.create') }}">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Device
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>SL.</th>
                                                        <th>Device ID</th>
                                                        <th>IMEI</th>
                                                        <th>Device Type</th>
                                                        <th>Device Size</th>
                                                        <th>Model</th>
                                                        <th>Brand</th>
                                                        <th>Description</th>
                                                        <th>Used</th>
                                                        <th>Template Name</th>
                                                        <th>Setup Location</th>
                                                        <th>Group Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    @foreach($registerDevices as $key => $registerDevice)
                                                        <tr>
                                                            <th scope="row" class="align-middle text-center">
                                                                <span class="text-secondary text-xs font-weight-bold">{{ ++$key }}</span>
                                                            </th>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->device_id }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->imei }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->device_type }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->size }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->model }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->brand }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->description }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->user_by }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->template_name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->setup_location }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $registerDevice->group_name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle ps-4">
                                                                <a href="" id="{{ $registerDevice->id }}" class="editIcon" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-edit" style="color: green"></i></a>
                                                                <a href="" id="{{ $registerDevice->id }}" class="deleteIcon"><i class="fas fa-trash" style="color: red"></i></a>
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
        @include('registerDevice.edit')

    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')

    <!-- the jQuery Library -->
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
                    url: "/register-device-list",
                },
                columns: [
                    {
                        data: "id",
                        "render": function ( data, type, row, meta ) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: "device_id" },
                    { data: "imei" },
                    { data: "model" },
                    { data: "brand" },
                    { data: "description" },
                    { data: "user_by" },
                    { data: "template_name" },
                    { data: "setup_location" },
                    { data: "group_name" },
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
                    url: "{{ route('register.content.device.edit') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        // console.log(res);
                        $("#edit_device_id").val(res.device_id);
                        $("#edit_device_type").val(res.device_type);
                        $("#edit_size").val(res.size);
                        $("#edit_model").val(res.model);
                        $("#edit_brand").val(res.brand);
                        $("#edit_description").val(res.description);
                        $("#edit_user_by").val(res.user_by);
                        $("#edit_imei").val(res.imei);
                        $("#edit_setup_location").val(res.setup_location);
                        // $("#edit_browser_url").val(res.browser_url);
                        $("#edit_template").val(res.template_id);
                        // $('#edit_template').selectpicker('val', res.template_id);
                        $("#edit_group_name").val(res.group_name);
                        $("#register_id").val(res.id);
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
                    url: "{{ route('register.content.device.update') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (res) {
                        // console.log(res);
                        if (res.status == 400) {
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');

                            $('.edit_device_idError').text(res.errors.device_id);
                            $('.edit_imeiError').text(res.errors.imei);
                            $('.edit_device_typeError').text(res.errors.device_type);
                            $('.edit_sizeError').text(res.errors.size);
                            $('.edit_modelError').text(res.errors.model);
                            $('.edit_brandError').text(res.errors.brand);
                            $('.edit_descriptionError').text(res.errors.description);
                            $('.edit_user_byError').text(res.errors.user_by);
                            $('.edit_templateError').text(res.errors.template_type);
                            $('.edit_setup_locationError').text(res.errors.setup_location);
                            // $('.edit_browser_urlError').text(res.errors.browser_url);
                            $('.edit_group_nameError').text(res.errors.group_name);
                        } else {
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');
                            $('#updateForm')[0].reset();
                            $("#updateModal").modal('hide');
                            location.reload();
                            // $('.table').load(location.href+' .table');

                            alertify.set('notifier','position', 'top-right');
                            alertify.success('Updated Successfully!');
                        }
                    }
                });
            });

            // delete user ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                // let user_id     = $(this).data('id');
                let id = $(this).attr('id');

                if (confirm('Are you sure to delete this register device Info ??')) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('register.content.device.destroy') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            if (res.status == 200) {
                                // $('.table').load(location.href+' .table');
                                location.reload();

                                alertify.set('notifier','position', 'top-right');
                                alertify.error('Deleted Successfully!');
                            }
                        }
                    });
                }
            });

        });
    </script>
    @endpush
</x-layout>











