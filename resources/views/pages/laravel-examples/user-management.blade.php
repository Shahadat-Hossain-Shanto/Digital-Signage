<x-layout titlePage="User Management" bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white mx-3"><strong> User Management </h6>
                                </div>
                            </div>
                        <div class=" me-3 my-3 mb-0 text-end">
                            <a class="btn bg-gradient-dark mb-0" id="add" data-toggle="modal" data-target="#exampleModalCenter" href="javascript:;">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add User
                            </a>
                        </div>

                        @if (session('status'))
                        <div class="row m-4 mb-0">
                            <div class="alert alert-success alert-dismissible text-white mb-0" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <div class="row m-4 mb-0" id="statusDiv" hidden>
                            <div class="alert alert-success alert-dismissible text-white mb-0" role="alert">
                                <span class="text-sm" id="status"></span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="userTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NAME
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Phone
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                EMAIL
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Location
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                About
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2 w-100">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-3 pl-3 pr-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- <h6 class="text-white mx-3"><strong> User Management </h6> --}}
                                </div>
                            </div>
                    </div>

                    <div class="modal-body">
                        <form method='POST' id='userForm' action='{{ route('edit.user') }}'>
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6" hidden>
                                    <label class="form-label">ID</label>
                                    <input type="text" name="id" id="id" class="form-control border border-2 p-2">
                                    @error('id')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" id="email" class="form-control border border-2 p-2">
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control border border-2 p-2">
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control border border-2 p-2">
                                    @error('phone')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" id="location" class="form-control border border-2 p-2">
                                    @error('location')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">About</label>
                                    <textarea class="form-control border border-2 p-2"
                                        placeholder=" Say something about yourself" id="floatingTextarea2" name="about"
                                        rows="4" cols="50">
                                    </textarea>
                                        @error('about')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                </div>

                                <div class="mb-3 col-md-6 passwordDiv" hidden>
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" id="password" class="form-control border border-2 p-2">
                                    @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6 passwordDiv" hidden>
                                    <label class="form-label">Re-Enter Password</label>
                                    <input type="text" name="re_enter_password" id="re_enter_password" class="form-control border border-2 p-2">
                                    @error('re_enter_password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn bg-gradient-dark">Submit</button> --}}
                            <div class="close">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitButton">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <x-plugins></x-plugins>
    @push('js')
    <!-- the jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
         $( document ).ready(function() {
            $.ajax({
                type: "get",
                url: "/users",
                success: function (response) {
                    let id = 1;
                    response.users.forEach(user => {
                        // console.log(user)
                        $("#userTable tbody").append(`
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="mb-0 text-sm">`+id+`</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">`+user.name+`</h6>

                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center align-middle text-center">
                                        <h6 class="mb-0 text-sm">`+user.phone+`</h6>

                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs text-secondary mb-0">`+user.email+`</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">`+user.location+`</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">`+user.about+`</span>
                                </td>
                                <td class="align-middle align-middle text-center">
                                    <a rel="tooltip" class="btn btn-success btn-link"
                                        id="edit" data-value="`+user.id+`" data-original-title=""
                                        title="" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-link"
                                    id="delete" value="`+user.id+`" data-original-title="" title="">
                                    <i class="material-icons">delete</i>
                                    <div class="ripple-container"></div>
                                </button>
                                </td>
                            </tr>
                        `);
                        id++;
                    });
                }
            });
        });

        $(document).on("click", "#add", function (e) {
            $('#userForm')[0].reset();
            $('#exampleModalLongTitle').text("Add User");
            $('#submitButton').text("Add");
            $('#userForm'). attr('action', "{{ route('add.user') }}");
            $(".passwordDiv").removeAttr('hidden');
        });

        $(document).on("click", "#edit", function (e) {
            $('#exampleModalLongTitle').text("Edit User");
            $('#submitButton').text("Edit");
            $('#userForm'). attr('action', "{{ route('edit.user') }}");
            $(".passwordDiv").attr("hidden",true);
            let id = $(this).data("value");
            $.ajax({
                type: "get",
                url: "/user/"+id,
                success: function (response) {
                    // console.log(response.user)
                    $('#id').val(response.user.id);
                    $('#name').val(response.user.name);
                    $('#email').val(response.user.email);
                    $('#phone').val(response.user.phone);
                    $('#location').val(response.user.location);
                    $('#floatingTextarea2').val(response.user.about);
                }
            });
        });

        $(document).on("click", "#delete", function (e) {
            let id = $(this).val();

            $.ajax({
                type: "post",
                url: "/delete-user",
                data:{id:id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // console.log(response)
                    if(response.status==200){
                        $("#statusDiv").removeAttr('hidden');
                        $('#status').text(response.message);
                    }
                     $(location).attr('href','/user-management');
                }
            });
        });
    </script>
    @endpush
</x-layout>
