<x-layout titlePage="Role List" bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="admin.roles"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Role List" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4" style="min-height: 74vh;">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Role List</h6>
                            </div>
                        </div>
                        <div class=" me-3 mt-3 text-end">
                            <a href="/roles-create" id="brand_create" class="btn bg-gradient-warning mb-0"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Create New
                                Role</a>
                        </div>

                        <div class="card-body px-4 pb-2">
                            <table id="role_table" class="align-items-center table-hover text-dark">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%" class="text-uppercase font-weight-bolder opacity-7">#</th>
                                        <th width="10%" class="text-uppercase font-weight-bolder opacity-7">Role Name
                                        </th>
                                        <th width="60%" class="text-uppercase font-weight-bolder opacity-7">
                                            Permissions</th>
                                        <th width="15%" class="text-uppercase font-weight-bolder opacity-7">Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $perm)
                                                    <span class="btn btn-info mr-1">
                                                        {{ $perm->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>

                                                <a class="edit_btn btn btn-secondary "
                                                    href="{{ route("admin.roles.edit.view", $role->id) }}"><i
                                                        class="fas fa-edit fa-lg"></i></a>

                                                <a href="javascript:void(0)" class="delete_btn btn btn-outline-danger "
                                                    data-value="{{ $role->id }}"><i class="fas fa-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

    <!-- Delete Modal -->

    <div class="modal fade" id="DELETEROLEMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <form id="DELETEROLEFORM" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}

                    <div class="modal-body">
                        <input type="hidden" name="" id="id">
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

    <script>
        $(document).ready(function() {
            $('#role_table').DataTable({
                processing: true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "Loading..."
                },
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ],
            });

            $("#role_table").on("click", ".delete_btn", function() {
                var Id = $(this).data("value");

                $("#id").val(Id);

                $("#DELETEROLEFORM").attr("action", "/role-delete/" + Id);

                $("#DELETEROLEMODAL").modal("show");
            });
        });

        $(document).on('click', '.cancel_btn', function(e) {
            $('#DELETEROLEMODAL').modal('hide');
        });
    </script>
</x-layout>
