<style>
.preview-container {
    position: relative;
}

.hover-preview {
    position: absolute;
    top: -60px; /* Adjust to position above or below the element */
    left: 50%; 
    transform: translateX(-50%);
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 5px;
    display: none;
    z-index: 10;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.preview-container:hover .hover-preview {
    display: block;
}

</style>
<x-layout titlePage="Playlists" bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar bar activePage='image.playlist.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Playlists" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong>Playlists</strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="me-3 my-3 text-end">
                                <a class="btn bg-gradient-warning mb-0" href="{{ route('image.playlist.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Playlist
                                </a>
                                <div class="card-body px-0 pb-2">
                                @if (!is_null($playlists) && $playlists->count() > 0)
                                        <div class="row">
                                            @php
                                                $colors = ['#FFD700', '#FF4500', '#1E90FF', '#32CD32']; // Example color palette
                                            @endphp
                                            @foreach ($playlists as $index => $playlist)
                                                <div class="col-12">
                                                    <a
                                                        href="{{ route('image.playlist.contentlist', $playlist->playlist_name) }}">

                                                        <div class="playlist-card"
                                                            style="
                                                         display: flex; 
                                                         align-items: center; 
                                                         border: 1px solid #ddd; 
                                                         border-radius: 8px; 
                                                         margin-bottom: 10px; 
                                                         padding: 10px; 
                                                         height: 60px;">

                                                            <!-- Logo and Playlist Name (First Column) -->
                                                            <div style="display: flex; align-items: center; flex: 1;">
                                                                <!-- Logo -->
                                                                <div
                                                                    style="
                                                             width: 40px; 
                                                             height: 40px; 
                                                             border-radius: 10%; 
                                                             background-color: {{ $colors[$index % count($colors)] }}; 
                                                             display: flex; 
                                                             align-items: center; 
                                                             justify-content: center; 
                                                             color: #fff; 
                                                             font-weight: bold; 
                                                             margin-right: 10px;">
                                                                    <i class="fa fa-list" style="font-size: 18px;"></i>
                                                                </div>
                                                                <!-- Playlist Name -->
                                                                <div
                                                                    style="font-weight: bold; font-size: 16px; color: #333;">
                                                                    {{ $playlist->playlist_name }}
                                                                </div>
                                                            </div>

                                                            <!-- Stacked Content (Second Column) -->
                                                            <div class="stacked-container"
                                                                style="
                                                                    flex: 3; 
                                                                    display: flex; 
                                                                    align-items: center; 
                                                                    position: relative; 
                                                                    height: 60px; 
                                                                    overflow: hidden;
                                                                    justify-content: left;">
                                                                @php
                                                                    $contents = explode(',', $playlist->contents);
                                                                    $contentTypes = explode(
                                                                        ',',
                                                                        $playlist->content_types,
                                                                    );
                                                                @endphp

                                                                @foreach ($contents as $index2 => $content)
                                                                    @if ($contentTypes[$index2] == 'Image')
                                                                        <div class="preview-container"
                                                                            style="position: relative;">
                                                                            <img src="{{ asset('contents/images/' . $content) }}"
                                                                                alt="{{ $content }}"
                                                                                class="stacked-item"
                                                                                style="  width: 50px; 
                                                                                height: 50px; 
                                                                                border-radius: 8px; 
                                                                                margin-left: {{ $index2 == 0 ? 0 : -10 }}px; 
                                                                                border: 1px solid #ccc;">
                                                                            <div class="hover-preview">
                                                                                <img src="{{ asset('contents/images/' . $content) }}"
                                                                                    alt="{{ $content }}"
                                                                                    style="
                                                                                    width: 150px; 
                                                                                    height: auto; 
                                                                                    border-radius: 8px;">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($contentTypes[$index2] == 'Video')
                                                                        <div class="preview-container"
                                                                            style="position: relative;">
                                                                            <video
                                                                                src="{{ asset('contents/videos/' . $content) }}"
                                                                                class="stacked-item"
                                                                                style="
                                                                                    width: 50px; 
                                                                                    height: 50px; 
                                                                                    border-radius: 8px; 
                                                                                    margin-left: {{ $index2 == 0 ? 0 : -10 }}px; 
                                                                                    border: 1px solid #ccc; 
                                                                                    pointer-events: none;"
                                                                                muted>
                                                                            </video>
                                                                            <div class="hover-preview">
                                                                                <video
                                                                                    src="{{ asset('contents/videos/' . $content) }}"
                                                                                    style="
                                                                                        width: 150px; 
                                                                                        height: auto; 
                                                                                        border-radius: 8px;"
                                                                                    autoplay muted loop>
                                                                                </video>
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($contentTypes[$index2] == 'Link')
                                                                        <div class="preview-container"
                                                                            style="position: relative;">
                                                                            <iframe src="{{ $content }}"
                                                                                class="stacked-item"
                                                                                style="
                                                                                    width: 50px; 
                                                                                    height: 50px; 
                                                                                    border-radius: 8px; 
                                                                                    margin-left: {{ $index2 == 0 ? 0 : -10 }}px; 
                                                                                    pointer-events: none; 
                                                                                    border: 1px solid #ccc;">
                                                                            </iframe>
                                                                            <div class="hover-preview">
                                                                                <iframe src="{{ $content }}"
                                                                                    style="
                                                                                        width: 200px; 
                                                                                        height: 150px; 
                                                                                        border-radius: 8px; 
                                                                                        pointer-events: none;">
                                                                                </iframe>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <div class="alert alert-info text-center" role="alert">
                                            <strong> Sorry! </strong> No Playlists found.
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
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    @endpush
</x-layout>
