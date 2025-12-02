<?php
    include('./pages/index.php');
?>

<!-- Add Employee Modal -->
<div id="modal_add" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="modalAddLabel">ADD EMPLOYEE</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="container">
            <form id="form_add">

                <div class="mb-3">
                <label for="name" class="form-label" style="font-size: 11px!important; letter-spacing: 1.1px;">NAME</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input id="name" type="text" class="form-control" placeholder="Enter Name" required>
                </div>
                </div>

                <div class="mb-3">
                <label for="contact_no" class="form-label" style="font-size: 11px!important; letter-spacing: 1.1px;">CONTACT</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input id="contact_no" type="number" class="form-control" placeholder="Enter Contact number" required>
                </div>
                </div>

                <div class="mb-3">
                <label for="address" class="form-label" style="font-size: 11px!important; letter-spacing: 1.1px;">ADDRESS</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input id="address" type="text" class="form-control" placeholder="Enter Address" required>
                </div>
                </div>

                <div id="statusMessage" class="text-danger"></div>

                <button id="btn_add" type="submit" class="btn btn-dark w-100">Add</button>
            </form>
            </div>
        </div>

        </div>
    </div>
</div>

<!-- View Employee Modal -->
<div id="modal_view" class="modal fade" tabindex="-1" aria-labelledby="modalViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="modalViewLabel">VIEW EMPLOYEE DETAILS</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="container">

                <div class="row mb-2 align-items-center">
                    <label class="col-sm-3 col-form-label text-uppercase fw-bold text-muted" style="font-size: 11px!important; letter-spacing: 1.1px;">Name: </label>
                    <div class="col-sm-9">
                        <p id="view_name" class="form-control-plaintext border-bottom pb-1 mb-0"></p>
                    </div>
                </div>

                <div class="row mb-2 align-items-center">
                    <label class="col-sm-3 col-form-label text-uppercase fw-bold text-muted" style="font-size: 11px!important; letter-spacing: 1.1px;">Contact No. : </label>
                    <div class="col-sm-9">
                        <p id="view_contact_no" class="form-control-plaintext border-bottom pb-1 mb-0"></p>
                    </div>
                </div>

                <div class="row mb-2 align-items-center">
                    <label class="col-sm-3 col-form-label text-uppercase fw-bold text-muted" style="font-size: 11px!important; letter-spacing: 1.1px;">Address : </label>
                    <div class="col-sm-9">
                        <p id="view_address" class="form-control-plaintext border-bottom pb-1 mb-0"></p>
                    </div>
                </div>

                </div>
        </div>

        </div>
    </div>
</div>

<!-- Edit Employee Modal -->
<div id="modal_edit" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">EDIT EMPLOYEE</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="container">
            <form id="form_edit">
                <input type="hidden" name="formula" value="edit_employee">
                <input type="hidden" name="edit_id" id="edit_id">
                

                <div class="mb-3">
                <label for="edit_name" class="form-label" style="font-size: 11px!important; letter-spacing: 1.1px;">NAME</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input id="edit_name" type="text" class="form-control" name="edit_name" required>
                </div>
                </div>

                <div class="mb-3">
                <label for="edit_contact_no" class="form-label" style="font-size: 11px!important; letter-spacing: 1.1px;">CONTACT</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input id="edit_contact_no" type="number" class="form-control" name="edit_contact_no" required>
                </div>
                </div>

                <div class="mb-3">
                <label for="edit_address" class="form-label" style="font-size: 11px!important; letter-spacing: 1.1px;">ADDRESS</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input id="edit_address" type="text" class="form-control" name="edit_address" required>
                </div>
                </div>

                <div id="statusMessage" class="text-danger"></div>

                <button id="btn_update" type="submit" class="btn btn-dark w-100">Update</button>
            </form>
            </div>
        </div>

        </div>
    </div>
</div>


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            Welcome to the PHP CRUD

                            <button class="btn btn-primary float-end" id="btn_addEmployee"> New Employee</button>
                        </h1>
                    </div>
                    <br>
                    <table class="table table-hover table-striped text-center">
                        <thead class="table-dark">
                            <tr class="table table-border table-striped">
                                <th>ID</th>
                                <th>NAME</th>
                                <th>CONTACT</th>
                                <th>ADDRESS</th>
                                <th>DATE CREATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="table_employee">
                        </tbody>
                    </table>
                    <div class="overlay text-center">
                        <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        <div class="text-bold pt-2 pl-2">Loading...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./pages/assets/ajax/main.js"></script>