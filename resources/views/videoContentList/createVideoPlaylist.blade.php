<x-layout titlePage="Create Video Playlist" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='video.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Create Video Playlist" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"> Video Playlist</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Create Video Playlist </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('video.playlist.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-label" for="priority">Playlist Name</label>
                                            <input type="text" class="form-control border border-2 p-2" id="playlist_name">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Video File Name</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border border-2 p-2" id="videoFile" placeholder="Choose a video" readonly data-bs-toggle="modal" data-bs-target="#updateModal">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label" for="">Duration(in seconds)</label>
                                            <input type="text" class="form-control border border-2 p-2" id="duration" value="00:00:00" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label" for="">Repeat</label>
                                            <select class=" form-control border border-2 p-2" data-live-search="true" id="repeat">
                                                <option  disabled selected>plesse select</option>
                                                <option  value="true">Yes</option>
                                                <option  value="false">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="form-label" for="">Mute</label>
                                            <select class=" form-control border border-2 p-2" data-live-search="true" id="mute">
                                                <option  disabled selected>Select</option>
                                                <option  value="true">Yes</option>
                                                <option  value="false">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 mt-2">
                                            <button class="btn btn-primary mt-4 pb-2 pt-1" id="addtotable">Add</button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="hidden">PlayList Name</th>
                                                        <th>Video File name</th>
                                                        <th>Duration</th>
                                                        <th>Repeat</th>
                                                        <th>Mute</th>
                                                        <th>Action</th>
                                                        {{-- <th class="hidden">check</th>
                                                        <th class="hidden">Member_ID</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">

                                                    <!-- Add more rows as needed -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <button id="submit" class="btn btn-success">Submit </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <form action="" method="" id="updateForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="updateModalLabel">CHOOSE ANY VIDEO</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body" style="text-align: center;">
                            <div class="row">
                                @if (!is_null($videoLists))
                                    @foreach ($videoLists as $videoList)
                                        <div class="col-lg-4 mb-2" onclick="myFunction(this)">
                                            <div class="pt-2">
                                                <video width="300" height="200" id="{{ $videoList->video }}" class="contentItem video-js vjs-theme-city" preload="auto" poster="{{ asset('images/gallary/clean-video-player-template.jpg') }}" data-setup="{}">
                                                    <source src="{{ asset('contents/videos/' . $videoList->video ) }}" type="video/mp4">
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
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
    <!-- the jQuery Library -->
    <script>
        $(document).ready(function () {

        var playlist_name;
        var videoFile;
        var duration;
        var repeat;

        $('#addtotable').click(function (e) {
            e.preventDefault();
            var playlist_name =$('#playlist_name').val();
            var videoFile     =$('#videoFile').val();
            var duration      =$('#duration').val();
            var repeat        =$('#repeat').val();
            var mute          =$('#mute').val();

            // alert(imageFile);



            if (playlist_name !== '' && videoFile !== '' && duration!=='' && repeat!==null && mute!==null) {
                    $('#tbody').append(`
                    <tr>
                        <td class="hidden">${playlist_name}</td>
                        <td>${videoFile}</td>
                        <td>${duration}</td>
                        <td>${repeat}</td>
                        <td>${mute}</td>
                        <td><a class="delete-row text-danger ms-2 h5"><i class="material-icons">remove_circles</i></a></td> <!-- Delete button -->
                        </tr>`);

                        // <td><button class="btn btn-danger delete-row">Delete</button></td> <!-- Delete button -->

                    $('#playlist_name').prop('disabled', true);
                    $('#duration').val('00:00:00');
                    $('#videoFile').val('');
                    $('#repeat').prop('selectedIndex',0);
                }
                else
                {
                    alertify.set('notifier','position', 'top-right');
                    alertify.warning('All field must be filled');
                }

                // Event delegation for dynamically created delete buttons
                $('#tbody').on('click', '.delete-row', function() {
                    $(this).closest('tr').remove(); // Remove the closest parent row
                });
            });
        });

    </script>
    <script>

        $('#submit').click(function (e) {
            e.preventDefault();
            let data= {};

            var datas=[];

            $('.table tbody > tr').each(function () {
                const playlist_content = {};
                playlist_content["playlist_name"] = $(this).find("td:eq(0)").text();
                playlist_content["videoFile"]     = $(this).find("td:eq(1)").text();
                playlist_content["duration"]      = $(this).find("td:eq(2)").text();
                playlist_content["repeat"]        = $(this).find("td:eq(3)").text();
                playlist_content["mute"]          = $(this).find("td:eq(4)").text();

                datas.push(playlist_content);
            });

            data["playlist_contents"]=datas;
            // console.log(data)

                $.ajax({
                    type: "post",
                    url: "{{ route('video.playlist.store') }}",
                    data: JSON.stringify(data),
                    dataType: "json",
                    contentType: "application/json",

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            alertify.set('notifier','position', 'top-right');
                            alertify.success('Added successfully!');

                            $(location).attr('href','/video-playlist-view');
                        } else {
                            alertify.set('notifier','position', 'top-right');
                            alertify.warning(response.messsege);
                        }
                    }
                });

        });
    </script>

    <script>
        $(document).ready(function () {
            // ajax request
            $(document).on('click', '.contentItem', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $("#videoFile").val(id); // Set the value of the input field to the id
                // Remove background color class from all elements that previously had it applied
                $('.bg-primary').removeClass('bg-primary');
                // Add background color class to the parent div
                $(this).parent().addClass('bg-primary');
            });
        });

        function myFunction(element) {
            var vid = element.querySelector("video");
            var durationInput = document.getElementById("duration");
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

    </script>
    @endpush
</x-layout>












