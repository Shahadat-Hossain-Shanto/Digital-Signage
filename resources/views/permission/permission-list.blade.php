<x-layout titlePage="Permission List" bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="permission.list"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Permission List" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12" style="min-height: 79vh;">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Permission List</h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 mb-0 text-end">
                            <a href="/permission-create" class="btn bg-gradient-warning mb-0" href="javascript:;"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Create New
                                Permission</a>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <div class="table table-responsive text-dark p-0">
                                <table class="table align-items-center table-hover text-dark" id="permission_table">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="text-uppercase font-weight-bolder opacity-7">
                                                #
                                            </th>
                                            <th class="text-uppercase font-weight-bolder opacity-7">
                                                Route Name</th>
                                            <th class="text-uppercase font-weight-bolder opacity-7 ps-2">
                                                Permission Name</th>
                                            <th class="text-uppercase font-weight-bolder opacity-7 ps-2">
                                                Permission Group</th>

                                            <th class="text-uppercase font-weight-bolder opacity-7 ps-2"> Action </th>
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
    </main>

    <!-- Edit Vat Modal -->
    <div class="modal fade" id="EDITPermissionMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>UPDATE PERMISSION</strong></h5>
                </div>

                <!-- Update Vat Form -->
                <form id="UPDATEPermissionFORM" enctype="multipart/form-data">

                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <div class="form-group mb-3">
                            <label>Permission Name<span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" id="edit_permission_name" name="permission_name"
                                class="form-control border border-2 p-2">
                            <h6 class="text-danger pt-1" id="edit_wrong_permission_name" style="font-size: 14px;"></h6>

                        </div>

                        <div class="form-group mb-3">
                            <label>Permission Group Name <span class="text-danger"><strong>*</strong></span></label><br>
                            <select class="form-select border border-2 p-2" data-width="100%" name="permission_group"
                                id="edit_permission_group">
                                @foreach ($permission_groups as $permission_group)
                                    <option value="{{ $permission_group->group_name }}">
                                        {{ $permission_group->group_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Permission route name <span class="text-danger"><strong>*</strong></span></label>
                            <input type="test" id="edit_route_name" name="route_name"
                                class="form-control border border-2 p-2">
                            <h6 class="text-danger pt-1" id="edit_wrong_permission_group" style="font-size: 14px;"></h6>

                        </div>

                        <div class="form-group mb-3">
                            <label>Permission Type <span class="text-danger"><strong>*</strong></span></label>
                            <select class="form-select border border-2 p-2" name="permission_group_type"
                                id="edit_permission_group_type">
                                <option value="create">Create</option>
                                <option value="edit">Edit</option>
                                <option value="view">View</option>
                                <option value="destroy">Delete</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <!-- End Update Vat Form -->

            </div>
        </div>
    </div>
    <!-- End Edit Vat Modal -->

    <!-- Delete Modal -->

    <div class="modal fade" id="DELETEPermissionMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEPermissionFORM" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}

                    <div class="modal-body">
                        <input type="hidden" name="" id="vatid">
                        <h5 class="text-center">Are you sure you want to delete?</h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancel btn btn-secondary cancel_btn"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="delete btn btn-danger">Yes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset("js/permission-list.js") }}"></script>
    <script>
        $('#close').click(function(e) {
            e.preventDefault();
            $('#EDITPermissionMODAL').modal('hide');

        });
        $('.cancel_btn').click(function(e) {
            e.preventDefault();

            $('#DELETEPermissionMODAL').modal('hide');
        });
    </script>
</x-layout>
