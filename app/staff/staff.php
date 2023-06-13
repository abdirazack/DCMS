<?php
include_once('./app/database/conn.php')
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow-lg rounded">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Staff List</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staffModal">
                ADD NEW STUFF
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
                    <th>Experience</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=0;

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM employee_stuff_view");

                // Loop through the results and output each staff member as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    echo "<td>" . $row['employee_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</>";
                    echo "<td>" . $row['role_name'] . "</td>";
                    echo "<td>" . $row['Experience'] . "</td>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editStaff(" . $row['employee_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteStaff(" . $row['employee_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staffModalLabel">ADD NEW STAFF</h1>
            </div>
            <form action="./app/staff/process_staff.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3">
                            <!-- select   first_name and last_name from  employees table -->
                            <label for="employee" class="form-label">First Name:</label>
                            <select class="form-control select2 border border-1 border-primary" id="employee" name="employee" required>
                                <option value="">Select Employee</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM employees  WHERE employee_id NOT IN ( SELECT employee_id FROM Dentists)");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['employee_id'] . "'>" . $row['first_name'] . ' '. $row['last_name']  . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 ">
                            <label for="role" class="form-label">Role:</label>
                            <select class="form-control select2 border border-1 border-primary" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM roles");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['role_id'] . "'>" . $row['role_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 ">
                            <label for="experience" class="form-label">Experience:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="experience" name="experience" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary">Add Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editStaff(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/staff/getStaff.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                // alert(response);
                var data = JSON.parse(response);
                $('#formInsertUpdate select[name="employee"]').val(data.employee_id).trigger('change');;
                $('#formInsertUpdate select[name="role"]').val(data.role_id);
                $('#experience').val(data.Experience);
            }
        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#staffModal').modal('hide');
            });
            // Show the modal
            $('#staffModal').modal('show');
        });
    }

    function deleteStaff(id) {
        var id = id;
        $.ajax({
            url: './app/staff/deleteStaff.php',
            type: 'POST',
            data: {
                deleteid: id
            },
            success: function(response) {
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

        $(".select2").select2();

        //make the width of the select2 100%
        $('.select2').css('width', '100%');


        
        $('#role').select2({
            dropdownParent: $('#staffModal')
        });
        $('#employee').select2({
            dropdownParent: $('#staffModal')
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
            $.ajax({
                url: './app/staff/process_staff.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#staffModal').modal('hide');
                        location.reload();
                    } else {
                        //show error on div with id small
                        $('#small').html(obj.message);
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