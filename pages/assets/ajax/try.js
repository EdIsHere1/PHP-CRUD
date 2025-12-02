$(document).ready(function () {
    // console.log("try.js is loaded");
    employeeTable();
});

function employeeTable() {
    $.ajax({
        url: "./pages/assets/php/try.php",
        method: "POST",
        data: {
            formula: "employeeT_"
        },
        dataType: "json",
        beforesend: function () {
            $('.overlay').show();
        },
        success: function (res) {
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
                str = `<tr>
                            <td colspan="2" class="text-center">No Data Available</td>
                        </tr>`;
            }
            $(".employeeTable").html(str);
        },
    })
}