<x-layout titlePage="Template" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='template.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Template" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> All Template </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a href="{{ route('template.fullscreen.view') }}" style="text-decoration: none">
                                                <div class="card">
                                                    <div class="row card-body">
                                                        <img class="col-sm-12 p-0" height="115px" src="{{ asset('assets/img/home-decor-1.jpg') }}" alt="sans"/>
                                                    </div>
                                                </div>
                                            </a>
                                            <h5 class="text-center mt-1">Full Screen</h5>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{ route('template.screenwise', ['false', 'true', 'true', 'false']) }}" style="text-decoration: none">
                                                <div class="card">
                                                    <div class="row card-body">
                                                        <div class="col-sm-4 border border-dark">
                                                            <p class="card-text text-center text-info mt-4"><i class="material-icons">burst_mode</i></p>
                                                        </div>
                                                        <img class="col-sm-8 p-0" height="86px" src="{{ asset('assets/img/home-decor-1.jpg') }}" alt="sans"/>
                                                        <div class="col-sm-12 border border-dark">
                                                            <p class="card-text text-center text-info"><i class="material-icons">burst_mode</i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <h5 class="text-center mt-1">Screen with Left Sidebar & Footer</h5>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{ route('template.screenwise', ['false', 'true', 'false', 'true']) }}" style="text-decoration: none">
                                                <div class="card">
                                                    <div class="row card-body">
                                                        <img class="col-sm-8 p-0" height="86px" src="{{ asset('assets/img/home-decor-1.jpg') }}" alt="sans"/>
                                                        <div class="col-sm-4 border border-dark">
                                                            <p class="card-text text-center text-info mt-4"><i class="material-icons">burst_mode</i></p>
                                                        </div>
                                                        <div class="col-sm-12 border border-dark">
                                                            <p class="card-text text-center text-info"><i class="material-icons">burst_mode</i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <h5 class="text-center mt-1">Screen with Right Sidebar & Footer</h5>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{ route('template.screenwise', ['false', 'false', 'true', 'false']) }}" style="text-decoration: none">
                                                <div class="card">
                                                    <div class="row card-body">
                                                        <div class="col-sm-4 border border-dark">
                                                            <p class="card-text text-center text-info mt-4"><i class="material-icons">burst_mode</i></p>
                                                        </div>
                                                        <img class="col-sm-8 p-0" height="115px" src="{{ asset('assets/img/home-decor-1.jpg') }}" alt="sans"/>
                                                    </div>
                                                </div>
                                            </a>
                                            <h5 class="text-center mt-1">Screen with Left Sidebar</h5>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{ route('template.screenwise', ['false', 'false', 'false', 'true']) }}" style="text-decoration: none">
                                                <div class="card">
                                                    <div class="row card-body">
                                                        <img class="col-sm-8 p-0" height="115px" src="{{ asset('assets/img/home-decor-1.jpg') }}" alt="sans"/>
                                                        <div class="col-sm-4 border border-dark">
                                                            <p class="card-text text-center text-info mt-4"><i class="material-icons">burst_mode</i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <h5 class="text-center mt-1">Screen with Right Sidebar</h5>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{ route('template.screenwise', ['false', 'true', 'false', 'false']) }}" style="text-decoration: none">
                                                <div class="card">
                                                    <div class="row card-body">
                                                        <img class="col-sm-12 p-0" height="86px" src="{{ asset('assets/img/home-decor-1.jpg') }}" alt="sans"/>
                                                        <div class="col-sm-12 border border-dark">
                                                           <p class="card-text text-center text-info"><i class="material-icons">burst_mode</i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <h5 class="text-center mt-1">Screen with Footer</h5>
                                        </div>
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
    @push('js')

    @endpush
</x-layout>

