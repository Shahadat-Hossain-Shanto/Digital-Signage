<x-layout titlePage="Change Password" bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-profile-edit-change-password"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Change Password'
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/user-profile"> User Profile </a></li><li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/user-profile-edit"> User Profile Edit </a></li>'></x-navbars.navs.auth>
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
                            <a class="btn bg-gradient-dark mb-0" href="{{ route("user-profile.edit") }}">
                                <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-0">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <h6 class="">Change Password</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pt-0">
                        @if (session("status"))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get("status") }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route("user-profile.edit.change.password") }}'>
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-12">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" name="current_password"
                                        class="form-control border border-2 p-2">
                                    @error("current_password")
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control border border-2 p-2">
                                    @error("password")
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control border border-2 p-2">
                                    @error("password_confirmation")
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
