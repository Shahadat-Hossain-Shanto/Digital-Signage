<style>
    /* Base style for #data */
    #data {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: all 0.5s ease-in-out;
    }

    /* Fade transition */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .fade-out {
        animation: fadeOut 0.5s ease-in-out forwards;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    .fade-out-zoom {
        animation: fadeOutZoom 0.5s ease-in-out forwards;
    }

    @keyframes fadeOutZoom {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }



    /* Flip transition */
    .flip-in {
        animation: flipIn 0.5s ease-in-out forwards;
    }

    @keyframes flipIn {
        from {
            transform: rotateY(90deg);
            opacity: 0;
        }

        to {
            transform: rotateY(0deg);
            opacity: 1;
        }
    }

    .flip-out {
        animation: flipOut 0.5s ease-in-out forwards;
    }

    @keyframes flipOut {
        from {
            transform: rotateY(0deg);
            opacity: 1;
        }

        to {
            transform: rotateY(90deg);
            opacity: 0;
        }
    }

    /* Zoom transition */
    .zoom-in {
        animation: zoomIn 0.5s ease-in-out forwards;
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Dissolve transition */
    .dissolve {
        animation: dissolve 0.5s ease-in-out forwards;
    }

    @keyframes dissolve {
        from {
            opacity: 0;
            filter: blur(10px);
        }

        to {
            opacity: 1;
            filter: blur(0);
        }
    }

    .dissolve-out {
        animation: dissolveOut 0.5s ease-in-out forwards;
    }

    @keyframes dissolveOut {
        from {
            opacity: 1;
            filter: blur(0);
        }

        to {
            opacity: 0;
            filter: blur(10px);
        }
    }

    /* Slide transition */
    .slide {
        animation: slide 0.5s ease-in-out forwards;
    }

    @keyframes slide {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .slide-out {
        animation: slideOut 0.5s ease-in-out forwards;
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }


    /* Bounce transition */
    .bounce {
        animation: bounce 0.5s ease-in-out forwards;
    }

    @keyframes bounce {


        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-30px);
        }

        60% {
            transform: translateY(-15px);
        }
    }

    /* Rotate transition */
    .rotate {
        animation: rotate 0.5s ease-in-out forwards;
    }

    @keyframes rotate {
        from {
            transform: rotate(-360deg);
            opacity: 0;
        }

        to {
            transform: rotate(0deg);
            opacity: 1;
        }
    }

    .rotate-out {
        animation: rotateOut 0.5s ease-in-out forwards;
    }

    @keyframes rotateOut {
        from {
            transform: rotate(0deg);
            opacity: 1;
        }

        to {
            transform: rotate(360deg);
            opacity: 0;
        }
    }

    /* Roll transition (enhanced) */
    .roll {
        animation: roll 0.5s ease-in-out forwards;
    }

    @keyframes roll {
        from {
            transform: translateX(-200%) rotate(-720deg);
            /* Larger movement and rotation */
            opacity: 0;
        }

        to {
            transform: translateX(0) rotate(0deg);
            opacity: 1;
        }
    }

    /* Roll-out transition (enhanced) */
    .roll-out {
        animation: rollOut 0.5s ease-in-out forwards;
    }

    @keyframes rollOut {
        from {
            transform: translateX(0) rotate(0deg);
            opacity: 1;
        }

        to {
            transform: translateX(200%) rotate(720deg);
            /* Larger movement and rotation */
            opacity: 0;
        }
    }



    /* Jack-in-the-box transition */
    .jack-in-box {
        animation: jackInBox 1s ease-in-out forwards;
    }

    @keyframes jackInBox {
        from {
            opacity: 0;
            transform: scale(0.1) rotate(30deg);
            transform-origin: center bottom;
        }

        50% {
            transform: scale(1.2) rotate(-10deg);
        }

        70% {
            transform: scale(0.9) rotate(3deg);
        }

        to {
            opacity: 1;
            transform: scale(1) rotate(0);
        }
    }

    .jack-out-box {
        animation: jackOutBox 0.7s ease-in-out forwards;
    }

    @keyframes jackOutBox {
        0% {
            transform: scale(1) rotate(0deg);
            /* Starts at normal size */
            opacity: 1;
        }

        30% {
            transform: scale(1.1) rotate(-10deg);
            /* Slight bounce for a playful exit */
        }

        70% {
            transform: scale(0.8) rotate(10deg);
            /* Shrinks and tilts as if going into the box */
        }

        100% {
            transform: scale(0) rotate(-90deg);
            /* Disappears into the box */
            opacity: 0;
        }
    }



    #layout {
        position: relative;
        overflow: hidden;
        height: 100vh;
    }

    #data {
        margin: 0;
        padding: 0;
        min-width: 100%;
        min-height: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>

