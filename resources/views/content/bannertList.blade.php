
<x-layout titlePage="Banners" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Banners"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content">Content types</a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content-widget-list">Apps</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <style>
            @font-face {
                font-family: 'Digital-7';
                src: url('fonts/digital-7.ttf') format('woff2'), b, g, mdrx url('digital-7.woff') format('woff');
            }

            .clockdate-wrapper {
                background: #141E30;
                /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #243B55, #141E30);
                /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #243B55, #141E30);
                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                padding: 25px;
                max-width: 350px;
                width: 100%;
                text-align: center;
                border-radius: 5px;
                margin: 0 auto;
            }

            #dateclock {
                font-family: Digital-7, 'sans-serif';
                font-size: 30px;
                text-shadow: 0px 0px 1px #fff;
                color: #fff;
            }

            #clock span {
                color: rgba(255, 255, 255, 0.8);
                text-shadow: 0px 0px 1px #333;
                font-size: 50px;
                position: relative;
                top: -5px;
                left: 10px;
            }

            #date {
                letter-spacing: 3px;
                font-size: 14px;
                font-family: arial, sans-serif;
                color: #fff;
            }
        </style>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="text-white mx-3"><strong>Banners</strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="me-3 my-3">
                                <div class="text-end">
                                    <button class="btn btn-warning mb-0" id="banner">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add
                                    </button>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route("content.app.list") }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body text-center row justify-content-evenly">
                                @if ($banners && $banners->count() > 0)
                                    @foreach ($banners as $banner)
                                        <div class="card mb-3" style="width: 18rem;">
                                            <img src="{{ asset('contents/clock/banner0.png') }}"
                                                class="card-img-top" alt="Banner Icon">
                                            <div class="card-body">
                                                <h5 class="card-title pb-2">{{ $banner->name }}</h5>
                                                @foreach ($banner->fullText as $text)
                                                    <p class="card-text">{{ $text->text }}</p>
                                                @endforeach
                                                <button data-url="{{ $banner->content }}" target="blank"
                                                    class="btn btn-primary apps">View</button>
                                                <button class="btn btn-warning edit" data-id="{{ $banner->app_id }}">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button class="btn btn-danger delete" data-id="{{ $banner->app_id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="alert alert-info" role="alert">
                                        <strong>Sorry!</strong> No banners found.
                                    </div>
                                @endif
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
    <!-- Modal Structure -->
    <div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bannerModalLabel">Add Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bannerForm">

                        <div class="mb-3">
                            <input type="hidden" id='updateId'>
                            <label for="bannerName" class="form-label">Banner Name
                                <span class="text-danger"><strong>*</strong></span>
                            </label>
                            <input class="form-control border border-2 w-100 px-2" id="bannerName" name="bannerName"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="bannerText" class="form-label">Banner Text
                                <span class="text-danger"><strong>*</strong></span>
                            </label>
                            <table id='bannerText' class="w-100">
                                <tbody>
                                    <tr>
                                        <td><input class="form-control border border-2 w-100 px-2" required></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-warning mb-0" onclick="addRow()">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Row
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitBanner" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DELETElinkMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETElinkFORM" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}

                    <div class="modal-body">
                        <input type="hidden" name="" id="id">
                        <h5 class="text-center">Are you sure you want to delete?</h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel_btn btn btn-secondary"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="deleteConfirm btn btn-outline-danger">Yes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Banner View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <!-- Iframe to load the content URL -->
                    <iframe id="appIframe" src="" width="100%" height="500px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    @push("js")
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Check for flash messages and display them using alertify
                @if (session("status"))
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('{{ session("status") }}');
                @endif

                @if (session("error"))
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('{{ session("error") }}');
                @endif

                // Show Modal on Button Click
                $('#banner').on('click', function() {
                    $('#bannerModalLabel').text('Add Banner');
                    $('#updateId').val('')
                    $('#bannerName').val('')
                    const tableBody = document.querySelector('#bannerText tbody');
                    tableBody.innerHTML = '';
                    var newRow = document.createElement('tr');
                    newRow.innerHTML = '<td><input class="form-control border border-2 w-100 px-2"></td>';
                    tableBody.appendChild(newRow);

                    $('#bannerModal').modal('show');
                });

                $('.edit').on('click', function() {
                    $('#bannerModalLabel').text('Update Banner');
                    let id = $(this).attr('data-id');
                    $('#updateId').val(id)

                    $.ajax({
                        url: '/banner-info/' + id,
                        method: 'GET',
                        success: function(response) {
                            $('#bannerName').val(response.data[0].name)
                            const tableBody = document.querySelector(
                                '#bannerText tbody');
                            tableBody.innerHTML = '';
                            response.data.forEach(element => {
                                var newRow = document.createElement('tr');
                                newRow.innerHTML =
                                    '<td><input class="form-control border border-2 w-100 px-2" value="' +
                                    element.text + '" data-id="' +
                                    element.id + '"></td>';
                                tableBody.appendChild(newRow);
                            });
                            $('#bannerModal').modal('show');
                        },
                        error: function(error) {
                            alertify.error('Error Geting Banner Data.');
                            console.error(error);
                        }
                    });

                    $('#bannerModal').modal('show');
                });

                // Submit Banner Form via AJAX
                $('#submitBanner').on('click', function() {
                    const updateId = $('#updateId').val();
                    const bannerName = $('#bannerName').val();

                    const table = document.getElementById('bannerText');
                    const rows = table.getElementsByTagName('tr');
                    const bannerText = [];
                    for (let row of rows) {
                        const input = row.querySelector('input');
                        if (input) {
                            if (input.value != '') {

                                bannerText.push({
                                    id: input.getAttribute('data-id'),
                                    text: input.value
                                });
                            }
                        }
                    }

                    // Validate input fields
                    if (bannerName.trim() === '' || bannerText.length == 0) {
                        alertify.error('Both fields are required.');
                        return;
                    }

                    // Perform AJAX request
                    $.ajax({
                        url: '/submit-banner', // Update with your endpoint
                        method: 'POST',
                        data: {
                            updateId: updateId,
                            bannerName: bannerName,
                            bannerText: bannerText,
                            _token: $('meta[name="csrf-token"]').attr('content') // For Laravel CSRF
                        },
                        success: function(response) {
                            alertify.success('Banner submitted successfully!');
                            $('#bannerModal').modal('hide');
                            $('#bannerForm')[0].reset();
                            window.location.href = "{{ route("content.banner.list") }}";
                        },
                        error: function(error) {
                            alertify.error('Error submitting banner.');
                            console.error(error);
                        }
                    });
                });

                // Handle delete button click
                $(document).on('click', '.delete', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('data-id');
                    $('#id').val(id);
                    $('#DELETElinkFORM').attr('action', '/content-delete-banner/' + id);
                    $('#DELETElinkMODAL').modal('show');
                });

                // Close modal when cancel button is clicked
                $(".cancel_btn").click(function(e) {
                    e.preventDefault();
                    $('#DELETElinkMODAL').modal('hide');
                });
                $('.apps').on('click', function() {
                // Get the URL from the data-url attribute of the clicked button
                var url = $(this).data('url');
                
                // Set the iframe src to the clicked URL
                $('#appIframe').attr('src', url);
                
                // Show the modal
                $('#viewModal').modal('show');
            });
            });

            function addRow() {
                var tableBody = document.querySelector('#bannerText tbody');
                var newRow = document.createElement('tr');
                newRow.innerHTML = '<td><input class="form-control border border-2 w-100 px-2"></td>';
                tableBody.appendChild(newRow);
            }
        </script>
    @endpush
</x-layout>
