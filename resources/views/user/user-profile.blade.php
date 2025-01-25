<x-layout titlePage="User Profile" bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Profile' index=''></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="page-header min-height-300 border-radius-xl"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6 mt-4 my-4" style="min-height: 50vh;">
                <div class="row gx-4 mb-2" style="margin-left: 5px;margin-top: 10px;">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ auth()->user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="text-end">
                            <a class="btn bg-gradient-warning mb-0" href="{{ route("user-profile.edit") }}">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control border border-2 p-2"
                                    value='{{ old("phone", auth()->user()->phone) }}' disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-control border border-2 p-2"
                                    value='{{ old("location", auth()->user()->location) }}' disabled>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="floatingTextarea2">About</label>
                                <textarea class="form-control border border-2 p-2" placeholder=" Say something about yourself" id="floatingTextarea2"
                                    name="about" rows="9" disabled>{{ old("about", auth()->user()->about) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
