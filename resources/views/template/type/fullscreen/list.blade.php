<x-layout titlePage="Full Screen Template List" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='template.view'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Full Screen Template List" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/template"> Template</a></li>'></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class='row'>
                                    <div class='col-6'>
                                        <h6 class="text-white mx-3"><strong> Full Screen Template List </strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class=" me-3 my-3">
                                <div class="text-end">
                                    <a class="btn bg-gradient-warning mb-0" href="{{ route('template.fullscreen.create') }}">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Template
                                    </a>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('template.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>SL.</th>
                                                        <th>Template Name</th>
                                                        <th>Rotation</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    @foreach($templateLists as $key => $templateList)
                                                        <tr>
                                                            <th scope="row" class="align-middle text-center">
                                                                <span class="text-secondary text-xs font-weight-bold">{{ ++$key }}</span>
                                                            </th>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 ps-3 text-sm">{{ $templateList->template_name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    {{-- <h6 class="mb-0 ps-3 text-sm">{{ $templateList->rotation }}</h6> --}}
                                                                    <h6 class="mb-0 ps-3 text-sm">
                                                                        @if($templateList->rotation=='true') On
                                                                        @else Off
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle ps-4">
                                                                <a href="{{ route('template.fullscreen.edit', $templateList->id) }}" ><i class="fas fa-edit" style="color: green"></i></a>
                                                                <a href="" id="{{ $templateList->id }}" class="deleteIcon"><i class="fas fa-trash" style="color: red"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
        {{-- @include('template.edit') --}}

    </main>
    <x-plugins></x-plugins>
    <div class="modal fade" id="DELETEtemplateMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="DELETEtemplateFORM" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}


                <div class="modal-body">
                    <input type="hidden" name="" id="id">
                    <h5 class="text-center">Are you sure you want to delete?</h5>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="cancel_btn btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="delete btn btn-outline-danger">Yes</button>
                </div>

            </form>

        </div>
    </div>
</div>
    @push('js')


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function () {


            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');

                $('#id').val(id);
                $('#DELETEtemplateFORM').attr('action', '/template-list-delete/' + id);
                $('#DELETEtemplateMODAL').modal('show');
            });
            // delete user ajax request

        });
        $('.cancel_btn').click(function (e) {
            e.preventDefault();
            $('#DELETEtemplateMODAL').modal('hide');

        });
    </script>
    @endpush
</x-layout>

