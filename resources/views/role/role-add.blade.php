
<x-layout titlePage="Role Management" bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="role.create"></x-navbars.sidebar>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Role Management" index=''></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-8">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> manage all your role here</h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <button id="role_create" class="btn bg-gradient-warning mb-0"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                role</button>
                        </div>
                        <div class="card-body px-2 pb-2">
                            <div class="table  p-0 text-dark ">
                                <table class="table align-items-center mb-0 text-dark mx-1 my-1 category_table"
                                    id="role_table">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                #
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Role Name</th>

                                            <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description</th>
                                          
                                            <th class="text-secondary opacity-7"></th>
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
    
    <div class="modal fade" id="CreateRoleMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>CREATE Role</strong></h5>
                </div>
                <form id="AddRoleForm" method="POST" enctype="multipart/form-data">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rolename" class="form-label">Role Name</label>
                            <input type="text" class="form-control" name="rolename" id="rolename" placeholder="Enter role name">
                          </div>

                          <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="2" placeholder="Enter role description"></textarea>
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





    <script>
        $('#close').click(function(e) {
            e.preventDefault();

            $('#CreateRoleMODAL').modal('hide');
        });
        $('#closes').click(function(e) {
            e.preventDefault();

            $('#EDITRoleMODAL').modal('hide');

        });
        $('.cancel_btn').click(function(e) {
            e.preventDefault();

            $('#DELETERoleMODAL').modal('hide');
        });
    </script>

</x-layout>
