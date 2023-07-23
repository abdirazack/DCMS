<!DOCTYPE html>
<html>

<head>
    <title>Employees Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once('./app/database/conn.php');
    ?>
    <style>
        body {
            font-family: nunito;
        }

        .modal,
        .form-control,
        .form-select,
        .btn {

            border-radius: 12px;
        }


    </style>
</head>

<body>

    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow-lg rounded overflow-auto">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Employees List</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#employeeModal">
                    <i class="fa-solid fa-plus "></i>
                </button>
            </div>

            <table class="table table-hover" id="dataTable">
                <thead class='text-truncate' style='max-width: 10px;'>
                    <tr>
                        <th scope="col">#NO</th>
                        <!-- <th scope="col">Employee ID</th> -->
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Role</th>
                        <th scope="col">Experience</th>
                        <th scope="col">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Salary Type </th>
                        <th scope="col">Currency</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Hire Date</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;

                    // Select all staff from the database
                    $result = mysqli_query($conn, "SELECT * FROM Addresses_Employees_View");

                    // Loop through the results and output each patients member as a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        // echo "<td>" . $row['employee_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</>";
                        echo "<td class='text-truncate' style='max-width: 10px;'>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['role_name'] . "</td>";
                        echo "<td>" . $row['Experience'] . "</td>";
                        echo "<td class='text-truncate' style='max-width: 10px;'>" . $row['street'] . ' ' . $row['city'] . ' ' . $row['state'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['salary_type'] . "</td>";
                        echo "<td>" . $row['currency'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "<td>" . $row['hire_date'] . "</td>";
                        echo "<td class='text-center'> 
                                    <a  class='btn btn-primary' onclick='editEmployee(" . $row['employee_id'] . ")'> <icon class='fa fa-edit'></icon> </a> 
                                    <a href='#' class='ms-2 mt-1' style='color: red;' onclick='deleteEmployee(" . $row['employee_id'] . ")'> <icon class='fa fa-trash'></icon> </a> 
                                  </td>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>



<!-- Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="employeeModalLabel">ADD NEW EMPLOYEE</h1>
            </div>
            <form action="./app/employees/process_employee.php" method="post" id="formInsertUpdate" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class='small text-danger' id='small'></p>
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="experience" class="form-label">Experience:</label>
                            <input type="text" class="form-control" id="experience" name="experience" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="salary_type" class="form-label">Salary Type:</label>
                            <input type="text" class="form-control" id="salary_type" name="salary_type" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="mb-3 col-md-4">
                            <label for="currency" class="form-label">Currency:</label>
                            <input type="text" class="form-control" id="currency" name="currency" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="amount" class="form-label">Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for='gender' class="form-label">Select a Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <!-- select role from database -->
                            <label for="role" class="form-label">Role:</label> <br>
                            <select style="width: 100%;" class="form-select selecjkt2" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM Roles");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['role_id'] . "'>" . $row['role_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label for="address" class="form-label">Address:</label>
                        <div class="mb-3 input-group">
                            <!-- select2 address from addresses table  -->
                            <select style="width: 90%;" class="form-select select2" id="address" name="address">
                                <option value="">Select Address</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM Addresses");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['address_id'] . "'>" . $row['street'] . ', ' . $row['city'] . ', ' . $row['state'] . "</option>";
                                }
                                ?>
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary mt-2 d-inline" data-toggle="modal" data-target="#addressModal">
                                    <!-- Add a plus icon with tooltip that says 'add new address' -->
                                    <icon class="fa fa-plus"></icon>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="row">

                    </div>

                    <!-- Upload profile picture -->
                    <div class="row">
                        <div>
                            <label class="form-label" for='profile'>Upload Profile</label>
                            <input class="form-control" type="file" name="profile" id="profile">
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label for="Hire Date" class='form-label'>Hire Date</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary">Add Employee</button>
                </div>
            </form>

        </div>
    </div>
</div>




<script>
    function editEmployee(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/employees/getEmployee.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                // alert(response)
                var data = JSON.parse(response);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#phone_number').val(data.phone);
                $('#experience').val(data.experience);
                $('#salary_type').val(data.salary_type);
                $('#currency').val(data.currency);
                $('#amount').val(data.amount);
                $('#formInsertUpdate select[name="role"]').val(data.role_id).trigger('change');
                $('#gender').val(data.gender);
                $('#email').val(data.email);
                $('#formInsertUpdate  select[name="address"').val(data.address).trigger('change');
                $('#hire_date').val(data.hire_date);
            }

        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#employeeModal').modal('hide');
            });
            // Show the modal
            $('#employeeModal').modal('show');
        });
    }

    function deleteEmployee(id) {
        var id = id;
        $.ajax({
            url: './app/employees/deleteEmployee.php',
            type: 'POST',
            data: {
                deleteid: id
            },
            success: function(response) {
                // alert(response)
                $('#small').text(response);
                var obj = jQuery.parseJSON(response);
                if (obj.status == 200) {
                    location.reload();
                } else {
                    alert(obj.message);
                }
            }
        });
    }

    $(document).ready(function() {

        // select2
        $(".select2").select2();
        $('#address').select2({
            dropdownParent: $('#employeeModal')
        });
        $('#role').select2({
            dropdownParent: $('#employeeModal')
        });

        $('#dataTable').DataTable({
            pagingType: 'full_numbers',
            "aLengthMenu": [
                [5, 10, , 20, 50, 75, -1],
                [5, 10, 20, 50, 75, "All"]
            ],
            "iDisplayLength": 5,
            "bDestroy": true,

        });

        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/employees/process_employee.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response)
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#staffModal').modal('hide');
                        location.reload();
                    } else {
                        //show error on div with id small
                        $('#small').text(obj.message);
                        alert(obj.message);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

    });
</script>

<!-- Handle Address  -->
<script>
    $(document).ready(function() {
        $('#formInsertUpdateAddress').submit(function(e) {
            // var page = 'employee';
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/address/process_address.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response)
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#addressModal').modal('hide');
                        // location.reload();
                    } else {
                        //show error on div with id small
                        $('#small').text(obj.message);
                        alert(obj.message);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
</script>

<?php
include_once('./app/address/modal_address.php');
// include_once('./app/address/process_address.php');
?>