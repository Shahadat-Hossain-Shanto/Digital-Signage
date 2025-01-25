<x-layout titlePage="Dashboard" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">devices_other</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Device</p>
                                <h4 class="mb-0">
                                    @if (is_null(App\Models\RegisterDevice::totalDevices()))
                                        0
                                    @else
                                        {{ App\Models\RegisterDevice::totalDevices() }}
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than
                                lask week</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">add_to_queue</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Active Device</p>
                                <h4 class="mb-0">
                                    @if (is_null(App\Models\RegisterDevice::totalActiveDevices()))
                                        0
                                    @else
                                        {{ App\Models\RegisterDevice::totalActiveDevices() }}
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than
                                lask month</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">devices</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Inactive Device</p>
                                <h4 class="mb-0">
                                    @if (is_null(App\Models\RegisterDevice::totalInactiveDevices()))
                                        0
                                    @else
                                        {{ App\Models\RegisterDevice::totalInactiveDevices() }}
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than
                                yesterday</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">dvr</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Template</p>
                                <h4 class="mb-0">
                                    @if (is_null(App\Models\Template::totalTemplates()))
                                        0
                                    @else
                                        {{ App\Models\Template::totalTemplates() }}
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than
                                yesterday</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 62vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Show All Registration Device </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0"
                                        href="{{ route("register.content.device.create") }}">
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
                                                        <th>IMEI/Serial Number</th>
                                                        <th>Device Type</th>
                                                        <th>Device Size</th>
                                                        <th>Model</th>
                                                        <th>Brand</th>
                                                        <th>Description</th>
                                                        {{-- <th>Used</th> --}}
                                                        {{-- <th>Template Name</th> --}}
                                                        <th>Setup Location</th>
                                                        {{-- <th>Group Name</th> --}}
                                                        <th>Device Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    @foreach ($registerDevices as $key => $registerDevice)
                                                        <tr>
                                                            <th scope="row" class="align-middle text-center">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">{{ ++$key }}</span>
                                                            </th>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->device_id }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->imei }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->device_type }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->size }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->model }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->brand }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->description }}</h6>
                                                                </div>
                                                            </td>
                                                            {{-- <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->user_by }}</h6>
                                                                </div>
                                                            </td> --}}
                                                            {{-- <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->template_name }}</h6>
                                                                </div>
                                                            </td> --}}
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->setup_location }}</h6>
                                                                </div>
                                                            </td>
                                                            {{-- <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        {{ $registerDevice->group_name }}</h6>
                                                                </div>
                                                            </td> --}}
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        @if ($registerDevice->status == "true")
                                                                            <span class="badge bg-primary">Active</span>
                                                                        @elseif($registerDevice->status == "false")
                                                                            <span
                                                                                class="badge bg-danger">Inactive</span>
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle ps-4">
                                                                <a href="" id="{{ $registerDevice->id }}"
                                                                    class="editIcon" data-bs-toggle="modal"
                                                                    data-bs-target="#updateModal"><i class="fas fa-edit"
                                                                        style="color: green"></i></a>
                                                                <a href="/register-device-template-assign/{{ $registerDevice->id }}"
                                                                    class="uploadIcon">
                                                                    <i class="fas fa-upload" style="color: blue"></i>
                                                                </a>
                                                                <a href="" id="{{ $registerDevice->id }}"
                                                                    class="deleteIcon"><i class="fas fa-trash"
                                                                        style="color: red"></i></a>
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
            @include("registerDevice.edit")

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    <div class="modal fade" id="DELETEdeviceMODAL" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEdeviceFORM" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}

                    <div class="modal-body">
                        <input type="hidden" name="" id="id">
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
    @push("js")
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        {{-- <script>
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["M", "T", "W", "T", "F", "S", "S"],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "rgba(255, 255, 255, .8)",
                        data: [50, 20, 10, 22, 50, 10, 40],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

            new Chart(ctx3, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#f8f9fa',
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        </script> --}}
        <script>
            @if (Session::has("message"))
                var type = "{{ Session::get("alert-type", "info") }}";

                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get("message") }}");
                        break;
                    case 'success':
                        toastr.success("{{ Session::get("message") }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ Session::get("message") }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get("message") }}");
                        break;
                }
            @endif
        </script>
        <script>
            $(document).ready(function() {


                // edit user ajax request
                $(document).on('click', '.editIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');

                    $.ajax({
                        type: "GET",
                        url: "{{ route("register.content.device.edit") }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            // console.log(res)
                            const device = res.device;
                            const templates = res.templates;

                            // Populate device details
                            $("#edit_device_id").val(device.device_id);
                            $("#edit_device_type").val(device.device_type);
                            $("#edit_size").val(device.size);
                            $("#edit_model").val(device.model);
                            $("#edit_brand").val(device.brand);
                            $("#edit_description").val(device.description);
                            $("#edit_user_by").val(device.user_by);
                            $("#edit_imei").val(device.imei);
                            $("#edit_setup_location").val(device.setup_location);
                            $("#edit_group_name").val(device.group_name);
                            $("#edit_status").val(device.status);
                            $("#register_id").val(device.id);
                            $("#edit_os").val(device.os);

                            // Clear and populate template options
                            // $("#edit_template").empty();
                            // templates.forEach(template => {
                            //     const isSelected = template.id === device.template_id ?
                            //         'selected' : '';
                            //     $("#edit_template").append(
                            //         `<option value="${template.id}" ${isSelected}>${template.template_name}</option>`
                            //     );
                            // });
                        }
                    });
                });
                // Update data ajax request
                $(document).on('submit', '#updateForm', function(e) {
                    e.preventDefault();
                    let fd = new FormData(this);
                    // let id     = $('#expensiveType_id').val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route("register.content.device.update") }}",
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(res) {
                            // console.log(res);
                            if (res.status == 400) {
                                $('.errors').html('');
                                $('.errors').removeClass('d-none');

                                $('.edit_device_idError').text(res.errors.device_id);
                                $('.edit_imeiError').text(res.errors.imei);
                                $('.edit_imeiError').text(res.errors.subscriber_id_imei_unique);
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
                                $('.edit_statusError').text(res.errors.status);
                            } else {
                                $('.errors').html('');
                                $('.errors').removeClass('d-none');
                                $('#updateForm')[0].reset();
                                $("#updateModal").modal('hide');
                                location.reload();
                                // $('.table').load(location.href+' .table');

                                alertify.set('notifier', 'position', 'top-right');
                                alertify.success('Updated Successfully!');
                            }
                        }
                    });
                });

                // delete user ajax request

                $(document).on('click', '.deleteIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');

                    $('#id').val(id);
                    $('#DELETEdeviceFORM').attr('action', '/register-device-delete/' + id);
                    $('#DELETEdeviceMODAL').modal('show');
                });



                $('.cancel_btn').click(function(e) {
                    e.preventDefault();
                    $('#DELETEdeviceMODAL').modal('hide');

                });

            });
        </script>
    @endpush
</x-layout>
