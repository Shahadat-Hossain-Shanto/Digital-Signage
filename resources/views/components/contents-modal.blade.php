<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Select Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"style="filter: invert(1);"></button>
            </div>
            <div class="modal-body p-0" style="min-height: 67vh;">
                <div class="row">
                    <!-- Vertical Tabs Navigation -->
                    <div class="col-md-3 p-0 "style="min-height: 67vh;background-color: #ccc8c8;">
                        <div class="nav flex-column nav-pills" style="background-color: #ccc8c8;" id="mediaTab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="template-tab" data-bs-toggle="pill"
                                data-bs-target="#template" type="button" role="tab" aria-controls="template"
                                aria-selected="true">Templates</button>
                            <button class="nav-link " id="playlists-tab" data-bs-toggle="pill"
                                data-bs-target="#playlists" type="button" role="tab" aria-controls="playlists"
                                aria-selected="true">Playlists</button>
                            <button class="nav-link" id="images-tab" data-bs-toggle="pill"
                                data-bs-target="#images" type="button" role="tab" aria-controls="images"
                                aria-selected="true">Images</button>
                            <button class="nav-link" id="videos-tab" data-bs-toggle="pill"
                                data-bs-target="#videos" type="button" role="tab" aria-controls="videos"
                                aria-selected="false">Videos</button>
                            <button class="nav-link" id="links-tab" data-bs-toggle="pill"
                                data-bs-target="#links" type="button" role="tab" aria-controls="links"
                                aria-selected="false">Links</button>
                            <button class="nav-link" id="apps-tab" data-bs-toggle="pill" data-bs-target="#apps" type="button" role="tab" aria-controls="apps" aria-selected="false">Apps</button>

                        </div>
                    </div>
                    <!-- Tab Content Area -->
                    <div class="col-md-9 ">
                        <div class="tab-content ms-3" id="mediaTabContent">
                            <!-- Images Tab Pane -->
                            <div class="tab-pane fade show active" id="template" role="tabpanel" aria-labelledby="template-tab">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            @foreach ($templateContents as $template)
                                                <tr>
                                                    <td>
                                                        @if ($template['content']['content_type'] == 'Image')
                                                            <img src="{{ asset('contents/images/' . ($template['content']['content_name'] ?? $template['content']['content'])) }}"
                                                                alt="{{ $template['content']['content_name'] ?? $template['content']['content'] }}"
                                                                class="img-fluid rounded"
                                                                style="width: 50px; height: 50px; object-fit: cover;">
                                                        @elseif ($template['content']['content_type'] == 'Video')
                                                            <video src="{{ asset('contents/videos/' . ($template['content']['content_name'] ?? $template['content']['content'])) }}"
                                                                class="img-fluid rounded"
                                                                style="width: 50px; height: 50px; object-fit: cover;" muted loop>
                                                            </video>
                                                        @elseif ($template['content']['content_type'] == 'Link')
                                                            @php
                                                                $content = $template['content']['content_name'];
                                                                $youtubeId = null;
                                                                if (
                                                                    preg_match(
                                                                        '/(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                                                                        $content,
                                                                        $matches,
                                                                    )
                                                                ) {
                                                                    $youtubeId = $matches[1];
                                                                }
                                                            @endphp
                                    
                                                            @if ($youtubeId)
                                                                <iframe width="50" height="50"
                                                                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                    frameborder="0"
                                                                    allow="autoplay; encrypted-media; picture-in-picture"
                                                                    allowfullscreen></iframe>
                                                            @elseif (filter_var($content, FILTER_VALIDATE_URL))
                                                                <a href="{{ $content }}" target="_blank" style="color: #007bff; font-weight: bold;">
                                                                    Open Link
                                                                </a>
                                                            @else
                                                                <span style="color: red; font-weight: bold;">Invalid Link</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td style="vertical-align: middle;">{{ $template['template_name'] }}</td>
                                                    <td style="display: none;">{{ $template['id'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    
                                </div>
                            </div>

                            <div class="tab-pane fade" id="playlists" role="tabpanel"
                                aria-labelledby="playlists-tab">
                                <table class="table ">
                                    <tbody style=" vertical-align: middle;">
                                        @foreach ($playlists as $playlist)
                                            <tr>
                                                <td>
                                                    <div class="stacked-card" style="position: relative; width: 80px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center;">
                                                            @php
                                                                $contents = explode(',', $playlist->contents);
                                                                $contentTypes = explode(
                                                                    ',',
                                                                    $playlist->content_types,
                                                                );
                                                            @endphp
                                                            @foreach ($contents as $index => $content)
                                                                @if ($contentTypes[$index] == 'Image')
                                                                    <img src="{{ asset('contents/images/' . $content) }}"
                                                                        alt="{{ $content }}"
                                                                        class="stacked-image"
                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;">
                                                                @elseif ($contentTypes[$index] == 'Video')
                                                                    <video
                                                                        src="{{ asset('contents/videos/' . $content) }}"
                                                                        alt="Video Thumbnail"
                                                                        class="stacked-image"
                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc;" muted>
                                                                @elseif ($contentTypes[$index] == 'Link')
                                                                <div class="preview-container" style="position: relative;">
                                                                    <iframe src="{{$content}}" class="stacked-item" 
                                                                        style="width: 50px; height: 50px; border-radius: 8px; margin-left: {{ $index == 0 ? 0 : -10 }}px; border: 1px solid #ccc; pointer-events: none;">
                                                                    </iframe>
                                                                    
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                    </div>
                                                </td>
                                                <td>{{ $playlist->playlist_name }}</td>
                                                <td>
                                                    @if ($playlist->mute == 'true')
                                                        Mute
                                                    @else
                                                        Unmute
                                                    @endif
                                                </td>
                                                <td>{{ $playlist->total_duration }} Seconds</td>
                                                <td class="d-none">{{ $playlist }}</td>
                                                <td class="d-none">{{ $playlist->id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel"
                                aria-labelledby="images-tab">
                                <table class="table ">
                                    <tbody style=" vertical-align: middle;">
                                        @foreach ($imageLists as $imageList)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset("contents/images/{$imageList->content}") }}"
                                                        class="img-thumbnail" alt="Image" width="50">
                                                </td>
                                                <td>{{ $imageList->content }}</td>
                                                <td class='d-none'> {{ $imageList->id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="videos" role="tabpanel"
                                aria-labelledby="videos-tab">
                                <table class="table ">
                                    <tbody style=" vertical-align: middle;">
                                        @if (!is_null($videoLists))
                                            @foreach ($videoLists as $videoList)
                                                <tr>
                                                    <td>
                                                        <video width="50" height="50" controls>
                                                            <source
                                                                src="{{ asset('contents/videos/' . $videoList->content) }}"
                                                                type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <td>{{ $videoList->content }}</td>
                                                    <td class='d-none'>{{ $videoList->id }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">No videos found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="links" role="tabpanel"
                                aria-labelledby="links-tab">
                                <table class="table ">
                                    <tbody style=" vertical-align: middle;">
                                        @if (!is_null($linkLists))
                                            @foreach ($linkLists as $linkList)
                                                <tr>
                                                    <td>
                                                        <div class="link-wrapper">
                                                            @php
                                                                $content = $linkList->content;
                                                                $videoExtensions = ['.mp4', '.webm', '.ogg'];
                                                                $audioExtensions = ['.mp3', '.ogg', '.wav'];
                                                                $fileExtension = strtolower(
                                                                    pathinfo($content, PATHINFO_EXTENSION),
                                                                );

                                                                $youtubeId = null;
                                                                if (
                                                                    preg_match(
                                                                        '/(?:youtube\.com\/(?:watch\?v=|v\/|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                                                                        $content,
                                                                        $matches,
                                                                    )
                                                                ) {
                                                                    $youtubeId = $matches[1];
                                                                }
                                                            @endphp

                                                            @if ($youtubeId)
                                                                <iframe width="50" height="50"
                                                                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                                                    frameborder="0"
                                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                                    allowfullscreen></iframe>
                                                            @elseif (in_array($fileExtension, $videoExtensions))
                                                                <video width="350" height="75" controls>
                                                                    <source src="{{ asset($content) }}"
                                                                        type="video/{{ $fileExtension }}">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @elseif (in_array($fileExtension, $audioExtensions))
                                                                {{-- HTML5 Audio --}}
                                                                <audio controls>
                                                                    <source src="{{ asset($content) }}"
                                                                        type="audio/{{ $fileExtension }}">
                                                                    Your browser does not support the audio tag.
                                                                </audio>
                                                            @elseif (filter_var($content, FILTER_VALIDATE_URL))
                                                                {{-- Attempt to Embed as Iframe or Open in New Tab if Blocked --}}
                                                                <div class="iframe-container"
                                                                    style="position: relative; width: 350px; height: 75px;">
                                                                    <iframe id="iframe-{{ $linkList->id }}"
                                                                        width="50px" height="50px"
                                                                        src="{{ $content }}" frameborder="0"
                                                                        style="border: none;" allowfullscreen
                                                                        onerror="handleIframeError(this, '{{ $content }}')">
                                                                    </iframe>
                                                                    <button class="fullscreen-btn"
                                                                        onclick="toggleFullscreen('iframe-{{ $linkList->id }}')"
                                                                        style="position: absolute; bottom: 15px; right: 15px; background: rgba(0, 0, 0, 0.6); border: none; padding: 5px; border-radius: 50%;">
                                                                        <i class="material-icons text-white"
                                                                            style="font-size: 20px;">fullscreen</i>
                                                                    </button>
                                                                </div>
                                                            @else
                                                                {{-- Default Link --}}
                                                                <a href="{{ asset($content) }}" target="_blank">
                                                                    <button class="btn btn-link">View
                                                                        Link</button>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $linkList->content }}" target="_blank">
                                                            <button
                                                                class="btn btn-link">{{ $linkList->content }}</button>
                                                        </a>
                                                    </td>
                                                    <td class='d-none'>{{ $linkList->id }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">No links found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="apps" role="tabpanel"
                                    aria-labelledby="apps-tab">
                                    <table class="table ">
                                        <tbody style="text-align: center; vertical-align: middle;">

                                            @foreach ($apps as $app)
                                                <tr>
                                                    <td class="d-none">{{ $app->id }}</td>
                                                    <td>
                                                        {{-- Extract and format the endpoint --}}
                                                        @php
                                                            $url = parse_url($app->content, PHP_URL_PATH); // Get the path from the URL
                                                            $endpoint = basename($url); // Extract the endpoint (e.g., 'digital-clock-1')
                                                            $formattedName = ucwords(
                                                                str_replace('-', ' ', $endpoint),
                                                            ); // Replace '-' with ' ' and capitalize
                                                        @endphp

                                                        {{-- Define a content map --}}
                                                        @php
                                                            $contentMap = [
                                                                'Digital Clock 1' => asset(
                                                                    'contents/clock/digital-clock-1.png',
                                                                ),
                                                                'Digital Clock 2' => asset(
                                                                    'contents/clock/digital-clock-2.png',
                                                                ),
                                                                'Digital Clock 3' => asset(
                                                                    'contents/clock/digital-clock-3.png',
                                                                ),
                                                                'Weather' => asset('contents/clock/weather.jpg'),
                                                            ];
                                                        @endphp

                                                        {{-- Check if formattedName exists in the contentMap --}}
                                                        @if (array_key_exists($formattedName, $contentMap))
                                                            <img src="{{ $contentMap[$formattedName] }}"
                                                                class="img-thumbnail" alt="{{ $formattedName }}"
                                                                width="80" height="80">
                                                        @else
                                                            <span>No Image Available</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $formattedName }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            @foreach ($banners as $app)
                                                <tr>
                                                    <td class="d-none">{{ $app->id }}</td>
                                                    <td>
                                                        <img src="{{ asset('contents/clock/banner0.png') }}"
                                                            class="img-thumbnail" alt="Banner" width="80"
                                                            height="80">
                                                    </td>
                                                    <td>
                                                        Banner:
                                                        {{ $app->banner->first()->name ?? 'No Banner Available' }}
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    id="saveMedia">Select</button>
            </div>
        </div>
    </div>
</div>