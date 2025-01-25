// Function to add permission details to the table
function permissionAddToTable() {
    // Prevent default form submission behavior
    this.event.preventDefault();

    // Retrieve input values
    var permission_name = $("#permission_name").val();
    var permission_group = $("#permission_group").find("option:selected").val();
    var route_name = $("#route_name").val();
    var permission_type = $("#permission_type").find("option:selected").val();

    // Clear previous error messages
    $('#errorMsg').empty();
    $('#errorMsg1').empty();

    // Validate input fields
    if (permission_name.length != 0 && permission_group.length != 0 && route_name.length != 0 && permission_type.length != 0) {
        // Append new row to the permission transfer table
        $('#permission_transfer_table_body').append('<tr>\
            <td>'+route_name+'</td>\
            <td ">'+permission_name+'</td>\
            <td>'+permission_group+'</td>\
            <td ">'+permission_type+'</td>\
            <td><button class="btn-remove" style="background: transparent; border: none;" value=""><i class="fas fa-minus-circle" style="color: red;"></i></button></td>\
        </tr>');
    } else {
        // Notify user if all fields are required
        alertify.error("Required all fields to add.");

    }
}

// Event handler for removing a permission row from the table
$("#permission_transfer_table").on('click', '.btn-remove', function () {
    $(this).closest('tr').remove();
});

// Function to transfer permissions to server
function permissionAddToServer() {
    // Prevent default form submission behavior
    this.event.preventDefault();

    let permissions = {};
    let permissionList = [];

    // Check if there are rows in the permission transfer table
    if ($('#permission_transfer_table tr').length > 1) {
        $('#errorMsg').empty();
        $('#errorMsg1').empty();

        // Iterate through each row of the permission transfer table
        $('#permission_transfer_table').find('> tbody > tr').each(function () {
            let permission = {};

            // Extract data from table cells and populate permission object
            permission["route_name"] = $(this).find("td:eq(0)").text();
            permission["permission_name"] = $(this).find("td:eq(1)").text();
            permission["permission_group"] = $(this).find("td:eq(2)").text();
            permission["permission_type"] = $(this).find("td:eq(3)").text();

            // Push permission object to permissionList array
            permissionList.push(permission);
        });

        // Assign permissionList array to permissions object
        permissions["permissionList"] = permissionList;

        // Call function to transfer permissions to server
        productTransfer(permissions);
    } else {
        // Notify user to add at least one permission to submit
        $('#errorMsg1').text('Please add at least one permission to submit.');
    }
}

// Function to send permission data to server via AJAX
function productTransfer(jsonData) {
    $.ajax({
        type: "POST",
        url: "/permission-create",
        data: JSON.stringify(jsonData),
        dataType: "json",
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            // Notify user of success message
            alertify.success(response.message);

            // Reset form and table after successful submission
            resetButton();
        }
    });
}

// Function to reset form and table, and clear error messages
function resetButton() {
    $('#errorMsg').empty();
    $('#errorMsg1').empty();
    $('#form_div').find('form')[0].reset();
    $("#permission_transfer_table").find("tr:gt(0)").remove();
    // Additional reset logic if needed
    $('form').on('reset', function () {
        // Additional reset actions
    });
}
