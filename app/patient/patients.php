<!DOCTYPE html>
<html>

<head>
    <title>Staff Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once('./app/database/conn.php');
    ?>
</head>

<body>

    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow-lg rounded">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Patients List</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#patientModal">
                    ADD NEW PATIENT
                </button>
            </div>

            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Address</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Select all staff from the database
                    $result = mysqli_query($conn, "SELECT * FROM patients");

                    // Loop through the results and output each patients member as a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['patient_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['birth_date'] . "</td>";
                        echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editPatient(" . $row['patient_id'] . ")'> <icon class='fa fa-edit'></icon> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deletePatient(" . $row['patient_id'] . ")'> <icon class='fa fa-trash'></icon> </a> 
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
<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="patientModalLabel">ADD NEW PATIENT</h1>
            </div>
            <form action="./app/patient/process_patient.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <p class='small text-danger' id='small'></p>
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="last_name" name="last_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="birth_date" class="form-label">Birth Date:</label>
                            <input type="date" class="form-control border border-1 border-primary" id="birth_date" name="birth_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label text-primary ">User Type</label>
                        <?php
                        // Get the list of possible enum values for the gender column
                        $result = mysqli_query($conn, "SHOW COLUMNS FROM patients WHERE Field='gender'");
                        $row = mysqli_fetch_array($result);
                        $enum_list = $row['Type'];

                        // Parse the enum list to extract the individual values
                        preg_match_all("/'([^']+)'/", $enum_list, $matches);
                        $enum_values = $matches[1];

                        // Output the HTML select element
                        echo '<select name="gender" id="gender" class="form-control border border-1 border-primary">';
                        echo '<option value=""> Select Gender </option>';
                        foreach ($enum_values as $value) {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <div class="mb-3 input-group">
                            <!-- select2 address from addresses table  -->
                            <select style="width: 90%;" class="form-control border border-1 border-primary select2" id="address" name="address">
                                <option value="">Select Address</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM Addresses");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['address_id'] . "'>" .' '. $row['street'] .' '. $row['city'] .' '. $row['state'] . "</option>";
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit' class="btn btn-outline-primary">Add Patient</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>




<script>
    function editPatient(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/patient/getPatient.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                // alert(response)
                var data = JSON.parse(response);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#phone_number').val(data.phone_number);
                $('#gender').val(data.gender);
                $('#birth_date').val(data.birth_date);
                $('#address').val(data.address);

                // $('#submit').text('update staff')
            }

        });

        $("#submit").text('Update');
        //toggle modal
        $('#patientModal').modal('show');
    }

    function deletePatient(id) {
        var id = id;
        $.ajax({
            url: './app/patient/deletePatient.php',
            type: 'POST',
            data: {
                deleteid: id
            },
            success: function(response) {
                alert(response)
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
        $('#dataTable').DataTable({
            pagingType: 'full_numbers',
            "aLengthMenu": [
                [5, 10, , 20, 50, 75, -1],
                [5, 10, 20, 50, 75, "All"]
            ],
            "iDisplayLength": 5,
            "bDestroy": true
        });

        // select2
        $(".select2").select2();
        $('#address').select2({
            dropdownParent: $('#patientModal')
        });



        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/patient/process_patient.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response)
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
<script>
    $(document).ready(function() {
        $('#formInsertUpdateAddress').submit(function(e) {
            // var page = 'patient';
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/address/process_address.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response)
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#addressModal').modal('hide');
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
<?php
    include_once('./app/address/modal_address.php');
    // include_once('./app/address/process_address.php');
?>

