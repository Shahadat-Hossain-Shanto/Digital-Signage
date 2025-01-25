<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-layout titlePage="Show Image Content List" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='image.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Update Contents"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/image-playlist-view"> Image Playlist</a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/image-playlist-show-content/{{ $name }}"> Playlist Contents</a></li>'></x-navbars.navs.auth>
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
                                    <a class="btn bg-gradient-dark mb-0"
                                        href="/image-playlist-show-content/{{ $name }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                    <button class="btn bg-gradient-primary add_btn mb-0" type="button">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add
                                    </button>

                                    <button class="btn bg-gradient-secondary  save_btn mb-0" type="submit">
                                        <i class="material-icons text-sm">save</i>&nbsp;&nbsp;Confirm Changes
                                    </button>

                                </div>
                                <input id="playlist_name" type="hidden" value="{{ $name }}">
                                <div class="row">
                                    <div class="col-5">
                                        <h3>{{$name}}</h3>
                                    </div>
                                    <div class="col-2">
                                            <label class="form-label" for="">Repeat</label>
                                            <select class=" form-control border border-2 p-2" id="repeat">
                                                <option disabled >Select</option>
                                                <option value="true">Yes</option>
                                                <option value="false">No</option>
                                            </select>
                                        

                                    </div>
                                    <div class="col-2">
                                            <label class="form-label" for="">Mute</label>
                                            <select class=" form-control border border-2 p-2" data-live-search="true"
                                                id="mute">
                                                <option disabled >Select</option>
                                                <option value="true">Yes</option>
                                                <option value="false">No</option>
                                            </select>

                                    </div>
                                </div>

                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0"id="imageTable">
                                            <thead>
                                                <tr>
                                                    <th>Content</th>
                                                    <th>Duration</th>
                                                    <th style="display:none;">id</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($ImagePlayLists as $key => $contentList)
                                                    <tr>

                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">

                                                                    @if ($contentList->content_type == 'Image')
                                                                        <img src="{{ asset('contents/images/' . $contentList->content) }}"
                                                                            alt="" width="35"
                                                                            class="thumbnail">
                                                                    @elseif ($contentList->content_type == 'Video')
                                                                        <video
                                                                            src="{{ asset('contents/videos/' . $contentList->content) }}"
                                                                            alt="" width="35"
                                                                            class="thumbnail" controls></video>
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

                                                        <td style="display:none;">{{ $contentList->id }}</td>

                                                        <td class="align-middle">

                                                            <a href="javascript:;" class="deleteIcon"><i
                                                                    class="fas fa-trash" style="color: red"></i></a>
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
    <div class="modal fade" id="ADDimageMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="ADDimageFORM" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="dynamicForm">
                        <!-- Input fields will be dynamically inserted here -->
                        <div class="form-control">
                            <label class="form-label d-block">Image</label>
                            <button type="button" class="btn btn-secondary" id="openImageModal" data-bs-toggle="modal"
                                data-bs-target="#imageModal">
                                Select Images
                            </button>
                            <!-- Hidden input to store selected images for form submission -->
                            <input type="hidden" id="selectedImages" name="selectedImages">
                        </div>
                        <div class="form-control">
                            <label class="form-label d-block">Video</label>
                            <button type="button" class="btn btn-secondary" id="openvideoModal" data-bs-toggle="modal"
                                data-bs-target="#updateModal">
                                Select Videos
                            </button>
                            <input type="hidden" id="selectedvideos" name="selectedvideos">
                        </div>
                        <div class="form-control">
                            <label class="form-label" for="">Duration</label>
                            <input type="number" class="form-control border border-2 p-2" id="duration"
                                placeholder="5">
                        </div>


                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel_btn btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-outline-danger">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Select Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($imageLists as $imageList)
                            <div class="col-md-3 mb-3">
                                <div class="card image-card" data-image="{{ $imageList->content }}">
                                    <img src="{{ asset("contents/images/{$imageList->content}") }}"
                                        class="card-img-top img-thumbnail" alt="Image">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="prevPage">Previous</button>
                    <span id="pageIndicator">Page 1</span>
                    <button type="button" class="btn btn-secondary" id="nextPage">Next</button>
                    <button type="button" class="btn btn-primary" id="saveImages" data-bs-dismiss="modal">Save
                        Selection</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <form action="" method="" id="updateForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="updateModalLabel">CHOOSE ANY VIDEO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body" style="text-align: center;">
                        <div class="row">
                            @if (!is_null($videoLists))
                                @foreach ($videoLists as $videoList)
                                    <div class="col-lg-4 mb-2" onclick="myFunction(this)">
                                        <div class="pt-2">
                                            <video width="300" height="200" id="{{ $videoList->content }}"
                                                class="contentItem video-js vjs-theme-city" preload="auto"
                                                poster="{{ asset('images/gallary/clean-video-player-template.jpg') }}"
                                                data-setup="{}">
                                                <source src="{{ asset('contents/videos/' . $videoList->content) }}"
                                                    type="video/mp4">
                                            </video>
                                            <h6 style="font-size: 12px; margin-top: 5px;">{{ $videoList->content }}
                                            </h6>
                                            <p class="video-duration"><span></span></p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info" role="alert">
                                    <strong> Sorry ! </strong> No Found in <b>Any Video</b>.
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger savevideo" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    @push('js')
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- the jQuery Library -->
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
            // making rows darggable
            $("#imageTable tbody").sortable({
                cursor: 'move',
                opacity: 0.6,
            }).disableSelection();
            // row delete from frontend
            $('.deleteIcon').on('click', function() {
                $(this).closest('tr').fadeOut(300, function() {
                    $(this).remove();
                });
            });

            $(".add_btn").click(function(e) {
                e.preventDefault();

                // Reset the form with id "ADDimageFORM"
                $('#ADDimageFORM')[0].reset();

                // Show the modal
                $('#ADDimageMODAL').modal('show');
            });


            $(document).ready(function() {
                function formatImage(option) {
                    if (!option.id) {
                        return option.text;
                    }
                    var img = $(option.element).data('content');
                    return img ? $(img).css({
                        height: '110px',
                        width: 'auto'
                    }) : option.text;
                }

                function formatSelection(option) {
                    return $(option.element).val(); // Display only the text (name) when an option is selected
                }




            });



            $('.addimagemodalclose').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#ADDimageMODAL').modal('show');
            });

            $('#ADDimageFORM').on('submit', function(e) {
                e.preventDefault();
                var content;
                var content_type;

                // Validate form fields
                let imageFile = $('#selectedImages').val();
                let videoFile = $('#selectedvideos').val();
                if (imageFile) {
                    content = imageFile;
                    content_type = "Image";
                } else if (videoFile) {
                    content = videoFile;
                    content_type = "Video";
                }
                let duration = $('#duration').val();

                if (!content || !duration) {
                    alert('Please fill all fields');
                    return;
                }

                let imageSrc = `{{ asset('contents/images/') }}/${content}`;
                let videoSrc = `{{ asset('contents/videos/') }}/${content}`;

                // Create new row with the form values
                let newRow = `
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">`;

                // Conditionally display image or video based on content_type
                if (content_type === "Image") {
                    newRow += `<img src="${imageSrc}" alt="${content}" width="35" class="thumbnail">`;
                } else if (content_type === "Video") {
                    newRow += `<video width="35" class="thumbnail" controls>
                       <source src="${videoSrc}" type="video/mp4">
                       Your browser does not support the video tag.
                   </video>`;
                }

                newRow += `
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">${duration}</h6>
            </div>
        </td>
        <td class="d-none">
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">${content_type}</h6>
            </div>
        </td>
        <td class="align-middle">
            <a href="javascript:;" onclick="$(this).closest('tr').fadeOut(300, function() {
                $(this).remove();
            });" class="deleteIcon">
                <i class="fas fa-trash" style="color: red"></i>
            </a>
        </td>
    </tr>`;

                // Append the new row to the table body
                $('#imageTable tbody').append(newRow);

                // Close the modal
                $('#ADDimageMODAL').modal('hide');
            });

            var selectedRowIndex;


            $('.save_btn').click(function(e) {
                e.preventDefault();
                let name = $("#playlist_name").val();

                var tableData = [];

                // Iterate through each row in the table body
                $('#imageTable tbody tr').each(function() {
                    // Get the data from each cell
                    var imageSrc = $(this).find('td').eq(0).find('img').attr('src').split('/')
                        .pop(); // Extract filename
                    var duration = $(this).find('td').eq(1).text().trim();

                    //     'N/A'; 
                    var id = $(this).find('td').eq(5).text().trim();

                    // Push data into the array
                    tableData.push({
                        imageSrc: imageSrc,
                        duration: duration,
                        repeat: repeat,
                        mute: mute,
                        id: id
                    });
                });

                $.ajax({
                    url: '/image-playlist-update', // Replace with your endpoint URL
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        tableData: tableData,
                        name: name
                    },
                    success: function(response) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.message);
                        $(location).attr('href', '/image-playlist-show-content/' + name);
                    },
                    error: function(xhr) {
                        // Handle errors if needed
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('An error occurred while saving the playlist.');
                    }
                });
            });

            $(".cancel_btn").click(function(e) {
                e.preventDefault();
                $('#ADDimageMODAL').modal('hide');


            });
        </script>
        <script>
            $(document).ready(function() {
                const imagesPerPage = 8;
                let currentPage = 1;
                const $imageCards = $('.image-card');
                const totalPages = Math.ceil($imageCards.length / imagesPerPage);

                function showPage(page) {
                    $imageCards.parent().hide();
                    $imageCards.slice((page - 1) * imagesPerPage, page * imagesPerPage).parent().show();

                    $('#pageIndicator').text(`Page ${page} of ${totalPages}`);
                    $('#prevPage').prop('disabled', page === 1);
                    $('#nextPage').prop('disabled', page === totalPages);
                }

                showPage(currentPage);

                $('#prevPage').click(function() {
                    if (currentPage > 1) {
                        currentPage--;
                        showPage(currentPage);
                    }
                });

                $('#nextPage').click(function() {
                    if (currentPage < totalPages) {
                        currentPage++;
                        showPage(currentPage);
                    }
                });

                $('.image-card').click(function() {
                    $('.image-card').parent().removeClass('bg-primary');
                    $(this).parent().addClass('bg-primary');
                });

                $('#saveImages').click(function() {
                    var selectedImage = $('.image-card').parent('.bg-primary').find('.image-card').data(
                        'image');
                    $('#selectedImages').val(selectedImage || ''); // Store single selected image
                    $('#imageModal').modal('hide');
                    $('#ADDimageMODAL').modal('show');
                });


                $('#updateImages').click(function() {
                    var selectedImage = $('.image-card').parent('.bg-primary').find('.image-card').data(
                        'image');
                    $('#updatedselectedImages').val(selectedImage || ''); // Store single selected image

                });

            });
        </script>
        <script>
            function myFunction(element) {
                var vid = element.querySelector("video");
                vid.onloadedmetadata = function() {
                    var durationInput = document.getElementById("duration");

                    // Format the duration to seconds, as required for the input
                    durationInput.value = (vid.duration); // Duration in seconds
                    durationInput.disabled = true; // Duration in seconds

                };

                // Trigger the metadata loading if not already done
                if (vid.readyState >= 1) {
                    vid.onloadedmetadata(); // Force event if already loaded
                }
            }


            function formatTime(seconds) {
                var hours = Math.floor(seconds / 3600);
                var minutes = Math.floor((seconds % 3600) / 60);
                var seconds = Math.floor(seconds % 60);

                var timeString = pad(hours, 2) + ':' + pad(minutes, 2) + ':' + pad(seconds, 2);
                return timeString;
            }
            $(document).on('click', '.contentItem', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $("#selectedvideos").val(id);
                $('.bg-primary').removeClass('bg-primary');
                $(this).parent().addClass('bg-primary');
            });
            $('#updateModal').on('hidden.bs.modal', function() {
                $('#ADDimageMODAL').modal('show');

            });
            $('#ADDimageMODAL').on('hidden.bs.modal', function() {
                var durationInput = document.getElementById("duration");
                durationInput.disabled = false; 

            });
        </script>
    @endpush
</x-layout>
