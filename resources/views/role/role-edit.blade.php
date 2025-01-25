<x-layout titlePage="Edit Role" bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="admin.roles.edit.view"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Role"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/role-list"> Role List </a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Edit Role</h6>

                            </div>
                        </div>

                        <div class="card-body px-4 pb-2">
                            <form name="AddMenuForm " action="{{ route("admin.roles.update", $role->id) }}"
                                method="POST">
                                @method("PUT")
                                @csrf
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6 pl-4">
                                                    <label for="rolename" style="font-weight:normal; ">Role Name</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control w-75 border border-2 p-2"
                                                        id="rolename" style="font-weight: ;" name="rolename"
                                                        value="{{ $role->name }}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-check ml-1">

                                            <div class="row">
                                                <div class="col-1">
                                                    <input type="checkbox" style="width: 16px;height: 16px;"
                                                        class="form-check" id="checkPermissionAll" value="1">
                                                </div>
                                                <div class="col-11">
                                                    <label class="form-check-label" style="font-size:16px"
                                                        for="checkPermissionAll">All
                                                        Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- <hr> --}}

                                @php $i = 1; @endphp

                                @foreach ($permissions as $permission)
                                    <div id="div{{ $i }}">
                                        <div class="form-group float-left pt-3 row" style="margin-left: 20px">
                                            <div class="col-1">
                                                <input type="checkbox"
                                                    class="form-check m-auto mt-2"style=" border: 1px solid #ccc; padding: 5px;"
                                                    id="checkPermissionAll_group{{ $i }}"
                                                    onclick="checkCheckboxes(this.id, 'div{{ $i }}');"
                                                    value="{{ $permission->name }}">
                                            </div>
                                            <div class="col-11">
                                                <label class=" form-check-label"
                                                    for="checkPermissionAll_group{{ $i }}"
                                                    style="font-size:17px">
                                                    <b>{{ $permission->name }}</b></label>
                                            </div>
                                        </div>
                                        @php $i++; @endphp

                                        @php
                                            $permissions_names = App\Models\User::getpermissionsByPermissionName(
                                                $permission->name,
                                            );
                                            $j = 1;
                                        @endphp

                                        <hr>

                                        <table class="table table-bordered" id="class_table" width="100%"
                                            cellspacing="0">

                                            <tr class="table-info">
                                                <th>Sl</th>
                                                <th>Permission Name</th>

                                                <th>Create</th>
                                                <th>Read</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                            @foreach ($permissions_names as $permission_name)
                                                <tr>
                                                    <td>
                                                        @php
                                                            echo $j;
                                                        @endphp
                                                    </td>

                                                    <td>

                                                        <label
                                                            class="form-check-label">{{ $permission_name->permissions_name }}
                                                        </label>

                                                    </td>

                                                    <td>
                                                        @if ($contains = Str::contains($permission_name->p_create, "create"))
                                                            {{-- @if ($permission->permission_type == "create") --}}
                                                            <label class="form-check-label" for="checkPermission">
                                                                {!! "&emsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;" !!}</label>
                                                            {{-- <input type="checkbox" class="form-check" style=" border: 1px solid #ccc; padding: 5px;"name="permissions[]"
                                                    id="checkPermission{{ $permission_name->p_create_id }}"
                                                    value="{{ $permission_name->p_create }}"> --}}

                                                            <input type="checkbox"
                                                                class="form-check"style=" border: 1px solid #ccc; padding: 5px;"
                                                                name="permissions[]"
                                                                {{ $role->hasPermissionTo($permission_name->p_create) ? "checked" : "" }}
                                                                id="checkPermission{{ $permission_name->p_create_id }}"
                                                                value="{{ $permission_name->p_create }}">
                                                            {{-- <label class="form-check-label"
                                                    for="checkPermission{{$permission_name->p_create_id}}">{{$permission_name->p_create
                                                    }}</label> --}}
                                                        @else
                                                            {{-- {{"N/A"}} --}}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($contains = Str::contains($permission_name->p_view, "view"))
                                                            {{-- @if ($permission->permission_type == "view") --}}
                                                            <label class="form-check-label" for="checkPermission">
                                                                {!! "&emsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;" !!}</label>

                                                            <input type="checkbox"
                                                                class="form-check"style=" border: 1px solid #ccc; padding: 5px;"
                                                                name="permissions[]"
                                                                {{ $role->hasPermissionTo($permission_name->p_view) ? "checked" : "" }}
                                                                id="checkPermission{{ $permission_name->p_view_id }}"
                                                                value="{{ $permission_name->p_view }}">
                                                        @else
                                                            {{-- {{"N/A"}} --}}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($contains = Str::contains($permission_name->p_edit, "edit"))
                                                            {{-- @if ($permission->permission_type == "edit") --}}
                                                            <label class="form-check-label" for="checkPermission">
                                                                {!! "&emsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;" !!}</label>

                                                            <input type="checkbox"
                                                                class="form-check"style=" border: 1px solid #ccc; padding: 5px;"
                                                                name="permissions[]"
                                                                {{ $role->hasPermissionTo($permission_name->p_edit) ? "checked" : "" }}
                                                                id="checkPermission{{ $permission_name->p_edit_id }}"
                                                                value="{{ $permission_name->p_edit }}">
                                                        @else
                                                            {{-- {{"N/A"}} --}}
                                                        @endif

                                                    </td>

                                                    <td>
                                                        @if ($contains = Str::contains($permission_name->p_destroy, "destroy"))
                                                            {{-- @if ($permission->permission_type == "destroy") --}}
                                                            <label class="form-check-label" for="checkPermission">
                                                                {!! "&emsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;";
                                                                "&nbsp;" !!}</label>

                                                            <input type="checkbox" class="form-check"
                                                                style=" border: 1px solid #ccc; padding: 5px;"name="permissions[]"
                                                                {{ $role->hasPermissionTo($permission_name->p_destroy) ? "checked" : "" }}
                                                                id="checkPermission{{ $permission_name->p_destroy_id }}"
                                                                value="{{ $permission_name->p_destroy }}">
                                                        @else
                                                            {{-- {{"N/A"}} --}}
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
                                    <button type="submit" class="btn btn-primary mt-4">Save Role</button>
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
    </script>
</x-layout>
