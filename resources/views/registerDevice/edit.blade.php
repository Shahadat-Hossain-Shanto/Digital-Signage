<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="" id="updateForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Registration Device</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="register_id" id="register_id">

                    <div class="row">
                        <div class="col-lg-4">
                            <label class="form-label">Device ID </label>
                            <input type="text" class="form-control border border-2 p-2" name="device_id"
                                id="edit_device_id" readonly>
                            <div class="edit_device_idError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">IMEI/Serial Number </label>
                            <input type="text" class="form-control border border-2 p-2" name="imei"
                                id="edit_imei">
                            <div class="edit_imeiError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Device Type </label>
                            <input type="text" class="form-control border border-2 p-2" name="device_type"
                                id="edit_device_type">
                            <div class="edit_device_typeError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Size </label>
                            <input type="text" class="form-control border border-2 p-2" name="size"
                                id="edit_size">
                            <div class="edit_sizeError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Model </label>
                            <input type="text" class="form-control border border-2 p-2" name="model"
                                id="edit_model">
                            <div class="edit_modelError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Brand </label>
                            <input type="text" class="form-control border border-2 p-2" name="brand"
                                id="edit_brand">
                            <div class="edit_brandError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Description </label>
                            <input type="text" class="form-control border border-2 p-2" name="description"
                                id="edit_description">
                            <div class="edit_descriptionError text-danger errors d-none"></div>
                        </div>

                        <div class="col-lg-4">
                            <label class="form-label">Setup Location </label>
                            <input type="text" class="form-control border border-2 p-2" name="setup_location"
                                id="edit_setup_location">
                            <div class="edit_setup_locationError text-danger errors d-none"></div>
                        </div>

                        <div class="col-lg-4">
                            <label for="form-label">Operarting Sysytem</label>
                            <select class="form-select border border-2 p-2" aria-label="Default select OS"
                                name="os" id="edit_os">
                                <option disabled selected>Please Select the Operarting Sysytem</option>
                                <option value="Windows">Windows</option>
                                <option value="Android">Android</option>
                                <option value="IOS">IOS</option>
                            </select>
                            <div class="osError text-danger errors d-none"></div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Device Status </label>
                            <select class="form-select border border-2 p-2" aria-label="Default select example"
                                name="status" id="edit_status">
                                <option disabled selected>Please Select the Device Status</option>
                                <option value="true">Active</option>
                                <option value="false">Inactive</option>
                            </select>
                            <div class="edit_statusError text-danger errors d-none"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_user_btn">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
