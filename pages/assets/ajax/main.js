// alert("Hello, welcome to the Practical Exam!");
// console.log("Hello, welcome to the Practical Exam!");
$(document).ready(function() {
    console.log("Hello, welcome to the Practical Exam!");
    table_employee();
});

$(document).on("click", "#btn_addEmployee", function (e) {
    e.preventDefault();
    $('#modal_add').modal('show');
});

$(document).on("submit", "#form_add", function (e) {
    e.preventDefault();

    $.ajax({
        url: "./pages/assets/php/main.php",
        method: "POST",
        data: {
            name: $("#name").val(),
            contact_no: $("#contact_no").val(),
            address: $("#address").val(),
            formula: 'add_employee',
        },
        beforeSend: ()=> {
            $('#btn_add').prop("disabled", true);
        },
        success: function (res) {
            switch ($.trim(res)) {
                case 'success': table_employee();
                $('#modal_add').modal('hide');
                swal.fire({
                    icon: 'success',
                    title: 'Added Successfully!',
                });
                $('#form_add')[0].reset();
                $('#btn_add').prop("disabled", false);
                break;

                case 'exist':
                    $('#statusMessage').text("Employee already exists.").addClass('text-danger');

                    setTimeout(function() {
                        $('#statusMessage').text("").removeClass('text-danger');
                        $('#btn_add').prop("disabled", false);
                    }, 2000);
                break;
            default:
                swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "something went wrong: " + res,
                });
            break;
            }
        },
        error: function (er) {
            console.log("AJAX Error:", er);
        },
    });
});
$(document).on("click", ".btn_view", function (e) {
    e.preventDefault();

    let id = $(this).data("id");
    
    $('#modal_view').modal('show');
    $.ajax({
        url: "./pages/assets/php/main.php",
        method: "POST",
        data: {
            id: id,
            formula: 'get_employee',
        },
        beforeSend: ()=> {
            console.log("Fetching employee data...");
        },
        success: function (res) {
            console.log("Employee data fetched:", res);

            try {
                let json = (typeof res === "string") ? JSON.parse(res) : res;
                console.log("Parsed JSON:", json);

                $("#view_id").text(json.id);
                $("#view_name").text(json.name);
                $("#view_contact_no").text(json.contact_no);
                $("#view_address").text(json.address);
                $("#view_dt_added").text(json.dt_added);
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: err => {
            console.log(err);
        }
    });
});

$(document).on("click", ".btn_edit", function (e) {
    e.preventDefault();

    let id = $(this).data("id");
    
    $('#modal_edit').modal('show');

    $.ajax({
        url: "./pages/assets/php/main.php",
        method: "POST",
        data: {
            id: id,
            formula: 'get_employee',
        },
        beforeSend: ()=> {
            console.log("Fetching employee data...");
        },
        success: function (res) {
            console.log("Employee data fetched:", res);

            try {
                let json = (typeof res === "string") ? JSON.parse(res) : res;
                console.log("Parsed JSON:", json);

                $("#edit_id").val(json.id);
                $("#edit_name").val(json.name);
                $("#edit_contact_no").val(json.contact_no);
                $("#edit_address").val(json.address);
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: err => {
            console.log(err);
        }
    });
});

$(document).on("submit", "#form_edit", function (e) {
    e.preventDefault();

    let data = new FormData($(e.target)[0]);

    swal.fire({
        title: 'Confirmation',
        text: 'Continue ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, proceed!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "./pages/assets/php/main.php",
                method: "POST",
                processData: false,
                contentType: false,
                data: data,
                beforeSend: ()=> {
                    $('#btn_update').prop("disabled", true);
                },
                success: function (res) {
                    switch (res) {
                        case 'success':
                            table_employee();
                            $('#modal_edit').modal('hide');
                            swal.fire({
                                icon: 'success',
                                title: 'Updated Successfully!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false,
                            });
                            break;
                            
                        default:
                            swal.fire({
                                title: 'Oops!',
                                text: res,
                                icon: 'warning',
                                confirmButtonClass: 'btn btn-warning',
                            });
                            break;
                    }
                },
                error: function (err) {
                    console.error("AJAX Error:", err);
                    swal.fire({
                        title: 'Error',
                        text: 'Failed to update employee. Try again.',
                        icon: 'error',
                    });
                },
                complete: function() {
                    $('#btn_update').prop("disabled", false);
                },
            });
        }
    });
});

$(document).on("click", ".btn_delete", function (e) {
    e.preventDefault();

    let id = $(this).data("id");

    swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "./pages/assets/php/main.php",
                method: "POST",
                data: {
                    id: id,
                    formula: 'delete_employee',
                },
                success: function (res) {
                    switch (res) {
                        case 'success':
                            swal.fire({
                                icon: 'success',
                                title: 'Deleted Successfully!',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            });
                            table_employee();
                            break;
                        default:
                            swal.fire({
                                title: 'Oops!',
                                text: res,
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            });
                    }
                },
                error: function (err) {
                    console.error("AJAX Error:", err);
                    swal.fire({
                        title: 'Error',
                        text: 'Failed to delete employee. Try again.',
                        icon: 'error',
                    });
                },
                complete: function() {
                    $('#btn_delete').prop("disabled", false);
                },
            });
        }
    });
});

function table_employee() {
    $.ajax({
        url: "./pages/assets/php/main.php",
        method: "POST",
        data: { 
            formula: "employeet_" 
        },
        dataType: "json",
        beforesend: ()=> {
            $('.overlay').show();
        },
        success: function(res) {
            $('.overlay').hide();
            select_d = res;
            var str = "";
            if (!$.isEmptyObject(res)) {
                select_d.forEach((x) => {
                    str += `<tr class="border border-default">
                                <td>${x.id}</td>
                                <td>${x.name}</td>
                                <td>${x.contact_no}</td>
                                <td>${x.address}</td>
                                <td>${x.dt_added}</td>
                                <td>
                                    <div class="btn-group" role="group">

                                    <button class="btn btn-sm text-secondary btn_view  btn-gray btn-outline-dark mr-1" data-toggle="tooltip" data-placement="bottom" title="View data"
										data-id="${x.id}">
										<i class="fa fa-eye"></i>
									</button>
									<button class="btn btn-sm text-secondary btn_edit  btn-gray btn-outline-dark mr-1" data-toggle="tooltip" data-placement="bottom" title="Edit data"
										data-id="${x.id}">
										<i class="fa fa-edit"></i>
									</button>
									<button class="btn btn-sm text-secondary btn_delete  btn-gray btn-outline-dark mr-1" data-toggle="tooltip" data-placement="bottom" title="Delete Data"
										data-id="${x.id}">
										<i class="fa fa-times"></i>
									</button>
								
							    </div>
                                </td>
                            </tr>`;
                })
            } else {
                str = `<tr><td colspan="6" class="text-center text-muted">No employees found</td></tr>`;
            }
            $(".table_employee").html(str);
        },
    })
}