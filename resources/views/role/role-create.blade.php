<x-layout titlePage="Create Role" bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="admin.roles.create.view"></x-navbars.sidebar>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Create Role" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/role-list"> Role List </a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12" style="min-height: 80vh;">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Create Role </h6>
                            </div>
                        </div>

                        <div class="card-body px-4 pb-2">
                            <form id="AddMenuForm" enctype="multipart/form-data" method="POST">
                                {{-- @csrf --}}
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6 pl-4">
                                                    <label for="rolename" style="font-weight:normal">Role Name</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control w-75 border border-2 px-2" id="rolename"
                                                        name="rolename" placeholder="e.g. Manager">
                                                </div>
                                            </div>
                                            <h6 class="text-danger pt-1" id="wrongrolename" style="font-size: 14px;">
                                            </h6>

                                        </div>

                                        <div class="form-check ml-1">
                                            <div class="row">
                                                <div class="col-1">
                                                    <input type="checkbox" style="width: 16px;height: 16px;"
                                                        class="form-check m-auto mt-1" id="checkPermissionAll" value="1">
                                                </div>
                                                <div class="col-11">
                                                    <label class="form-check-label" for="checkPermissionAll">All
                                                        Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                {{-- <hr> --}}
                                @php $i = 1; @endphp


                                @foreach ($permission_groups as $group)
                                    <div id="div{{ $i }}">
                                        <div class="form-group float-left pt-3 row" style="margin-left: 20px">
                                            <div class="col-1">
                                                <input type="checkbox" class="form-check m-auto mt-2"
                                                    style="border: 1px solid #ccc; padding: 5px;"
                                                    id="checkPermissionAll_group{{ $i }}"
                                                    onclick="checkCheckboxes(this.id, 'div{{ $i }}');">
                                            </div>
                                            <div class="col-11">
                                                <label class="form-check-label"
                                                    for="checkPermissionAll_group{{ $i }}"
                                                    style="font-size:17px;">
                                                    <b> {{ $group->name }}</b>
                                                </label>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                        {{-- <input type="checkbox" class="form-check"
                                        style="width: 18px; height: 21px;" id="{{ $i }}Management"
                                        value="{{ $group->name }}"
                                        onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">

                                    <h4> {{$group->name}}</h4> --}}

                                        @php
                                            $permissions = App\Models\User::getpermissionsByPermissionName(
                                                $group->name,
                                            );
                                            $j = 1;
                                        @endphp
                                        <hr>



                                        <table class="table table-bordered align-items-center table-hover text-dark" id="class_table">

                                            <tr class="table-info">
                                                <th>Sl</th>
                                                <th>Permission Name</th>

                                                <th>Create</th>
                                                <th>Read</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                            @foreach ($permissions as $permission)
                                                <tr>
                                                    <td>
                                                        @php
                                                            echo $j;
                                                        @endphp
                                                    </td>

                                                    <td>

                                                        <label
                                                            class="form-check-label">{{ $permission->permissions_name }}
                                                        </label>

                                                    </td>

                                                    <td>
                                                        @if ($contains = Illuminate\Support\Str::contains($permission->p_create, 'create'))
                                                            {{-- @if ($permission->permission_type == 'create') --}}
                                                            {{-- <label class="form-check-label" for="checkPermission">
                                                                {!! '&emsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;' !!}</label> --}}
                                                            <input type="checkbox" class="form-check"
                                                                style=" border: 1px solid #ccc; padding: 5px;"name="permissions[]"
                                                                id="checkPermission{{ $permission->p_create_id }}"
                                                                value="{{ $permission->p_create }}">
                                                        @else
                                                            {{ 'N/A' }}
                                                        @endif
                                                    </td>




                                                    <td>
                                                        @if ($contains = Illuminate\Support\Str::contains($permission->p_view, 'view'))
                                                            {{-- @if ($permission->permission_type == 'view') --}}
                                                            {{-- <label class="form-check-label" for="checkPermission">
                                                                {!! '&emsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;' !!}</label> --}}
                                                            <input type="checkbox" class="form-check"
                                                                style=" border: 1px solid #ccc; padding: 5px;"name="permissions[]"
                                                                id="checkPermission{{ $permission->p_view_id }}"
                                                                value="{{ $permission->p_view }}">
                                                        @else
                                                            {{ 'N/A' }}
                                                        @endif
                                                    </td>



                                                    <td>
                                                        @if ($contains = Illuminate\Support\Str::contains($permission->p_edit, 'edit'))
                                                            {{-- @if ($permission->permission_type == 'edit') --}}
                                                            {{-- <label class="form-check-label" for="checkPermission">
                                                                {!! '&emsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;' !!}</label> --}}
                                                            <input type="checkbox" class="form-check"
                                                                style=" border: 1px solid #ccc;padding: 5px;"name="permissions[]"
                                                                id="checkPermission{{ $permission->p_edit_id }}"
                                                                value="{{ $permission->p_edit }}">
                                                        @else
                                                            {{ 'N/A' }}
                                                        @endif

                                                    </td>



                                                    <td>
                                                        @if ($contains = Illuminate\Support\Str::contains($permission->p_destroy, 'destroy'))
                                                            {{-- @if ($permission->permission_type == 'destroy') --}}
                                                            {{-- <label class="form-check-label" for="checkPermission">
                                                                {!! '&emsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;';
                                                                '&nbsp;' !!}</label> --}}
                                                            <input type="checkbox" class="form-check"
                                                                style=" border: 1px solid #ccc; padding: 5px;"name="permissions[]"
                                                                id="checkPermission{{ $permission->p_destroy_id }}"
                                                                value="{{ $permission->p_destroy }}">
                                                        @else
                                                            {{ 'N/A' }}
                                                        @endif
                                                    </td>


                                                </tr>
                                                @php $j++; @endphp
                                            @endforeach
                                        </table>



                                        <br>
                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-center">
                                    <button id="save" type="submit" onclick=""
                                        class="btn btn-primary mt-4">Create</button>
                                </div>

                            </form>



                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>





    <script>
        $("#checkPermissionAll").click(function() {
            if ($(this).is(":checked")) {
                // check all the checkbox
                $("input[type=checkbox]").prop("checked", true);
            } else {
                // uncheck all the checkbox
                $("input[type=checkbox]").prop("checked", false);
            }
        });

        function checkCheckboxes(checkbox_id, div_id) {

            $(function() {
                if ($('input#' + checkbox_id).is(":checked")) {
                    $('#' + div_id + ' input:checkbox').prop("checked", true);
                } else {

                    $('#' + div_id + ' input:checkbox').prop("checked", false);

                }
            });

        }


        $(document).ready(function() {
            //CREATE BATCH
            $(document).on('submit', '#AddMenuForm', function(e) {
                e.preventDefault();

                let formData = new FormData($('#AddMenuForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "/roles-create",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // alert(response.message);
                        if ($.isEmptyObject(response.error)) {

                            $(location).attr('href', '/role-list');

                        } else {
                            printErrorMsg(response.error);
                        }
                    }
                });
            });

            function printErrorMsg(message) {

                $('#wrongrolename').empty();

                if (message.rolename == null) {
                    rolename = ""
                } else {
                    rolename = message.rolename[0]
                }


                alertify.error(rolename);

                $('#wrongrolename').append('<span id="">' + rolename + '</span>');

                // });
            }
        });
    </script>
</x-layout>
