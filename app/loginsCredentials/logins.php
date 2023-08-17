<?php
include_once('./app/database/conn.php')
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow overflow-auto rounded  bg-white">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Employees Login Login Credentials</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#loginModal">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>

        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#NO</th>

                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>IS ADMIN</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM logincredentialsview ");

                // Loop through the results and output each staff member as a table row
                while ($row = mysqli_fetch_assoc($result)) {

                    $count++;

                    $chb =  $row['isAdmin'];
                    if ($chb == 1) {
                        $chb = "YES";
                    } else {
                        $chb = "NO";
                    }

                    echo "<tr>";
                    echo "<td>" . $count . "</td>";

                    echo "<td>" . htmlspecialchars ( $row['employee_id']) . "</td>";
                    echo "<td>" . htmlspecialchars ( $row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars ( $row['last_name']) . "</>";
                    echo "<td>" . htmlspecialchars ( $row['role_name']) . "</>";
                    echo "<td>" . htmlspecialchars ( $row['Username']). "</td>";
                    echo "<td>" . htmlspecialchars ( $row['Password']) . "</td>";
                    echo "<td>" . $chb . "</td>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editLogin(" . $row['employee_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteLogin(" . $row['employee_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">ADD NEW LOGIN</h1>
            </div>
            <form action="./app/loginsCredentials/process_login.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3">
                            <!-- select   first_name and last_name from  employees table -->
                            <label for="employee" class="form-label">First Name:</label>
                            <select class="form-control select2 border border-1 border-primary" id="employee" name="employee" required>
                                <option value="">Select Employee</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM employees");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['employee_id'] . "'>" . $row['first_name'] . ' ' . $row['last_name']  . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 ">
                            <label for="Username">Username:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="Username" name="Username" required>
                        </div>
                        <div class="mb-3 ">
                            <label for="Password">Password:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="Password" name="Password" required>
                        </div>
                        <div class="mb-3 mx-3 form-check">
                            <!-- add a checkbox for isAdmin -->
                            <input class="form-check-input" type="checkbox" value="1" id="isAdmin" name="isAdmin">
                            <label for="isAdmin" class="form-label">Is Admin </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary">Add Login</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editLogin(ids) {

        var id = ids;
        $('#id').val(id);
        showLoader();
        $.ajax({
            url: './app/loginsCredentials/getLogin.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                // alert(response);
                var data = JSON.parse(response);
                $('#formInsertUpdate select[name="employee"]').val(data.employee_id).trigger('change');;
                $('#Username').val(data.Username);
                $('#Password').val(data.Password);
                var chb = data.isAdmin;
                if (chb == true) {
                    $('#isAdmin').prop('checked', true);
                } else {
                    $('#isAdmin').prop('checked', false);
                }
                hideLoader();
            },
            error: function(data) {
                alert(data);
                hideLoader();
            },
            complete: function(data) {
                hideLoader();
            }
        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#loginModal').modal('hide');
            });
            // Show the modal
            $('#loginModal').modal('show');
        });
    }

    function deleteLogin(id) {
        var id = id;
        showLoader();
        $.ajax({
            url: './app/loginsCredentials/deleteLogin.php',
            type: 'POST',
            data: {
                deleteid: id
            },
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if (obj.status == 200) {
                    location.reload();
                    hideLoader();
                } else {
                    alert(obj.message);
                    hideLoader();
                }
            },
            error: function(data) {
                alert(data);
                hideLoader();
            },
            complete: function(data) {
                hideLoader();
            }
        });
    }

    $(document).ready(function() {
        hideLoader();
        $(".select2").select2();

        //make the width of the select2 100%
        $('.select2').css('width', '100%');



        $('#role').select2({
            dropdownParent: $('#loginModal')
        });
        $('#employee').select2({
            dropdownParent: $('#loginModal')
        });
        $('#dataTable').DataTable({
            pagingType: 'full_numbers',
            "aLengthMenu": [
                [5, 10, , 20, 50, 75, -1],
                [5, 10, 20, 50, 75, "All"]
            ],
            "iDisplayLength": 5,
            "bDestroy": true
        });

        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            showLoader();
            $.ajax({
                url: './app/loginsCredentials/process_login.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#loginModal').modal('hide');
                        location.reload();
                        hideLoader();
                    } else {
                        //show error on div with id small
                        $('#small').html(obj.message);
                        alert(obj.message);
                        hideLoader();
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    alert(data);
                    hideLoader();
                },
                complete: function(data) {
                    hideLoader();
                }
            });
        });

    });
</script>