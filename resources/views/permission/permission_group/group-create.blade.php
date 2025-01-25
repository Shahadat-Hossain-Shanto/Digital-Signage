<x-layout titlePage="Pemission Group" bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="permission.group.create"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Pemission Group" index=""></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4" style="min-height: 74vh;">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Pemission Group</h6>
                            </div>
                        </div>
                        <div class=" me-3 mt-3 text-end">
                            <button id="permisiion_group_create" class="btn bg-gradient-warning mb-0"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Create New
                                Pemission Group </button>
                        </div>
                        <div class="card-body  px-4 pb-2">
                            <div class="table  p-0  ">
                                <table class="table align-items-center table-hover text-dark"
                                    id="permission_group_table">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="text-uppercase font-weight-bolder opacity-7">
                                                #
                                            </th>
                                            <th class="text-uppercase font-weight-bolder opacity-7">
                                                Pemission Group Name</th>

                                            <th class="text-uppercase font-weight-bolder opacity-7"> Action </th>
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

    <div class="modal fade" id="CreatePermissionGroupMODAL" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>CREATE PERMISSION GROUP </strong></h5>
                </div>

                <form id="AddPermissionForm" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body ml-2">

                        <div class="form-group ">
                            <label for="group_name" class="form-label ml-3" style="font-weight: normal;">Permission
                                Group Name<span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control border border-2 p-2" name="group_name"
                                id="group_name" placeholder="e.g. Apllication Settings">
                            <h6 class="text-danger pt-1" id="wrong_group_name" style="font-size: 14px;"></h6>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Edit Vat Modal -->
    <div class="modal fade" id="EDITPermissionGroupMODAL" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>UPDATE PERMISSION GROUP</strong></h5>
                </div>

                <!-- Update Vat Form -->
                <form id="UPDATEPermissionGroupFORM" enctype="multipart/form-data">

                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body ml-2">

                        <input type="hidden" name="id" id="id">

                        <div class="form-group mb-3">
                            <label>Permission Group Name<span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" id="edit_group_name" name="group_name"
                                class="form-control border border-2 p-2">
                            <h6 class="text-danger pt-1" id="edit_wrong_group_name" style="font-size: 14px;"></h6>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button id="closes" type="button" class="btn btn-outline-danger"
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

    <div class="modal fade" id="DELETEPermissionGroupMODAL" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEPermissionGroupFORM" method="POST" enctype="multipart/form-data">

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

    <!-- END Delete Modal -->

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $('#permisiion_group_create').click(function(e) {
                e.preventDefault();
                $('#CreatePermissionGroupMODAL').modal('show');
            });

            //CREATE permission_groups
            $(document).on("submit", "#AddPermissionForm", function(e) {
                e.preventDefault();

                let formData = new FormData($("#AddPermissionForm")[0]);

                $.ajax({

                    type: "POST",
                    url: "/permission-group-add",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        //

                        if ($.isEmptyObject(response.error)) {
                            window.location.reload();


                        } else {
                            printErrorMsg(response.error);

                        }


                    },
                });
            });
            // show customised error messege
            function printErrorMsg(message) {

                $("#wrong_group_name").empty();

                if (message.group_name == null) {
                    group_name = "";
                } else {
                    group_name = message.group_name[0];
                }


                $("#wrong_group_name").append('<span id="">' + group_name + "</span>");
            }
        });
        // load Permission List
        $(document).ready(function() {
            var t = $('#permission_group_table').DataTable({
                ajax: {
                    "url": "/permission-group-list-data",
                    "dataSrc": "permission_groups",
                },
                processing: true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "Loading..."
                },
                columns: [{
                        data: null
                    },
                    {
                        data: 'group_name'
                    },
                    {
                        "render": function(data, type, row, meta) {

                            return '<button type="button" value="' + row.id +
                                '" class="edit_btn btn btn-secondary "><i class="fas fa-edit fa-lg"></i></button>\
                                    <a href="javascript:void(0)" class="delete_btn btn btn-outline-danger " data-value="' +
                                row
                                .id +
                                '"><i class="fas fa-trash fa-lg"></i></a>'
                        }
                    },
                ],
                columnDefs: [{
                    searchable: true,
                    orderable: true,
                    targets: 0,
                }, ],
                order: [
                    [1, 'desc']
                ],
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ],
            });


            t.on('order.dt search.dt', function() {

                t.on('draw.dt', function() {
                    var PageInfo = $('#permission_group_table').DataTable().page.info();
                    t.column(0, {
                        page: 'current'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    });
                });

            }).draw();

        });


        //EDIT permission_groups
        $(document).on("click", ".edit_btn", function(e) {
            e.preventDefault();

            var Id = $(this).val();
            $("#EDITPermissionGroupMODAL").modal("show");

            $.ajax({
                type: "GET",
                url: "/permission-group-edit/" + Id,
                success: function(response) {
                    if (response.status == 200) {
                        $("#edit_group_name").val(
                            response.permission_group.group_name
                        );
                        $("#id").val(response.permission_group.id);
                    }
                },
            });
        });

        //UPDATE PERMISSION GROUP
        $(document).on("submit", "#UPDATEPermissionGroupFORM", function(e) {
            e.preventDefault();

            var id = $("#id").val();

            let EditFormData = new FormData($("#UPDATEPermissionGroupFORM")[0]);

            EditFormData.append("_method", "PUT");

            $.ajax({

                type: "POST",
                url: "/permission-group-edit/" + id,
                data: EditFormData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if ($.isEmptyObject(response.error)) {
                        $("#EDITPermissionGroupMODAL").modal("hide");
                        window.location.reload();

                    } else {
                        printErrorMsg(response.error);

                    }
                },
            });

            function printErrorMsg(message) {
                $('#edit_wrong_group_name').empty();


                if (message.group_name == null) {
                    group_name = ""
                } else {
                    group_name = message.group_name[0]
                }

                $('#edit_wrong_group_name').append('<span id="">' + group_name + '</span>');

            }

        });

        //Delete permission group
        $(document).ready(function() {
            $("#permission_group_table").on("click", ".delete_btn", function() {
                var Id = $(this).data("value");

                $("#id").val(Id);

                $("#DELETEPermissionGroupFORM").attr(
                    "action",
                    "permission-group-delete/" + Id
                );

                $("#DELETEPermissionGroupMODAL").modal("show");
            });
        });
    </script>
    <script>
        $('#close').click(function(e) {
            e.preventDefault();

            $('#CreatePermissionGroupMODAL').modal('hide');
        });
        $('#closes').click(function(e) {
            e.preventDefault();

            $('#EDITPermissionGroupMODAL').modal('hide');

        });
        $('.cancel_btn').click(function(e) {
            e.preventDefault();

            $('#DELETEPermissionGroupMODAL').modal('hide');
        });
    </script>

</x-layout>
