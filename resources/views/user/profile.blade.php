<x-layout titlePage="Profile" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Profile' index=''></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="page-header min-height-300 border-radius-xl"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6 mt-4 my-4" style="min-height: 51vh;">
                <div class="row gx-4 mb-2" style="margin-left: 5px;margin-right: 5px;margin-top: 10px;">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset("assets") }}/img/logo/{{ auth()->user()->subscriber->logo }}"
                                alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{-- {{ auth()->user()->subscriber }} --}}
                                {{ auth()->user()->subscriber->org_name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                {{ auth()->user()->subscriber->email }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <h6 class="mb-0 ps-3 text-sm d-flex justify-content-end">
                                @if (auth()->user()->subscriber->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @elseif(auth()->user()->subscriber->status == 0)
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Owner Name</label>
                                <input type="text" name="ownerName" class="form-control border border-2 p-2"
                                    value='{{ old("ownerName", auth()->user()->subscriber->owner_name) }}' disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="number" name="phone" class="form-control border border-2 p-2"
                                    value='{{ old("phone", auth()->user()->subscriber->contact_number) }}' disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Organization Address</label>
                                <input type="text" name="location" class="form-control border border-2 p-2"
                                    value='{{ old("location", auth()->user()->subscriber->org_address) }}' disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">BIN Number</label>
                                <input type="text" name="binNumber" class="form-control border border-2 p-2"
                                    value='{{ old("binNumber", auth()->user()->subscriber->bin_number) }}' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="text-end" style="margin-right: 15px;">
                        <a href=""class="editIcon btn bg-gradient-warning mb-0" data-bs-toggle="modal"
                            data-bs-target="#updateModal">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <x-footers.auth></x-footers.auth>
        </div>
    </div>
    <x-plugins></x-plugins>
    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <form id="updateForm" enctype="multipart/form-data">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Edit Subscription Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 p-2">
                                <label class="form-label">Id</label>
                                <input type="text" class="form-control border border-2 p-2" name="id"
                                    id="id" value="{{ auth()->user()->subscriber->id }}" readonly>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label class="form-label">Organization Name</label>
                                <input type="text" class="form-control border border-2 p-2" name="org_name"
                                    id="org_name" value="{{ auth()->user()->subscriber->org_name }}">
                                <div class="org_name_error text-danger errors d-none"></div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label class="form-label">Organization Address</label>
                                <input type="text" class="form-control border border-2 p-2" name="org_address"
                                    id="org_address" value="{{ auth()->user()->subscriber->org_address }}">
                                <div class="org_address_error text-danger errors d-none"></div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label class="form-label">Owner Name</label>
                                <input type="text" class="form-control border border-2 p-2" name="owner_name"
                                    id="owner_name" value="{{ auth()->user()->subscriber->owner_name }}">
                                <div class="owner_name_error text-danger errors d-none"></div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label class="form-label">BIN Number</label>
                                <input type="text" class="form-control border border-2 p-2" name="bin_number"
                                    id="bin_number" value="{{ auth()->user()->subscriber->bin_number }}">
                                <div class="bin_number_error text-danger errors d-none"></div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label class="form-label">Contact Number</label>
                                <input type="text" class="form-control border border-2 p-2" name="contact_number"
                                    id="contact_number" value="{{ auth()->user()->subscriber->contact_number }}">
                                <div class="contact_number_error text-danger errors d-none"></div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label class="form-label">Email <span class="text-danger"><b>*</b> </span></label>
                                <input type="text" class="form-control border border-2 p-2" name="email"
                                    id="email" value="{{ auth()->user()->subscriber->email }}">
                                <div class="email_error text-danger errors d-none"></div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label class="form-label">Logo</label>
                                <input type="file" class="form-control border border-2 p-2" name="subLogo"
                                    id="subLogo" value="{{ auth()->user()->subscriber->logo }}">
                                <div class="subLogo_error text-danger errors d-none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update_user_btn">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push("js")
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                // Update data ajax request
                $(document).on('submit', '#updateForm', function(e) {
                    e.preventDefault();
                    let fd = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route("profile.update") }}",
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(res) {
                            if (res.status == 400) {
                                $('.errors').html('');
                                $('.errors').removeClass('d-none');
                                $('.email_error').text(res.errors.email);
                                $('.subLogo_error').text(res.errors.subLogo);
                            } else {
                                $('.errors').html('');
                                $('.errors').removeClass('d-none');
                                $('#updateForm')[0].reset();
                                $("#updateModal").modal('hide');
                                location.reload();
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.success('Updated Successfully!');
                            }
                        }
                    });

                });
            });
        </script>
    @endpush
</x-layout>
