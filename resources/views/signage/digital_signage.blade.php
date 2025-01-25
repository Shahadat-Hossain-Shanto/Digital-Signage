<link rel="stylesheet" href="{{ asset('assets/css/widgets.css') }}">

<x-layout titlePage="Digital Signage" bodyClass="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-navbars.navs.guest signup='register' signin='login'></x-navbars.navs.guest>
            </div>
        </div>
    </div>
    <div class="page-header justify-content-center min-vh-100"
        style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container mb-5">
            <h1 class="text-light text-center" id='welcome' style="margin-top: 10vh">Welcome to Digital Signage</h1>
            <div class=" me-3 my-5">
                <div class="row" style="transform: translateX(1.5%) translateY(0%);">
                    <div class='col-5' style="padding-right: 3.1rem">
                        <input type="text" id="device_id" class="form-control text-white border border-2 p-2">
                    </div>
                    <div class='col-2 text-center position-relative'
                        style="transform: translateX(1.5%) translateY(0%);padding-right: 4.2rem">
                        <svg hidden id='fullscreen' class='position-absolute mt-3 text-white' onclick="openFullscreen()"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707" />
                        </svg>
                    </div>
                    <div class='col-5 row'>
                        <div class='col-6'>
                            <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100"
                                id='btn'>Display</button>
                        </div>
                        <div class='col-6'>
                            <button type="reload" class="btn btn-lg bg-gradient-primary btn-lg w-100"
                                id='refreshBtn'>Refresh</button>
                        </div>

                    </div>
                </div>
                <div style="text-align: center;" id="layout" hidden>
                    <div id="backgroundData"></div>
                    <div hidden id='audio'></div>
                </div>
            </div>
        </div>
        <x-footers.guest></x-footers.guest>
    </div>
    @push('js')
        <script>
            let delay = 0;
            let audioDelay = 0;
            let audioContent = '';
            let background = 0;
            let four_zones = 0;

            async function replaceObject(newData) {
                let obj = $('#data');

                if (obj.length) {

                    obj.remove();
                }
                let newObject = $('<object id="data" data="' + newData +
                    '">Your browser does not support this file.</object>');

                $('#backgroundData').append(newObject);
            }

            async function setVideo(list) {
                replaceObject('/contents/videos/' + list.name);
                const obj = document.getElementById('data');

                obj.addEventListener('load', function() {
                    const video = obj.contentDocument?.querySelector('video');
                    if (video) {
                        video.controls = false;
                        video.style.width = '100%';
                        video.style.height = '100%';
                        video.style.objectFit = 'contain';
                        video.muted = list.mute === 'false' ? false : true;

                        if (background === 1) {
                            video.style.borderRadius = '20px';
                        }
                    } else {
                        // console.warn('Video element not found in the <object> content.');
                    }
                });
            }


            async function setImage(list) {
                replaceObject('/contents/images/' + list.name);
                if (background == 1) {
                    var obj = document.getElementById('data');
                    obj.addEventListener('load', function() {
                        var img = obj.contentDocument.querySelector('img');
                        if (img) {
                            img.style.borderRadius = '20px';
                        }
                    });
                }
            }

            async function setAudio(list) {
                replaceObject('/contents/audios/' + list.name);
                var obj = document.getElementById('data');
                obj.addEventListener('load', function() {
                    var video = obj.contentDocument.querySelector('video');
                    if (video) {
                        video.controls = false;
                        video.muted = (list.mute === 'false') ? false : true;
                    }
                });
            }

            async function setLink(list) {
                var content = list.name;
                var videoExtensions = [".mp4", ".webm", ".ogg"];
                var audioExtensions = [".mp3", ".ogg", ".wav"];
                var fileExtension = content.split('.').pop().toLowerCase();
                var youtubeId = null;
                var youtubeRegex = /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                var matches = content.match(youtubeRegex);

                if (matches) {
                    youtubeId = matches[1];
                }
                var mediaContainer = $('#data');
                if (mediaContainer) {
                    $('#data').remove();
                    $('#backgroundData').append('<div id="data" class="fade-in"></div>');
                    mediaContainer = $('#data');
                }

                let height = '100vh';
                let border = 'none';
                if (background == 1) {
                    height = '80vh';
                    border = '20px';
                }

                let mute = 0;
                if (list.mute == 'true') {
                    mute = 1;
                }

                if (youtubeId) {
                    mediaContainer.append(`
                    <iframe src="https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${youtubeId}" style="border-radius:${border}; min-width: inherit; min-height: ${height}; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>Your browser does not support this file.</iframe>
                `);
                } else if (videoExtensions.includes('.' + fileExtension)) {
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                    <video style="border-radius:${border}; min-width: inherit;min-height: 100vh;" autoplay ${amute} loop>
                        <source src="${content}" type="video/${fileExtension}">
                        Your browser does not support the video tag.
                    </video>
                `);
                } else if (audioExtensions.includes('.' + fileExtension)) {
                    // HTML5 Audio
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                    <audio style="border-radius:${border}; min-width: inherit;min-height: ${height};" autoplay ${amute} loop>
                        <source src="${content}" type="audio/${fileExtension}">
                        Your browser does not support the audio tag.
                    </audio>
                `);
                } else if (isValidUrl(content)) {
                    const iframe = $(`
                    <iframe id="iframe" width="100%" height="100%" src="${content}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${content}" style="border-radius:${border}; min-width: inherit;min-height: ${height}; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
                `)

                    mediaContainer.append(iframe);
                } else {
                    mediaContainer.append(`
                    <a href="${content}" target="_blank">
                        <button class="btn btn-link">View Link</button>
                    </a>
                `);
                }

                $('#backgroundData').append(mediaContainer);

                function isValidUrl(string) {
                    var res = string.match(/(http|https):\/\/[^\s]+/g);
                    return (res !== null);
                }
            };


            async function setAudioSource(list) {
                let type = 'audios';
                if (list.type === 'Video') {
                    type = 'videos';
                } else if (list.type === 'Image') {
                    type = 'images';
                } else if (list.type === 'Link') {
                    type = 'Link';
                }

                if (audioContent != list.name) {
                    var obj = $('#audioData');
                    if (obj) {
                        $('#audioData').remove();
                    }
                    audioContent = list.name;

                    if (type != 'Link') {
                        var newObject = $('<object id="audioData" data="/contents/' + type + '/' + list.name +
                            '">Your browser does not support this file.</object>');
                        $('#audio').append(newObject);
                        var obj = document.getElementById('audioData');
                        obj.addEventListener('load', function() {
                            var video = obj.contentDocument.querySelector('video');
                            if (video) {
                                video.loop = true;
                            }
                        });
                    } else {
                        var content = list.name;
                        var youtubeId = null;
                        var youtubeRegex =
                            /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                        var matches = content.match(youtubeRegex);

                        if (matches) {
                            youtubeId = matches[1];
                        }
                        var mediaContainer = $('#audioData');
                        if (mediaContainer) {
                            $('#audioData').remove();
                            $('#audio').append('<div id="audioData"></div>');
                            mediaContainer = $('#audioData');
                        }

                        if (youtubeId) {
                            mediaContainer.append(`
                            <iframe src="https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&controls=0&loop=1&playlist=${youtubeId}" style="min-width: inherit;min-height: 100vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>Your browser does not support this file.</iframe>
                            `);
                        } else if (isValidUrl(content)) {
                            mediaContainer.append(`
                            <iframe id="iframe" width="100%" height="100%" src="${content}?autoplay=1&controls=0&loop=1&playlist=${youtubeId}" style="min-width: inherit;min-height: 100vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
                            `);
                        } else {
                            // Default Link
                            mediaContainer.append(`
                            <a href="${content}" target="_blank">
                                <button class="btn btn-link">View Link</button>
                            </a>
                            `);
                        }
                        $('#audio').append(mediaContainer);

                        function isValidUrl(string) {
                            var res = string.match(/(http|https):\/\/[^\s]+/g);
                            return (res !== null);
                        }
                    }
                }
            }

            async function setBackground(list) {
                var content = list.name;
                var videoExtensions = [".mp4", ".webm", ".ogg"];
                var audioExtensions = [".mp3", ".ogg", ".wav"];
                var imageExtensions = [".jpg", ".jpeg", ".png", ".gif", ".bmp", ".svg"];
                var fileExtension = content.split('.').pop().toLowerCase();

                var youtubeId = null;
                var youtubeRegex = /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                var matches = content.match(youtubeRegex);

                if (matches) {
                    youtubeId = matches[1];
                }
                var mediaContentData = $('#backgroundContentData');
                if (mediaContentData) {
                    $('#backgroundContentData').remove();
                }
                var mediaContainer = $('#backgroundData');

                let mute = 0;
                if (list.mute == 'true') {
                    mute = 1;
                }

                if (youtubeId) {
                    mediaContainer.append(`
                    <iframe id="backgroundContentData" src="https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${youtubeId}" style="min-width: 100%;min-height: 100vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>Your browser does not support this file.</iframe>
                `);
                } else if (videoExtensions.includes('.' + fileExtension)) {
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                    <video id="backgroundContentData" style="min-width: inherit;min-height: 100vh;" autoplay ${amute} loop>
                        <source src="/contents/videos/${content}" type="video/${fileExtension}">
                        Your browser does not support the video tag.
                    </video>
                `);
                } else if (audioExtensions.includes('.' + fileExtension)) {
                    let amute = '';
                    if (mute == 1) {
                        amute = 'muted'
                    }
                    mediaContainer.append(`
                    <audio id="backgroundContentData" style="min-width: 100%;min-height: 100vh;" autoplay ${amute} loop>
                        <source src="/contents/audios/${content}" type="audio/${fileExtension}">
                        Your browser does not support the audio tag.
                    </audio>
                `);
                } else if (imageExtensions.includes('.' + fileExtension)) {
                    mediaContainer.append(`
                <img id="backgroundContentData" src="/contents/images/${content}" 
                    alt="Your browser does not support the img tag" 
                    style="width: 100%; height: 100%;  position: relative; top: 0; left: 0;">
                `);

                } else if (isValidUrl(content)) {
                    mediaContainer.append(`
                    <iframe id="backgroundContentData" width="100%" height="100%" src="${content}?autoplay=1&controls=0&mute=${mute}&loop=1&playlist=${content}" style="min-width: 100%;min-height: 100vh; border: none;" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen onerror="handleIframeError(this, '${content}')">Your browser does not support this file.</iframe>
                `);
                } else {
                    mediaContainer.append(`
                    <a id="backgroundContentData" href="${content}" target="_blank">
                        <button class="btn btn-link">View Link</button>
                    </a>
                `);
                }

                function isValidUrl(string) {
                    var res = string.match(/(http|https):\/\/[^\s]+/g);
                    return (res !== null);
                }
            };

            function timeToSeconds(time) {
                const parts = time.split(':');
                const hours = parseInt(parts[0], 10);
                const minutes = parseInt(parts[1], 10);
                const seconds = parseInt(parts[2], 10);
                return (hours * 3600) + (minutes * 60) + seconds;
            }

            async function processAudios(details) {
                if (details) {
                    let i = 0;
                    while (i < details.length) {
                        const list = details[i];
                        setAudioSource(list);
                        audioDelay = parseInt(list.duration) * 1000;
                        await new Promise(resolve => setTimeout(resolve, audioDelay));
                        i++;
                        if (i == details.length) {
                            i = 0;
                        }
                    }
                }
            }

            async function processPlaylistDetails(details) {
                if (details) {
                    let i = 0;
                    let j = 0;
                    while (i < details.length) {
                        const list = details[i];
                        if (list.type == 'Image') {
                            setImage(list);
                            delay = parseInt(list.duration) * 1000;
                        } else if (list.type == 'Video') {
                            setVideo(list);
                            delay = parseInt(list.duration) * 1000;
                        } else if (list.type == 'Audio') {
                            setAudio(list);
                            delay = parseInt(list.duration) * 1000;
                        } else if (list.type == 'Link') {
                            setLink(list);
                            delay = parseInt(list.duration) * 1000;
                        } else if (list.type == 'App') {
                            setLink(list);
                            delay = parseInt(list.duration) * 1000;
                        }

                        if (background == 1) {
                            $("#backgroundData").css("position", "relative");
                            $("#data").css("position", "absolute");
                            $("#data").css("top", '50%');
                            $("#data").css("left", '50%');
                            $("#data").css("z-index", 2);
                            $("#data").css("min-width", '80%');
                            $("#data").css("min-height", '80%');
                            $("#data").css("max-height", '80%');
                            $("#data").css("object-fit", 'contain');
                            $("#data").css("transform", 'translate(-50%, -50%)');
                        } else {
                            $("#data").css("margin", 0);
                            $("#data").css("padding", 0);
                            $("#data").css("position", "absolute");
                            $("#data").css("top", 0);
                            $("#data").css("left", 0);
                            $("#data").css("z-index", 1);
                            $("#data").css("min-width", '100%');
                            $("#data").css("min-height", '100%');
                            $("#data").css("max-height", '100%');
                            $("#data").css("object-fit", 'contain');
                        }

                        if (i == 0 && j == 0) {
                            j++;
                            openFullscreen();
                        }
                        $("#layout").removeAttr('hidden');
                        $("#fullscreen").removeAttr('hidden');
                        await new Promise(resolve => setTimeout(resolve, delay));

                        i++;
                        if (i == details.length) {
                            i = 0;
                        }
                    }
                    if (details.length == 0) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.warning('Template has no content');
                        $('#data').remove();
                    }
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.warning('Template has no content');
                    $('#data').remove();
                }
            }
            async function replaceZoneObject(zoneId, newData) {

                const zone = $(zoneId);

                if (zone.length) {
                    zone.empty(); // Clear the existing content in the zone
                }

                const newObject = `
                <object id="${zoneId.substring(1)}Object" data="${newData}" type="text/html" 
                    style="width: 100%; height: 100%; object-fit: contain;">
                    Your browser does not support this file.
                </object>
                `;

                zone.append(newObject);

                // console.log(`replaceZoneObject called for zoneId: ${zoneId} with newData: ${newData}`);


            }

            async function setVideoZone(list, zoneId) {
                const videoPath = `/contents/videos/${list.name}`;

                await replaceZoneObject(zoneId, videoPath);

                const obj = document.querySelector(`${zoneId}`);
                obj.onload = null;
                obj.addEventListener("load", function() {
                    const video = obj.contentDocument?.querySelector("video");
                    if (video) {
                        video.controls = false;
                        video.autoplay = true;
                        video.loop = true;
                        video.muted = list.mute === "true";
                        video.style.width = "100%";
                        video.style.height = "100%";
                        video.style.objectFit = "contain";

                        if (background === 1) {
                            video.style.borderRadius = "20px";
                        }
                    }
                });
            }

            async function setImageZone(list, zoneId) {
                const imagePath = `/contents/images/${list.name}`;
                // console.log(imagePath)
                // console.log(zoneId)

                await replaceZoneObject(zoneId, imagePath);

                if (background === 1) {
                    const obj = document.querySelector(`${zoneId}`);
                    obj.onload = null;
                    obj.addEventListener("load", function() {
                        const img = obj.contentDocument?.querySelector("img");
                        if (img) {
                            img.style.borderRadius = "20px";
                        }
                    });
                }
            }

            async function setAudioZone(list, zoneId) {
                const audioPath = `/contents/audios/${list.name}`;
                await replaceZoneObject(zoneId, audioPath);

                const obj = document.querySelector(`${zoneId}Object`);
                obj.onload = null;
                obj.addEventListener("load", function() {
                    const audio = obj.contentDocument?.querySelector("audio");
                    if (audio) {
                        audio.controls = false;
                        audio.autoplay = true;
                        audio.loop = true;
                        audio.muted = list.mute === "true";
                    }
                });
            }

            async function setLinkZone(list, zoneId) {
                const content = list.name;
                const youtubeRegex = /(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/;
                const matches = content.match(youtubeRegex);
                const youtubeId = matches ? matches[1] : null;

                let mediaPath = content;

                if (youtubeId) {
                    mediaPath =
                        `https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&controls=0&mute=${list.mute === "true" ? "1" : "0"}&loop=1&playlist=${youtubeId}`;
                }

                await replaceZoneObject(zoneId, mediaPath);
            }

            // async function setAppZone(list, zoneId) {
            //     const content = list.name;
            //     let app_content = "";
            //     if (content == "Digital Clock 3") {
            //         app_content = `<div id="parent-container" style="width: 100%; height: auto; position: relative; text-align: center; overflow: hidden;">
    //                     <iframe
    //                         id="dynamic-iframe"
    //                         src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=&timezone=Asia%2FDhaka"
    //                         style="
    //                             width: 800px; 
    //                             height: 600px; 
    //                             border: none; 
    //                             transform-origin: top left;"
    //                         frameborder="0"
    //                         seamless>
    //                     </iframe>
    //                 </div>`;
            //     }

            //     if (content == "Weather") {
            //         app_content = `<div class="mb-2" style="width: 100%; height: 100%; border: 1px solid #ddd;">
    //                     <div class="weather-widget">
    //                         <div class="current-weather">
    //                             <img id="weather-icon" src="" alt="Weather Icon">
    //                             <h1 id="location">Loading...</h1>
    //                             <h2 id="temperature">--°C</h2>
    //                             <p id="description">--</p>
    //                         </div>
    //                     </div>
    //                 </div>`;
            //     }

            //     if (content == "Banner") {
            //         app_content = `<div class="moving-banner">
    //                     <span class="banner-content">we are here</span>
    //                 </div>`;
            //     }

            //     // Append directly to the zoneId
            //     const zone = $(zoneId);
            //     if (zone.length) {
            //         zone.html(app_content); // Replace the content in the zone with app_content
            //     }
            // }
            async function setAppZone(list, zoneId) {
                const content = list.name;
                let app_content = "";

                if (content == "Digital Clock 1") {
                    app_content = `<div class="clock">
                            <div class="time-unit hours">
                                <div class="digit" id="hour-first">0</div>
                                <div class="digit" id="hour-second">0</div>
                            </div>
                            <div class="separator">:</div>
                            <div class="time-unit minutes">
                                <div class="digit" id="minute-first">0</div>
                                <div class="digit" id="minute-second">0</div>
                            </div>
                            <div class="separator">:</div>
                            <div class="time-unit seconds">
                                <div class="digit" id="second-first">0</div>
                                <div class="digit" id="second-second">0</div>
                            </div>
                        </div>`;
                }
                // Digital Clock 2
                if (content == "Digital Clock 2") {
                    app_content = `<div id="clockdate">
                        <div class="clockdate-wrapper">
                            <div id="dateclock"></div>
                            <div id="date"></div>
                        </div>
                    </div>

                    <style>
                        @font-face {
                            font-family: 'Digital-7';
                            src: url('fonts/digital-7.ttf') format('woff2'), url('digital-7.woff') format('woff');
                        }

                        .clockdate-wrapper {
                            background: #141E30;
                            background: linear-gradient(to right, #243B55, #141E30);
                            width: 100%;
                            height: 100%;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            border-radius: 5px;
                            overflow: hidden;
                            box-sizing: border-box;
                        }

                        #dateclock {
                            font-family: Digital-7, sans-serif;
                            color: #fff;
                            text-shadow: 0px 0px 3px #fff;
                            white-space: nowrap;
                        }

                        #date {
                            letter-spacing: 0.1vw;
                            font-size: 1rem;
                            font-family: Arial, sans-serif;
                            color: #fff;
                            white-space: nowrap;
                            margin-top: 1vh;
                        }
                    </style>`;
                    }
                    
                    if (content == "Digital Clock 3") {
                        app_content = `<div class="clock">
                                            <div class="time-unit iframe-container">
                                                <iframe
                                                    id="dynamic-iframe"
                                                    src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=&timezone=Asia%2FDhaka"
                                                    style="width: 800px; height: 600px; border: none; transform-origin: top left;"
                                                    frameborder="0"
                                                    seamless>
                                                </iframe>
                                            </div>
                                        </div>`;
                    }
                    if (content == "Weather") {
                        app_content = `<div class="mb-2" style="width: 100%; height:100%; border: 1px solid #ddd;">
                            <div class="weather-widget">
                                <div class="current-weather">
                                    <h5 id="location">Loading...</h5>
                                    <h5 id="temperature">--°C</h5>
                                    <p id="description">--</p>
                                </div>
                              
                            </div>
                        </div>`;
                    }

                    

                // Append the content to the zone
                const zone = $(zoneId);
                if (zone.length) {
                    zone.html(app_content); // Replace the content in the zone with app_content

                    // Trigger clock update logic for "Digital Clock 1"
                    if (content == "Digital Clock 1") {
                        function updateClock() {
                            const now = new Date();
                            const hours = String(now.getHours()).padStart(2, "0");
                            const minutes = String(now.getMinutes()).padStart(2, "0");
                            const seconds = String(now.getSeconds()).padStart(2, "0");

                            updateDigits("hour-first", hours[0]);
                            updateDigits("hour-second", hours[1]);
                            updateDigits("minute-first", minutes[0]);
                            updateDigits("minute-second", minutes[1]);
                            updateDigits("second-first", seconds[0]);
                            updateDigits("second-second", seconds[1]);
                        }

                        function updateDigits(id, newDigit) {
                            const element = document.getElementById(id);
                            if (element.textContent !== newDigit) {
                                element.classList.add("flip-out");
                                setTimeout(() => {
                                    element.textContent = newDigit;
                                    element.classList.remove("flip-out");
                                    element.classList.add("flip-in");
                                }, 300); // Delay to match the flip-out animation
                            }
                        }

                        // Update the clock every second
                        updateClock();
                        setInterval(updateClock, 1000);
                    }
                    // Digital Clock 2 Logic
                    if (content == "Digital Clock 2") {
                        function startTime() {
                            const today = new Date();
                            let hr = today.getHours();
                            let min = today.getMinutes();
                            let sec = today.getSeconds();
                            const ap = hr < 12 ? "<span>AM</span>" : "<span>PM</span>";
                            hr = hr == 0 ? 12 : hr;
                            hr = hr > 12 ? hr - 12 : hr;

                            hr = checkTime(hr);
                            min = checkTime(min);
                            sec = checkTime(sec);
                            document.getElementById("dateclock").innerHTML = `${hr}:${min}:${sec} ${ap}`;

                            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                                'September', 'October', 'November', 'December'
                            ];
                            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                            const curWeekDay = days[today.getDay()];
                            const curDay = today.getDate();
                            const curMonth = months[today.getMonth()];
                            const curYear = today.getFullYear();
                            const date = `${curWeekDay}, ${curDay} ${curMonth} ${curYear}`;
                            document.getElementById("date").innerHTML = date;

                            setTimeout(startTime, 500);
                        }

                        function checkTime(i) {
                            return i < 10 ? "0" + i : i;
                        }

                        function adjustFontSize() {
                            const wrapper = document.querySelector('.clockdate-wrapper');
                            const clock = document.getElementById("dateclock");
                            const date = document.getElementById("date");

                            const width = wrapper.offsetWidth;
                            const height = wrapper.offsetHeight;

                            const clockFontSize = Math.min(width, height) * 0.2;
                            const dateFontSize = clockFontSize * 0.3;

                            clock.style.fontSize = `${clockFontSize}px`;
                            date.style.fontSize = `${dateFontSize}px`;
                        }

                        const resizeObserver = new ResizeObserver(() => {
                            adjustFontSize();
                        });

                        resizeObserver.observe(document.querySelector('.clockdate-wrapper'));

                        startTime();
                        adjustFontSize();
                    }
                    if (content == "Weather") {
                        startWeatherWidget();
                    }

                    
                        

                }
            }
            async function setBannerZone(list, zoneId) {
                const content = list.name;
                let app_content = "";
                        app_content = `
                            <div class="moving-banner">
                                <span class="banner-content">${list.name}</span>
                            </div>`;
                            const zone = $(zoneId);
                        if (zone.length) {
                            zone.html(app_content); // Replace the content in the zone with app_content

                        }
            }

            async function playZoneContent(contentList, zoneId) {
                while (true) { // Infinite loop to repeat content
                    for (const item of contentList) {
                        const expectedDuration = parseInt(item.duration) * 1000;
                        const startTime = performance.now(); // Record the start time

                        if (item.type === "Video") {
                            await setVideoZone(item, zoneId);
                        } else if (item.type === "Image") {
                            await setImageZone(item, zoneId);
                        } else if (item.type === "Audio") {
                            await setAudioZone(item, zoneId);
                        } else if (item.type === "Link") {
                            await setLinkZone(item, zoneId);
                        } else if (item.type === "App") {
                            await setAppZone(item, zoneId);
                        }else if (item.type === "Banner") {
                            await setBannerZone(item, zoneId);
                        }

                        openFullscreen();

                        $("#layout").removeAttr("hidden");
                        $("#fullscreen").removeAttr("hidden");

                        const elapsedTime = performance.now() - startTime; // Measure elapsed time
                        const remainingTime = expectedDuration - elapsedTime;

                        // Ensure we wait only for the remaining time
                        if (remainingTime > 0) {
                            await new Promise(resolve => setTimeout(resolve, remainingTime));
                        }
                    }
                }
            }


            async function processMultiZoneContent(response) {
                if (response) {
                    const {
                        custom_main,
                        custom_banner,
                        custom_clock,
                        custom_weather
                    } = response.data.contents;

                    // Create zones dynamically
                    const zonesHTML = `
                        <div id="multiZone1" class="zone"></div>
                        <div id="multiZone2" class="zone"></div>
                        <div id="multiZone3" class="zone"></div>
                        <div id="multiZone4" class="zone"></div>
                    `;
                    $("#backgroundData").html(zonesHTML);

                    // Apply styles to zones
                    $(".zone").css({
                        position: "absolute",
                        width: "100%",
                        height: "100%",
                        "object-fit": "contain",
                    });

                    // Define positions for the 4 zones
                    $("#multiZone1").css({
                        top: 0,
                        left: 0,
                        width: "80%",
                        height: "80vh"
                    });
                    $("#multiZone2").css({
                        top: 0,
                        right: 0,
                        width: "20%",
                        height: "80vh"
                    });
                    $("#multiZone3").css({
                        bottom: 0,
                        left: 0,
                        width: "80%",
                        height: "20vh"
                    });
                    $("#multiZone4").css({
                        bottom: 0,
                        right: 0,
                        width: "20%",
                        height: "20vh"
                    });

                    // Use Promise.all to play all zones simultaneously
                    const zonePromises = [];

                    if (custom_main && custom_main.length > 0) {
                        zonePromises.push(playZoneContent(custom_main, "#multiZone1"));
                    }

                    if (custom_weather && custom_weather.length > 0) {
                        zonePromises.push(playZoneContent(custom_weather, "#multiZone2"));
                    }

                    if (custom_banner && custom_banner.length > 0) {
                        zonePromises.push(playZoneContent(custom_banner, "#multiZone3"));
                    }

                    if (custom_clock && custom_clock.length > 0) {
                        zonePromises.push(playZoneContent(custom_clock, "#multiZone4"));
                    }

                    // Wait for all zones to complete their playback (though they'll loop indefinitely)
                    await Promise.all(zonePromises);
                } else {
                    alertify.set("notifier", "position", "top-right");
                    alertify.warning("No content available for multi-zone display.");
                    $("#data").empty();
                }
            }






            async function processBackgroundDetails(details) {
                if (details) {
                    let i = 0;
                    let j = 0;
                    while (i < details.length) {
                        setBackground(details[i]);
                        delay = parseInt(details[i].duration) * 1000;

                        if (i == 0 && j == 0) {
                            j++;
                            openFullscreen();
                        }
                        $("#layout").removeAttr('hidden');
                        $("#fullscreen").removeAttr('hidden');
                        await new Promise(resolve => setTimeout(resolve, delay));

                        i++;
                        if (i == details.length) {
                            i = 0;
                        }
                    }
                    if (details.length == 0) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.warning('Template has no content');
                        $('#backgroundContentData').remove();
                    }
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.warning('Background has no content');
                    $('#backgroundContentData').remove();
                }
            }

            $(document).on("click", "#btn", function(e) {
                e.preventDefault();

                var obj = $('#data');
                var backgroundObj = $('#backgroundContentData');
                var audioObj = $('#audioData');
                if (obj) {
                    $('#data').remove();
                }
                if (backgroundObj) {
                    $('#backgroundContentData').remove();
                }
                if (audioObj) {
                    $('#audioData').remove();
                }

                let device_id = $('#device_id').val();
                $.ajax({
                    type: "get",
                    url: "/api/search-device-info/" + device_id,
                    success: function(response) {
                        console.log(response)
                        if (response.status_code == 200) {
                            $("#backgroundData").css("position", 'relative');
                            $("#backgroundData").css("overflow", 'hidden');
                            $("#backgroundData").css("height", '100vh');
                            if (response.data.template_details) {
                                if (response.data.template_details.mute == 'false') {
                                    processAudios(response.data.contents.background_audio)
                                }
                                if (response.data.contents.background) {
                                    background = 1;
                                    processBackgroundDetails(response.data.contents.background)
                                }
                                if (response.data.contents.custom_main) {
                                    processMultiZoneContent(response);

                                }
                                if (response.data.contents.main_zone) {
                                    processPlaylistDetails(response.data.contents.main_zone);

                                }
                            } else {
                                processPlaylistDetails(response.data.contents.main_zone);

                            }
                            $("#device_id").prop('disabled', true);
                            $("#device_id").css("background-color", 'transparent');



                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.warning('Status Code 200 not returned');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.warning(JSON.parse(jqXHR.responseText).unsuccessful);
                    }
                });
            });

            var elem = document.getElementById("layout");

            function openFullscreen() {
                if (!document.fullscreenElement) {
                    if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                    } else if (elem.webkitRequestFullscreen) {
                        elem.webkitRequestFullscreen();
                    } else if (elem.msRequestFullscreen) {
                        elem.msRequestFullscreen();
                    } else if (elem.mozRequestFullScreen) {
                        elem.mozRequestFullScreen();
                    }
                }
            }

            function closeFullscreen() {
                if (document.fullscreenElement) {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    }
                }
            }
            $(document).on("click", "#refreshBtn", function(e) {
                e.preventDefault();
                location.reload(true)
            });
        </script>

        <script>

            document.addEventListener('DOMContentLoaded', () => {
                const parent = document.getElementById('parent-container');
                const iframe = document.getElementById('dynamic-iframe');
                const originalWidth = 800; // Original width of the iframe content
                const originalHeight = 600; // Original height of the iframe content

                function adjustIframeScale() {
                    const parentWidth = parent.offsetWidth;
                    const scale = parentWidth / originalWidth;

                    // Scale the iframe content
                    iframe.style.transform = `scale(${scale})`;
                    iframe.style.width = `${originalWidth}px`;
                    iframe.style.height = `${originalHeight}px`;

                    // Adjust the iframe's wrapper height to match the scaled height
                    parent.style.height = `${originalHeight * scale}px`;
                }

                // Adjust scaling on load and window resize
                adjustIframeScale();
                window.addEventListener('resize', adjustIframeScale);
            });


            
            function startWeatherWidget() {
    const apiKey = 'c67d396cb70ac519f249830e6b025d4e';
    const apiUrl = 'https://api.openweathermap.org/data/2.5/weather';
    const location = "Dhaka";

    const url = `${apiUrl}?q=${location}&appid=${apiKey}&units=metric`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            document.getElementById('location').textContent = `${data.name}, ${data.sys.country}`;
            document.getElementById('temperature').textContent = `${Math.round(data.main.temp)}°C`;
            document.getElementById('description').textContent = data.weather[0].description;
            document.getElementById('humidity').textContent = `Humidity: ${data.main.humidity}%`;
            document.getElementById('wind-speed').textContent = `Wind: ${data.wind.speed} m/s`;
            document.getElementById('visibility').textContent = `Visibility: ${data.visibility / 1000} km`;
            document.getElementById('cloud-cover').textContent = `Cloud Cover: ${data.clouds.all}%`;
            document.getElementById('sunrise').textContent = `Sunrise: ${formatTime(data.sys.sunrise, data.timezone)}`;
            document.getElementById('sunset').textContent = `Sunset: ${formatTime(data.sys.sunset, data.timezone)}`;
        })
        .catch(error => console.error('Error fetching weather data:', error));

    function formatTime(unixTime, timezone) {
        const date = new Date((unixTime + timezone) * 1000);
        return date.toISOString().substr(11, 5);
    }

    // Adjust widget size on load and resize
    function adjustWidgetDetails() {
        const widget = document.querySelector('.weather-widget');
        const additionalInfo = document.querySelector('.additional-info');

        if (widget.offsetWidth < 300 || widget.offsetHeight < 300) {
            additionalInfo.style.display = 'none';
        } else {
            additionalInfo.style.display = 'flex';
        }
    }

    function adjustWidgetSize() {
        const widget = document.querySelector('.weather-widget');
        const parent = widget.parentElement;

        widget.style.maxWidth = `${parent.offsetWidth}px`;
        widget.style.maxHeight = `${parent.offsetHeight}px`;
    }

    // Adjustments on window resize
    window.addEventListener('resize', () => {
        adjustWidgetDetails();
        adjustWidgetSize();
    });

    adjustWidgetDetails();
    adjustWidgetSize();
}

        </script>
    @endpush
</x-layout>