<x-layout titlePage="Signage" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='signage'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Signage" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Signage </strong></h6>
                                    </div>
                                    <div class='col-6 position-relative'>
                                        <svg hidden id='fullscreen' class='position-absolute mt-2 end-5 text-white'
                                            onclick="openFullscreen()" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-arrows-fullscreen"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="row">
                                    <div class='col-3'>
                                        <select name="playlist" class="form-select" id="playlist">
                                            @foreach ($playlists as $playlist)
                                                <option value="{{ $playlist->playlist_name }}">
                                                    {{ $playlist->playlist_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='col-3'>
                                        <select name="transition" class="form-select" id="transition">
                                            <option value="fade-in">fade-in</option>
                                            <option value="flip-in">flip-in</option>
                                            <option value="zoom-in">zoom-in</option>
                                            <option value="dissolve">dissolve</option>
                                            <option value="slide">slide</option>
                                            {{-- <option value="bounce">bounce</option> --}}
                                            <option value="rotate">rotate</option>
                                            <option value="roll">roll</option>
                                            <option value="jack-in-box">jack in box</option>



                                        </select>
                                    </div>
                                    <div class='col-6'>
                                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100"
                                            id='btn'>Display</button>
                                    </div>
                                </div>
                                <div style="text-align: center;" id="layout" hidden>
                                    <audio hidden id='audioData' autoplay loop>
                                        Your browser does not support the audio file.
                                    </audio>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

        <script>
            let delay = 0;
            // async function replaceObject(newData) {
            //     var obj = $('#data');

            //     if(obj){
            //         $('#data').remove();
            //     }
            //     var newObject = $('<object id="data" data="' + newData + '">Your browser does not support this file.</object>');
            //     $('#layout').append(newObject);
            // }
            async function replaceObject(newData, transition = 'fade-in') {
                let obj = $('#data');

                if (obj.length) {
                    if (transition == 'zoom-in') {
                        obj.removeClass().addClass('fade-out-zoom ');
                    }
                    if (transition == 'fade-in') {
                        obj.removeClass().addClass('fade-out ');
                    }
                    if (transition == 'flip-in') {
                        obj.removeClass().addClass('flip-out ');
                    }
                    if (transition == 'dissolve') {
                        obj.removeClass().addClass('dissolve-out ');
                    }
                    if (transition == 'slide') {
                        obj.removeClass().addClass('slide-out ');
                    }
                    if (transition == 'rotate') {
                        obj.removeClass().addClass('rotate-out ');
                    }
                    if (transition == 'roll') {
                        obj.removeClass().addClass('roll-out ');
                    }
                    if (transition == 'jack-in-box') {
                        obj.removeClass().addClass('jack-out-box');
                    } else
                        obj.removeClass().addClass('fade-out ');


                    await new Promise(resolve => setTimeout(resolve, 500)); // Wait for fade-out
                    obj.remove();
                }

                // Create a new object
                let newObject = $('<object id="data" data="' + newData +
                    '">Your browser does not support this file.</object>');
                newObject.addClass(transition); // Add the chosen transition class
                $('#layout').append(newObject);
            }

            // const transitions = ['fade-in', 'flip-in', 'zoom-in'];

            // async function replaceObjectWithRandomTransition(newData) {
            //     const randomTransition = transitions[Math.floor(Math.random() * transitions.length)];
            //     await replaceObject(newData, randomTransition);
            // }



            // async function setVideo(list) {
            //     $('#audioData').attr('src', '');
            //     replaceObject('/contents/videos/'+list.content);
            //     var obj = document.getElementById('data');
            //     obj.addEventListener('load', function() {
            //         var video = obj.contentDocument.querySelector('video');
            //         if (video) {
            //             video.controls = false;
            //             video.style.width = '100%';
            //             video.style.height = '100%';
            //             video.style.objectFit = 'contain';
            //             video.muted = (list.mute === 'false') ? false : true;
            //         }
            //     });
            // }

            // async function setImage(list) {
            //     replaceObject('/contents/images/'+list.content);
            //     // setAudioSource(list)
            // }
            async function setImage(list, transition) {
                await replaceObject('/contents/images/' + list.content, transition);
            }

            async function setVideo(list, transition) {
                $('#audioData').attr('src', '');
                await replaceObject('/contents/videos/' + list.content, transition);
            }



            async function setAudioSource(list) {
                let audio = $('#audioData');
                if (list.mute == 'true') {
                    audio.attr('src', '');
                } else {

                    if (audio[0].src != 'http://127.0.0.1:8000/contents/audios/' + list.audio_file_name) {
                        audio.attr('src', '/contents/audios/' + list.audio_file_name);
                    }
                }
            }

            function timeToSeconds(time) {
                const parts = time.split(':');
                const hours = parseInt(parts[0], 10);
                const minutes = parseInt(parts[1], 10);
                const seconds = parseInt(parts[2], 10);
                return (hours * 3600) + (minutes * 60) + seconds;
            }


            async function processPlaylistDetails(details) {
                let i = 0;
                let isFirstRun = true;
                const transition = $('#transition').val(); // Get the selected transition

                while (true) {
                    const list = details[i];

                    // Handle content display
                    if (list.content) {
                        if (list.content_type === 'Image') {
                            await setImage(list, transition);
                            delay = parseInt(list.duration) * 1000; // Duration in milliseconds
                        } else {
                            // Video content
                            await setVideo(list, transition);
                            delay = parseInt(timeToSeconds(list.duration)) * 1000; // Convert HH:mm:ss to ms
                        }
                    }

                    // Apply full-screen and layout adjustments
                    $("#layout").css({
                        position: 'relative',
                        overflow: 'hidden',
                        height: '100vh'
                    });
                    $("#data").css({
                        margin: 0,
                        padding: 0,
                        position: "absolute",
                        top: 0,
                        left: 0,
                        zIndex: 1,
                        minWidth: '100%',
                        minHeight: '100%',
                        maxHeight: '100%',
                        objectFit: 'contain'
                    });

                    // Fullscreen logic on first run
                    if (isFirstRun) {
                        openFullscreen();
                        isFirstRun = false;
                    }

                    // Show layout and fullscreen button
                    $("#layout").removeAttr('hidden');
                    $("#fullscreen").removeAttr('hidden');

                    // Wait for the duration of the current item
                    await new Promise(resolve => setTimeout(resolve, delay));

                    // Move to the next playlist item
                    i++;
                    if (i === details.length) {
                        i = 0; // Loop back to the start
                    }
                }
            }



            $(document).on("click", ".btn", function(e) {
                e.preventDefault();
                let device_id = $('#playlist').val();
                $.ajax({
                    type: "get",
                    url: "/api/search-playlist-info/" + device_id,
                    // success: function (response) {
                    //     console.log(response)

                    // },
                    success: function(response) {
                        console.log(response)

                        processPlaylistDetails(response.data);
                    }
                });

            });

            var elem = document.getElementById("layout");

            function openFullscreen() {
                if (!document.fullscreenElement) {
                    if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                    } else if (elem.webkitRequestFullscreen) {
                        /* Safari */
                        elem.webkitRequestFullscreen();
                    } else if (elem.msRequestFullscreen) {
                        /* IE11 */
                        elem.msRequestFullscreen();
                    }
                }
            }

            function closeFullscreen() {
                if (document.fullscreenElement) {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) {
                        /* Safari */
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        /* IE11 */
                        document.msExitFullscreen();
                    }
                }
            }
        </script>
    @endpush
</x-layout>
