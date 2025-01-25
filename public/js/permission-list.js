$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //CREATE Permission
    $(document).on("submit", "#AddPermissionForm", function (e) {
        e.preventDefault();

        let formData = new FormData($("#AddPermissionForm")[0]);

        $.ajax({
            type: "POST",
            url: "/permission-create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $(location).attr("href", "/permission-list");
                if ($.isEmptyObject(response.error)) {
                    $(location).attr("href", "/permission-list");
                } else {
                    //
                    printErrorMsg(response.error);
                }
            },
        });
    });

    function printErrorMsg(message) {
        $("#wrong_permission_name").empty();
        $("#wrong_permission_group").empty();

        if (message.permission_name == null) {
            permission_name = "";
        } else {
            permission_name = message.name[0];
        }
        if (message.permission_group == null) {
            permission_group = "";
        } else {
            permission_group = message.group[0];
        }

        $("#wrong_permission_name").append('<span id="">' + name + "</span>");
        $("#wrong_permission_group").append(
            '<span id="">' + group_name + "</span>"
        );
    }
});
// PERMISSION LIST
$(document).ready(function () {
    var t = $("#permission_table").DataTable({
        ajax: {
            url: "/permission-list-data",
            dataSrc: "permissions",
        },
        processing: true,
        language: {
            loadingRecords: "&nbsp;",
            processing: "Loading...",
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "permissions_name" },
            { data: "group_name" },
            {
                render: function (data, type, row, meta) {
                    return (
                        '<button type="button" value="' +
                        row.id +
                        '" class="edit_btn btn btn-secondary"><i class="fas fa-edit fa-lg"></i></button>\
                    <a href="javascript:void(0)" class="delete_btn btn btn-outline-danger " data-value="' +
                        row.id +
                        '"><i class="fas fa-trash fa-lg"></i></a>'
                    );
                },
            },
        ],
        columnDefs: [
            {
                searchable: true,
                orderable: true,
                targets: 0,
            },
        ],
        // order: [[1, "asc"]],
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, "Todos"],
        ],
    });

    t.on("order.dt search.dt", function () {
        t.on("draw.dt", function () {
            var PageInfo = $("#permission_table").DataTable().page.info();
            t.column(0, { page: "current" })
                .nodes()
                .each(function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
        });
    }).draw();
});

//EDIT Permission
$(document).on("click", ".edit_btn", function (e) {
    e.preventDefault();

    var Id = $(this).val();
    $("#EDITPermissionMODAL").modal("show");

    $.ajax({
        type: "GET",
        url: "/permission-edit/" + Id,
        success: function (response) {
            if (response.status == 200) {
                $("#edit_permission_name").val(
                    response.permission.permissions_name
                );
                $("#id").val(response.permission.id);
                $("#edit_route_name").val(response.permission.name);
                $("#edit_permission_group").val(response.permission.group_name);
                $("#edit_permission_group_type").val(
                    response.permission.permission_type
                );

                var newOption = $(
                    '<option value="' +
                        response.permission.group_name +
                        '">' +
                        response.permission.group_name +
                        "</option>"
                );

                $("#edit_route_name").val(response.permission.name);
            }
        },
    });
});

//UPDATE Permission
$(document).on("submit", "#UPDATEPermissionFORM", function (e) {
    e.preventDefault();

    var id = $("#id").val();

    let EditFormData = new FormData($("#UPDATEPermissionFORM")[0]);

    EditFormData.append("_method", "PUT");

    $.ajax({
        type: "POST",
        url: "/permission-edit/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function (response) {
            if ($.isEmptyObject(response.error)) {
                $("#EDITVatMODAL").modal("hide");
                alertify.success(response.message);
                $(location).attr("href", "/permission-list");
            } else {
                $("#wrong_permission_name").empty();
                $("#wrong_permission_group").empty();
            }
        },
    });
});

//Delete Vat
$(document).ready(function () {
    $("#permission_table").on("click", ".delete_btn", function () {
        var Id = $(this).data("value");

        $("#id").val(Id);

        $("#DELETEPermissionFORM").attr("action", "/permission-delete/" + Id);

        $("#DELETEPermissionMODAL").modal("show");
    });
});

function resetButton() {
    $("form").on("reset", function () {});
}
