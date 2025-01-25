<x-layout titlePage="Show Video Content List" bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar bar activePage='video.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Update PlayList Contents"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/video-playlist-view"> Video Playlists</a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/video-playlist-show-content/{{$name}}">Playlist Contents</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="text-white mx-3"><strong> Update Playlist Contents </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0"
                                        href="/video-playlist-show-content/{{ $name }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                    <button class="btn bg-gradient-warning add_btn mb-0" type="button">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add
                                    </button>

                                    <button class="btn bg-gradient-secondary  save_btn mb-0" type="submit">
                                        <i class="material-icons text-sm">save</i>&nbsp;&nbsp;Confirm Changes
                                    </button>

                                </div>
                                <input id="playlist_name" type="hidden" value="{{ $name }}">
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0" id="videoTable">
                                            <thead>
                                                <tr>
                                                    <th>Video</th>
                                                    <th>Duration</th>
                                                    <th>Repeat</th>
                                                    <th>Mute</th>
                                                    <th style="display:none;">id</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($videoPlayLists as $videoPlayList)
                                                    <tr>
                                                        <td>
                                                            @if ($videoPlayList->video_file_name)
                                                                <video width="150" height="150" controls>
                                                                    <source
                                                                        src="{{ asset('contents/videos/' . $videoPlayList->video_file_name) }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>{{ $videoPlayList->duration }}</td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $videoPlayList->repeat == 'true' ? 'bg-primary' : 'bg-warning' }}">
                                                                {{ $videoPlayList->repeat == 'true' ? 'Yes' : 'No' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $videoPlayList->mute == 'true' ? 'bg-primary' : 'bg-warning' }}">
                                                                {{ $videoPlayList->mute == 'true' ? 'Yes' : 'No' }}
                                                            </span>
                                                        </td>
                                                        <td style="display:none;">{{ $videoPlayList->id }}</td>
                                                        <!-- Hidden Data -->
                                                        <td>
                                                            <a href="javascript:;" class="updateIcon"
                                                                data-id="{{ $videoPlayList->id }}">
                                                                <i class="fas fa-edit"
                                                                    style="color: rgb(26, 241, 19)"></i>
                                                            </a>
                                                            <a href="javascript:;" class="deleteIcon">
                                                                <i class="fas fa-trash" style="color: red"></i>
                                                            </a>
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

    <!-- Modal for Update -->
    <div class="modal fade" id="UPDATEvideoMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="UPDATEvideoFORM" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="dynamicForm">
                        <!-- Input fields will be dynamically inserted here -->
                        <div class="form-group">
                            <label for="videoSrc">Video </label>

                            <input type="text" class="form-control" id="videoFile" placeholder="Choose a video"
                                readonly="" data-bs-toggle="modal" data-bs-target="#updateModal"
                                onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" readonly>
                        </div>
                        <div class="form-group">
                            <label for="repeat">Repeat</label>
                            <select class="form-select" data-live-search="true" id="repeat">
                                <option disabled selected>plesse select</option>
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mute">Mute</label>
                            <select class=" form-select" data-live-search="true" id="mute">
                                <option disabled selected>Please Select</option>
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel_btn btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-outline-danger">Save Changes</button>
                    </div>
                </form>
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
                                            <video width="300" height="200" id="{{ $videoList->video }}"
                                                class="contentItem video-js vjs-theme-city" preload="auto"
                                                poster="{{ asset('images/gallary/clean-video-player-template.jpg') }}"
                                                data-setup="{}">
                                                <source src="{{ asset('contents/videos/' . $videoList->video) }}"
                                                    type="video/mp4">
                                            </video>
                                            <h6 style="font-size: 12px; margin-top: 5px;">{{ $videoList->video }}</h6>
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
                        <button type="button" class="btn btn-danger videomodalclose">OK</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="ADDvideoMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="ADDvideoFORM" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="dynamicForm">
                        <!-- Input fields will be dynamically inserted here -->
                        <div class="form-control">
                            <label for="videoSrc">Video</label>

                            <input type="text" class="form-control" id="addvideoFile"
                                placeholder="Choose a video" readonly="" data-bs-toggle="modal"
                                data-bs-target="#addModal" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="form-control">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="addduration" name="addduration" readonly>
                        </div>
                        {{-- <div class="col-md-2">
                            <label class="form-label" for="">Duration</label>
                            <input type="text" class="form-control border border-2 p-2" id="duration" value="00:00:00" readonly>
                        </div> --}}
                        <div class="form-control">
                            <label for="addrepeat">Repeat</label>
                            <select class=" form-select" data-live-search="true" id="addrepeat">
                                <option disabled selected>plesse select</option>
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label for="addmute">Mute</label>
                            <select class=" form-select" data-live-search="true" id="addmute">
                                <option disabled selected>Please Select</option>
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel_btn btn btn-secondary"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-outline-danger">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <form action="" method="" id="addForm" enctype="multipart/form-data">
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
                                    <div class="col-lg-4 mb-2 selectvideos" onclick="addFunction(this)">
                                        <div class="pt-2">
                                            <video width="300" height="200" id="{{ $videoList->video }}"
                                                class="addcontentItem video-js vjs-theme-city" preload="auto"
                                                poster="{{ asset('images/gallary/clean-video-player-template.jpg') }}"
                                                data-setup="{}">
                                                <source src="{{ asset('contents/videos/' . $videoList->video) }}"
                                                    type="video/mp4">
                                            </video>
                                            <h6 style="font-size: 12px; margin-top: 5px;">{{ $videoList->video }}</h6>
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
                        <button type="button" class="btn btn-danger addvideomodalclose">OK</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('js')
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

        <script>
            $(document).ready(function() {
                // Flash message handling
                @if (session('status'))
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('{{ session('status') }}');
                @endif

                @if (session('error'))
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('{{ session('error') }}');
                @endif

                // Enable sortable rows
                $("#videoTable tbody").sortable({
                    cursor: 'move',
                    opacity: 0.6,
                }).disableSelection();

                // Handle delete icon click event


                var selectedRowIndex;

                // Handle update icon click event
                $(document).on('click', '.updateIcon', function() {
                    // Store the index of the selected row
                    selectedRowIndex = $(this).closest('tr').index();

                    // Get the closest table row
                    var row = $(this).closest('tr');

                    var fullUrl = row.find('video source').attr('src'); // Get the full URL
                    var videoSrc = fullUrl.split('/').pop(); // Extract the filename

                    var duration = row.find('td').eq(1).text().trim();
                    var repeat = row.find('td').eq(2).text().trim() === 'Yes' ? 'true' : 'false';
                    var mute = row.find('td').eq(3).text().trim() === 'Yes' ? 'true' : 'false';

                    // Set the values in the modal
                    $("#videoFile").val(videoSrc);
                    $("#duration").val(duration);
                    $("#repeat").val(repeat);
                    $("#mute").val(mute);
                    $("#repeat").val(repeat).change();
                    $("#mute").val(mute).change();

                    // Open the modal
                    $('#UPDATEvideoMODAL').modal('show');
                });

                // Handle form submission for updating video details
                $('#UPDATEvideoFORM').on('submit', function(e) {
                    e.preventDefault(); // Prevent form submission

                    // Get the values from the form
                    var videoSrc = $('#videoFile').val();
                    var duration = $('#duration').val();
                    var repeat = $('#repeat').val();
                    var mute = $('#mute').val();

                    // Find the specific row using the stored index
                    var row = $('#videoTable tbody').find('tr').eq(selectedRowIndex);

                    // Update the table row with the new values
                    row.find('video source').attr('src', '{{ asset('contents/videos/') }}/' + videoSrc);

                    row.find('video')[0].load(); // Reload the video to apply the new source
                    row.find('td').eq(1).text(duration);
                    row.find('td').eq(2).html('<span class="badge ' + (repeat === 'true' ? 'bg-primary' :
                        'bg-warning') + '">' + (repeat === 'true' ? 'Yes' : 'No') + '</span>');
                    row.find('td').eq(3).html('<span class="badge ' + (mute === 'true' ? 'bg-primary' :
                        'bg-warning') + '">' + (mute === 'true' ? 'Yes' : 'No') + '</span>');

                    // Close the modal
                    $('#UPDATEvideoMODAL').modal('hide');
                });

            });
            $('.videomodalclose').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#updateModal').modal('hide');
                $('#UPDATEvideoMODAL').modal('show');
            });
            $('.addvideomodalclose').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#addModal').modal('hide');
                $('#ADDvideoMODAL').modal('show');
            });



            function myFunction(element) {
                var vid = element.querySelector("video");
                var durationInput = document.getElementById("duration");
                durationInput.value = formatTime(vid.duration);
            }

            function addFunction(element) {
                var vid = element.querySelector("video");
                var durationInput = document.getElementById("addduration");
                durationInput.value = formatTime(vid.duration);
            }

            function formatTime(seconds) {
                var hours = Math.floor(seconds / 3600);
                var minutes = Math.floor((seconds % 3600) / 60);
                var seconds = Math.floor(seconds % 60);

                var timeString = pad(hours, 2) + ':' + pad(minutes, 2) + ':' + pad(seconds, 2);
                return timeString;
            }

            function pad(number, length) {
                var str = '' + number;
                while (str.length < length) {
                    str = '0' + str;
                }
                return str;
            }

            // For content items outside the table
            $(document).on('click', '.contentItem', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $("#videoFile").val(id); // Set the value of the input field to the id

                // Remove background color class from all elements outside the table
                $('.contentItem').not('#videoTable .contentItem').removeClass('bg-primary');

                // Add background color class to the clicked element
                $(this).addClass('bg-primary');
            });

            // For add content items outside the table
            $(document).on('click', '.addcontentItem', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $("#addvideoFile").val(id); // Set the value of the input field to the id

                // Remove background color class from all elements outside the table
                $('.addcontentItem').not('#videoTable .addcontentItem').removeClass('bg-primary');

                // Add background color class to the clicked element
                $(this).addClass('bg-primary');
            });

            $('.save_btn').click(function(e) {
                e.preventDefault();
                let name = $("#playlist_name").val();

                var tableData = [];

                // Iterate through each row in the table body
                $('#videoTable tbody tr').each(function() {
                    // Get the data from each cell
                    var videoSrc = $(this).find('video source').attr('src').split('/')
                        .pop(); // Extract filename
                    var duration = $(this).find('td').eq(1).text().trim();
                    var repeat = $(this).find('td').eq(2).text().trim() === 'Yes' ? 'true' : 'false';
                    var mute = $(this).find('td').eq(3).text().trim() === 'Yes' ? 'true' : 'false';
                    var id = $(this).find('td').eq(4).text().trim();

                    // Push data into the array
                    tableData.push({
                        videoSrc: videoSrc,
                        duration: duration,
                        repeat: repeat,
                        mute: mute,
                        id: id
                    });
                });
                $.ajax({
                    url: '/video-playlist-update', // Replace with your endpoint URL
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
                     $(location).attr('href','/video-playlist-show-content/'+name);

                    }

                });
            });
            $(".add_btn").click(function(e) {
                e.preventDefault();
                $('#ADDvideoMODAL').modal('show');

            });
            $(".cancel_btn").click(function(e) {
                e.preventDefault();
                $('#ADDvideoMODAL').modal('hide');
                $('#UPDATEvideoMODAL').modal('hide');

            });
            $('.deleteIcon').on('click', function() {
                $(this).closest('tr').fadeOut(300, function() {
                    $(this).remove();
                });
            });

            $('#ADDvideoFORM').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                // Get the values from the form
                var videoSrc = $('#addvideoFile').val();
                var duration = $('#addduration').val();
                var repeat = $('#addrepeat').val() === 'true' ? 'Yes' : 'No';
                var mute = $('#addmute').val() === 'true' ? 'Yes' : 'No';

                // Define the base URL for videos
                var baseUrl = "{{ asset('contents/videos/') }}"; // PHP will replace this with the base URL

                // Construct the full URL for the video source
                var videoURL = videoSrc ? baseUrl + '/' + videoSrc : '';

                var videoHTML = videoSrc ? `
                <video width="150" height="150" controls>
                    <source src="${videoURL}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>` : 'N/A';

                // Determine the classes for the badges
                var repeatBadgeClass = repeat === 'Yes' ? 'bg-primary' : 'bg-warning';
                var muteBadgeClass = mute === 'Yes' ? 'bg-primary' : 'bg-warning';

                // Create a new row with the fetched values
                var newRow = `
                    <tr>
                        <td>${videoHTML}</td>
                        <td>${duration}</td>
                        <td><span class="badge ${repeatBadgeClass}">${repeat}</span></td>
                        <td><span class="badge ${muteBadgeClass}">${mute}</span></td>
                        <td style="display:none;"></td>
                        <td>
                            <a href="javascript:;" class="updateIcon" data-id="${new Date().getTime()}">
                                <i class="fas fa-edit" style="color: rgb(26, 241, 19)"></i>
                            </a>
                            <a href="javascript:;" onclick="  $(this).closest('tr').fadeOut(300, function() {
                    $(this).remove();});" class="deleteIcon">
                                <i class="fas fa-trash" style="color: red"></i>
                            </a>
                        </td>
                    </tr>`;

                // Append the new row to the table body
                $('#videoTable tbody').append(newRow);

                // Close the modal
                $('#ADDvideoMODAL').modal('hide');

                // Reset the form fields if needed
                $('#ADDvideoFORM')[0].reset();
            });
        </script>
    @endpush
</x-layout>
