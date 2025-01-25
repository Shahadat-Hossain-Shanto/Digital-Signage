<x-layout titlePage="Create Permission" bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="permission.create.view"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Create Permission"
            index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/permission-list"> Permission List </a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4" style="min-height: 74vh;">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Create Permission</h6>
                            </div>
                        </div>

                        <div class="card-body px-4 pb-2" id="form_div">
                            <form id="" method="" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="vatname" class="form-label"
                                                style="font-weight: normal;">Permission Name<span
                                                    class="text-danger"><strong>*</strong></span></label>
                                            <input type="text" class="form-control border border-2 p-2 w-75"
                                                name="permission_name" id="permission_name"
                                                placeholder="Enter Permission Name">
                                            <h6 class="text-danger pt-1" id="wrong_permission_name"
                                                style="font-size: 14px;"></h6>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">

                                            <label for="brandname" class="form-label"
                                                style="font-weight: normal;">Permission Group Name<span
                                                    class="text-danger"><strong>*</strong></span></label><br>
                                            <select style="width:50%; padding-left:6px;" class="form-select "
                                                name="permission_group" id="permission_group" data-live-search="true"
                                                title="Select Permission Group Name" data-width="75%">
                                                <option value="" disabled selected>Select Permission Group Name
                                                </option>
                                                @foreach ($permission_groups as $permission_group)
                                                    <option value="{{ $permission_group->group_name }}">
                                                        {{ $permission_group->group_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="vatname" class="form-label"
                                                style="font-weight: normal;">Permission Route Name<span
                                                    class="text-danger"><strong>*</strong></span></label>
                                            <input type="text" class="form-control border border-2 p-2 w-75"
                                                name="route_name" id="route_name"
                                                placeholder="Enter Permission Route Name">
                                            <h6 class="text-danger pt-1" id="wrong_permission_name"
                                                style="font-size: 14px;"></h6>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="vatname" class="form-label"
                                                style="font-weight: normal;">Permission type<span
                                                    class="text-danger"><strong>*</strong></span></label><br>
                                            <select style="width:50%; padding-left:6px;" class="form-select "
                                                name="permission_type" id="permission_type" data-live-search="true"
                                                title="Select Permission Type" data-width="75%">
                                                <option value="" disabled selected>Select Permission Type</option>
                                                <option value="create">Create</option>
                                                <option value="edit">Edit</option>
                                                <option value="view">View</option>
                                                <option value="destroy">Delete</option>
                                            </select>
                                            <h6 class="text-danger pt-1" id="wrong_permission_type"
                                                style="font-size: 14px;"></h6>

                                        </div>
                                    </div>
                                    <div class="row form-group pt-3">
                                        <div class="col-7"></div>

                                        <div class="col-5">
                                            <button type="reset" value="Reset"
                                                class="btn btn-outline-danger justify-content-end"
                                                onclick="resetButton()"><i class="fas fa-eraser"></i> Reset</button>
                                            <button id="add_btn" type="button"
                                                class=" w-30 btn btn-primary justify-content-end ml-2"
                                                onclick="permissionAddToTable()"><i class="fas fa-plus"></i>
                                                Add</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-10">
                                            <table id="permission_transfer_table"
                                                class="table align-items-center table-hover text-dark">
                                                <thead class="bg-light text-capitalize">
                                                    <tr>
                                                        <th scope="col">Route Name</th>

                                                        <th scope="col">Permission Name</th>

                                                        <th scope="col">Permission Group Name</th>

                                                        <th scope="col">Permission Type</th>

                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="permission_transfer_table_body">

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-9">
                                            <h6 class="text-danger text-end"><strong id="errorMsg1"></strong></h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-10 text-end" style="padding-top: 10px">
                                            <button id="" type="button" class=" btn btn-primary "
                                                onclick="permissionAddToServer()"> Create Permission</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

    <script src="{{ asset("js/permission-transfer.js") }}"></script>
    <script></script>
</x-layout>
