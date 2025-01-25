<x-layout titlePage="User Management" bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management" index=''></x-navbars.navs.auth>
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
                            <a class="btn bg-gradient-dark mb-0" id="add" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" href="javascript:;">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add User
                            </a>
                        </div>

                        <div class="card-body px-0 pb-0">
                            @if (session("status"))
                                <div class="alert alert-success alert-dismissible fade show" role="alert"
                                    id="successMessage"
                                    style="position: absolute; top: 10px; right: 20px; z-index: 1050;">
                                    {{ session("status") }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                    id="errorMessage"
                                    style="position: absolute; top: 10px; right: 20px; z-index: 1050;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>

                        <div class="card-body" style="min-height: 60vh;">
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
                                                Address
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                About
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"> <!-- Change to modal-lg for a larger modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form method='POST' id='userForm' action='{{ route("edit.user") }}'>
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6" hidden>
                                    <label class="form-label">ID</label>
                                    <input type="text" name="id" id="id"
                                        class="form-control border border-2 p-2">
                                    <div class="text-danger error-message" id="error-id"></div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address <span class="text-danger">*</span></label>
                                    <!-- Red star -->
                                    <input type="email" name="email" id="email"
                                        class="form-control border border-2 p-2" placeholder="Enter email" disabled>
                                    <div class="text-danger error-message" id="error-email"></div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control border border-2 p-2" placeholder="Enter name">
                                    <div class="text-danger error-message" id="error-name"></div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control border border-2 p-2" placeholder="Enter phone number">
                                    <div class="text-danger error-message" id="error-phone"></div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" name="location" id="location"
                                        class="form-control border border-2 p-2" placeholder="Enter location">
                                    <div class="text-danger error-message" id="error-location"></div>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">About</label>
                                    <textarea class="form-control border border-2 p-2" placeholder="Say something about yourself" id="floatingTextarea2"
                                        name="about" rows="4" cols="50"></textarea>
                                    <div class="text-danger error-message" id="error-about"></div>
                                </div>

                                <div class="mb-3 col-md-6 passwordDiv" hidden>
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="text" name="password" id="password"
                                        class="form-control border border-2 p-2" placeholder="Enter password">
                                    <div class="text-danger error-message" id="error-password"></div>
                                </div>

                                <div class="mb-3 col-md-6 passwordDiv" hidden>
                                    <label class="form-label">Re-Enter Password <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="re_enter_password" id="re_enter_password"
                                        class="form-control border border-2 p-2" placeholder="Re-enter password">
                                    <div class="text-danger error-message" id="error-re_enter_password"></div>
                                </div>

                                <div class="mb-3 col-md-6 roleDiv" hidden>
                                    <label for="roles" class="form-label">Assign Role <span
                                            class="text-danger">*</span></label>
                                    <select name="roles" id="roles" class="form-select p-2"
                                        title="Select role" data-width="75%">
                                        <option value="" disabled selected>Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger error-message" id="error-roles"></div>
                                </div>
                            </div>
                            <div class="close">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitButton">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <x-plugins></x-plugins>
    @push("js")
        <script>
            $(document).ready(function() {
                // Show the success message if it exists
                @if (session("status"))
                    $('#successMessage').fadeIn().delay(2000).fadeOut();
                @endif

                // Show the error message if it exists
                @if ($errors->any())
                    $('#errorMessage').fadeIn().delay(2000).fadeOut();
                @endif

                $.ajax({
                    type: "get",
                    url: "/users",
                    success: function(response) {
                        let id = 1;
                        response.users.forEach(user => {
                            $("#userTable tbody").append(`
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="mb-0 text-sm">` + id + `</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">` + user.name + `</h6>

                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center align-middle text-center">
                                        <h6 class="mb-0 text-sm">` + user.phone + `</h6>

                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs text-secondary mb-0">` + user.email + `</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">` + user.location + `</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">` + user.about + `</span>
                                </td>
                                <td class="align-middle align-middle text-center">
                                    <button type="button" class="btn btn-success btn-link" id="edit" data-value="` +
                                user.id + `" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-link" id="delete" value="` + user
                                .id + `" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

            function showMessage(message) {
                $('#successMessage').remove(); // Remove any existing success message
                $('body').append(`
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMessage" style="position: absolute; top: 10px; right: 20px; z-index: 1050;">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);

                // Remove the success message after 2 seconds
                setTimeout(function() {
                    $('#successMessage').alert('close');
                }, 2000);
            }

            // Submit form for adding a user
            $(document).on("submit", "#userForm[data-action='add']", function(e) {
                e.preventDefault(); // Prevent default form submission

                const formAction = $(this).attr('action');
                const formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    type: "POST",
                    url: formAction,
                    data: formData,
                    success: function(response) {
                        $('.text-danger').html(''); // Clear previous error messages
                        $('#exampleModal').modal('hide'); // Close the modal
                        showMessage("Added successfully."); // Show the success message
                        location.reload(); // Reload the page
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.error-message').remove(); // Clear previous error messages
                            $.each(xhr.responseJSON.errors, function(key, messages) {
                                const inputField = $(`#${key}`);
                                inputField.addClass(
                                    'is-invalid'); // Add invalid class for Bootstrap
                                inputField.after(
                                    `<div class="error-message text-danger">${messages.join(', ')}</div>`
                                );
                            });
                        }
                    }
                });
            });

            // Handle form submission for editing a user
            $(document).on("submit", "#userForm[data-action='edit']", function(e) {
                e.preventDefault(); // Prevent default form submission

                const formAction = $(this).attr('action');
                const formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    type: "POST",
                    url: formAction,
                    data: formData,
                    success: function(response) {
                        $('.text-danger').html(''); // Clear previous error messages
                        $('#exampleModal').modal('hide'); // Close the modal
                        showMessage("Updated successfully."); // Show the success message
                        location.reload(); // Reload the page
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.error-message').remove(); // Clear previous error messages
                            $.each(xhr.responseJSON.errors, function(key, messages) {
                                const inputField = $(`#${key}`);
                                inputField.addClass(
                                    'is-invalid'); // Add invalid class for Bootstrap
                                inputField.after(
                                    `<div class="error-message text-danger">${messages.join(', ')}</div>`
                                );
                            });
                        }
                    }
                });
            });

            // Show add modal
            $(document).on("click", "#add", function(e) {
                $('#userForm')[0].reset();
                $('#exampleModalLongTitle').text("Add User");
                $('#submitButton').text("Add");
                $('#userForm').attr('action', "{{ route("add.user") }}");
                $('#userForm').attr('data-action', 'add');
                $("#email, #name, #phone, #location, #floatingTextarea2, #roles").removeAttr('disabled');
                $(".passwordDiv, .roleDiv").removeAttr('hidden');
                $('.error-message').remove(); // Clear previous error messages
            });
            // Handle modal close to remove previous error messages
            $('#exampleModal').on('hidden.bs.modal', function() {
                $('.error-message').remove(); // Clear previous error messages
                $('#userForm')[0].reset(); // Optionally reset the form
            });

            // Handle edit modal setup
            $(document).on("click", "#edit", function(e) {
                $('#exampleModalLongTitle').text("Edit User");
                $('#submitButton').text("Update");
                $('#userForm').attr('action', "{{ route("edit.user") }}");
                $('#userForm').attr('data-action', 'edit'); // Set action to edit
                $("#email").attr('disabled', true);
                $("#name, #phone, #location, #floatingTextarea2, #roles").removeAttr('disabled');
                $(".passwordDiv").attr("hidden", true);
                $(".roleDiv").removeAttr("hidden");

                let id = $(this).data("value");

                $.ajax({
                    type: "get",
                    url: "/user/" + id,
                    success: function(response) {
                        $('#id').val(response.user.id);
                        $('#name').val(response.user.name);
                        $('#email').val(response.user.email);
                        $('#phone').val(response.user.phone);
                        $('#location').val(response.user.location);
                        $('#floatingTextarea2').val(response.user.about);

                        // Set the selected role
                        if (response.user.roles.length > 0) {
                            var roleName = response.user.roles[0].name; // Assuming a single role
                            $('#roles').val(roleName);
                        } else {
                            $('#roles').val(''); // Reset if no role assigned
                        }
                    }
                });
            });

            // Handle delete modal setup
            $(document).on("click", "#delete", function(e) {
                $('#exampleModalLongTitle').text("Delete User");
                $('#submitButton').text("Delete");
                $('#userForm').attr('action', "{{ route("delete.user") }}");
                $("#email, #name, #phone, #location, #floatingTextarea2, #roles").attr('disabled', true);
                $(".passwordDiv").attr("hidden", true);
                $(".roleDiv").removeAttr("hidden");

                let id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "/user/" + id,
                    success: function(response) {
                        $('#id').val(response.user.id);
                        $('#name').val(response.user.name);
                        $('#email').val(response.user.email);
                        $('#phone').val(response.user.phone);
                        $('#location').val(response.user.location);
                        $('#floatingTextarea2').val(response.user.about);

                        // Set the selected role
                        if (response.user.roles.length > 0) {
                            var roleName = response.user.roles[0].name; // Assuming a single role
                            $('#roles').val(roleName);
                        } else {
                            $('#roles').val(''); // Reset if no role assigned
                        }
                    }
                });
            });
        </script>
    @endpush
</x-layout>
