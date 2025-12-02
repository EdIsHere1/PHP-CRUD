<?php
    include('./pages/index.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Practical Exam - Employee Management System</h3>

                        <button class="btn btn-dark float-end" id="btn_addEmployee">New Employee</button>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-striped text-center">
                            <thead class="table-dark">
                                <tr class="table table-bordered table-striped">
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>CONTACT NO.</th>
                                    <th>DEPARTMENT</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="employeeTable">
                                <!-- Employee rows will be dynamically added here -->
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
</div>

<script src="./pages/assets/ajax/try.js"></script>