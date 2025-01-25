
<x-layout titlePage="Create Registration Device" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='register.content.device.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Register Device" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Create Registration Device </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="/dashboard">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="" method="" id="addForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label" >IMEI/Serial Number </label>
                                                <input type="number" class="form-control border border-2 p-2" name="imei" id="imei">
                                                <div class="imeiError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label">Device Type <span class="text-danger"><b>*</b> </span> </label>
                                                <select class="form-select border border-2 p-2" name="device_type" id="device_type">
                                                    <option value="" selected disabled>Select Device Type</option>
                                                    <option value="tv">TV</option>
                                                    <option value="monitor">Monitor</option>
                                                    <option value="tablet">Tablet</option>
                                                    <option value="laptop">Laptop</option>
                                                    <option value="desktop">Desktop</option>
                                                    <option value="mobile">Mobile</option>
                                                </select>
                                                <div class="device_typeError text-danger errors d-none"></div>
                                            </div>
                                            
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label">Device Size</label>
                                                <select class="form-select border border-2 p-2" name="size" id="size">
                                                    <option value="" selected disabled>Select Resolution</option>
                                                    <option value="1920x1080">1920 x 1080</option>
                                                    <option value="1366x768">1366 x 768</option>
                                                    <option value="1280x720">1280 x 720</option>
                                                    <option value="2560x1440">2560 x 1440</option>
                                                    <option value="3840x2160">3840 x 2160</option>
                                                    <option value="768x1024">768 x 1024</option>
                                                </select>
                                                <div class="sizeError text-danger errors d-none"></div>
                                            </div>
                                            
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label" >Model </label>
                                                <input type="text" class="form-control border border-2 p-2" name="model" id="model">
                                                <div class="modelError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label" >Brand </label>
                                                <input type="text" class="form-control border border-2 p-2" name="brand" id="brand">
                                                <div class="brandError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label" >Description </label>
                                                <input type="text" class="form-control border border-2 p-2" name="description" id="description">
                                                <div class="descriptionError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label" >Setup Location <span class="text-danger"><b>*</b></span>  </label>
                                                <input type="text" class="form-control border border-2 p-2" name="setup_location" id="setup_location">
                                                <div class="setup_locationError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="form-label">Operarting Sysytem</label>
                                                    <select class="form-select mb-3 p-2" aria-label="Default select OS" name="os" id="os" >
                                                        <option disabled selected>Please Select the operating system</option>
                                                        <option value="true">Windows</option>
                                                        <option value="false">Android</option>
                                                        <option value="false">IOS</option>
                                                    </select>
                                                <div class="osError text-danger errors d-none"></div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="form-label">Device Status</label>
                                                    <select class="form-select  p-2" aria-label="Default select status" name="status" id="status">
                                                        <option disabled selected>Please Select the Device Status</option>
                                                        <option value="true">Active</option>
                                                        <option value="false">Inactive</option>
                                                    </select>
                                                <div class="statusError text-danger errors d-none"></div>
                                            </div>
                                           
                                            <div class="col-md-12 mt-2 text-end">
                                                <button type="submit" class="btn bg-gradient-primary mb-0" id="addtotable">Save</button>
                                                <button type="reset" class="btn bg-gradient-danger mb-0">Reset</button>
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
    <!-- the jQuery Library -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            // let table = new DataTable('#myTable');
            // $("#myTable").DataTable({
            //     responsive: true
            // });

            // Add data
            $(document).on('submit', '#addForm', function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                // const fd = new FormData(this);
                // console.log(fd);
                $.ajax({
                    type: "POST",
                    url: "{{ route('register.content.device.store') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (res) {
                        console.log(res);

                        if (res.status == 400) {
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');

                            // $('.device_idError').text(res.errors.device_id);
                            // $('.imeiError').text(res.errors.imei);
                            $('.device_typeError').text(res.errors.device_type);
                            // $('.sizeError').text(res.errors.size);
                            // $('.modelError').text(res.errors.model);
                            // $('.brandError').text(res.errors.brand);
                            // $('.descriptionError').text(res.errors.description);
                            // $('.user_byError').text(res.errors.user_by);
                            // $('.templateError').text(res.errors.template);
                            $('.setup_locationError').text(res.errors.setup_location);
                            // $('.browser_urlError').text(res.errors.browser_url);
                            // $('.group_nameError').text(res.errors.group_name);
                            $('.statusError').text(res.errors.status);
                        } else {
                            $('#addForm')[0].reset();
                            $('.errors').html('');
                            $('.errors').removeClass('d-none');
                            // $('.table').load(location.href+' .table');
                            // Redirect to another page
                            window.location.href = "/register-device-template-assign/"+res.device.id;

                            alertify.set('notifier','position', 'top-right');
                            alertify.success('Added successfully!');
                        }
                    }
                });
            });

        });
    </script>
    @endpush
</x-layout>











