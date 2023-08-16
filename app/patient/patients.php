<!DOCTYPE html>
<html>

<head>
    <title>Staff Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once('./app/database/conn.php');
    // include_once('./includes/loader.php');
    ?>
    <style>
        body {
            font-family: nunito;
        }

        @media print {
            .ignore-print {
                display: none;
            }
        }

        .modal,
        .form-control,
        .form-select,
        .btn {
            border-radius: 12px;
        }
    </style>

</head>
<div class="container-fluid bg-white">

    <div class=" mt-1 p-3 mx-auto rounded shadow overflow-auto">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-white bg-primary px-2">Patients List</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#patientModal">
                <i class="fa-solid fa-plus "></i>
            </button>
        </div>

        <table class="table table-bordered" id="dataTable">
            <thead class='text-truncate' style='max-width: 10px;'>
                <tr>
                    <th scope="col">#NO</th>

                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col" class="text-center ignore-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM Addresses_Patients_View");

                // Loop through the results and output each patients member as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr >";
                    echo "<td>" . $count . "</td>";
                    // echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . htmlspecialchars( $row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars( $row['last_name'] ). "</>";
                    echo "<td>" .  htmlspecialchars($row['phone_number'] ). "</td>";
                    echo "<td>" .  htmlspecialchars($row['gender'] ). "</td>";
                    echo "<td class='text-truncate' style='max-width: 10px;'>" . $row['street'] . ' ' . $row['city'] . ' ' . $row['state'] . "</td>";
                    echo "<td>" . $row['birth_date'] . "</td>";
                    echo "<td class='text-center ignore-print'> 
                                    <a  class='' onclick='editPatient(" . $row['patient_id'] . ")'> <icon class='fa fa-edit'></icon> </a> 
                                    <a style='color: red;' class=' ms-2 mt-1' onclick='deletePatient(" . $row['patient_id'] . ")'> <icon class='fa fa-trash'></icon> </a> 
                                  </td>";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="patientModalLabel">ADD NEW PATIENT</h4>
            </div>
            <form action="./app/patient/process_patient.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <p class='small text-danger' id='small'></p>
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control " id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control " id="last_name" name="last_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control " id="phone_number" name="phone_number" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="birth_date" class="form-label">Birth Date:</label>
                            <input type="date" class="form-control " id="birth_date" name="birth_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label ">User Type</label>
                        <?php
                        // Get the list of possible enum values for the gender column
                        $result = mysqli_query($conn, "SHOW COLUMNS FROM patients WHERE Field='gender'");
                        $row = mysqli_fetch_array($result);
                        $enum_list = $row['Type'];

                        // Parse the enum list to extract the individual values
                        preg_match_all("/'([^']+)'/", $enum_list, $matches);
                        $enum_values = $matches[1];

                        // Output the HTML select element
                        echo '<select name="gender" id="gender" class="form-select form-control">';
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
                            <select style="width: 90%;" class="form-select form-control select2" id="address" name="address">
                                <option value="">Select Address</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM Addresses");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['address_id'] . "'>" . ' ' . $row['street'] . ' ' . $row['city'] . ' ' . $row['state'] . "</option>";
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

                </div>
                <div class="modal-footer  m-0 bg-jh">
                    <button type="button" class="btn btn-outline-danger py-1 px-2" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary py-1 px-2">Add Patient</button>
                </div>
            </form>

        </div>
    </div>
</div>




<script>
    function editPatient(ids) {

        var id = ids;
        $('#id').val(id);
        showLoader();
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
                $('#patientModal').modal('show');
                hideLoader();
            },
            error: function(error) {
                hideLoader();
                alert(error);
            }

        });

        $("#submit").text('Update');

    }

    function deletePatient(id) {
        var id = id;
        showLoader();
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
                    hideLoader();
                    location.reload();
                } else {
                    hideLoader();
                    alert(obj.message);
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


        $('#dataTable').DataTable({
            // "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            'pagingType': 'full_numbers',

            // Add the Buttons extension options
            "dom": 'Bfrtip', // B for buttons
            "buttons": [
                'copy', 'csv', 'excel', 'pdf',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(.ignore-print)' // Exclude columns with "ignore-print" class
                    }
                }
            ]
        });


        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $("#loading-overlay").removeClass('d-none');
            $("#loader").removeClass('d-none');
            $.ajax({
                url: './app/patient/process_patient.php',
                type: 'POST',
                data: formData,
                success: function(response) {

                    // alert(response)
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#patientModal').modal('hide');
                        location.reload();
                        $("#loader").addClass('d-none');
                        $("#loading-overlay").addClass('d-none');
                    } else {
                        //show error on div with id small
                        $('#small').text(obj.message);
                        alert(obj.message);
                        $("#loader").addClass('d-none');
                        $("#loading-overlay").addClass('d-none');
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


        $('#formInsertUpdateAddress').submit(function(e) {
            // var page = 'patient';
            e.preventDefault();
            var formData = new FormData(this);
            $("#loader").removeClass('d-none');
            $("#loading-overlay").removeClass('d-none');
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
                        // location.reload();
                        $("#loader").addClass('d-none');
                        $("#loading-overlay").addClass('d-none');
                    } else {
                        //show error on div with id small
                        $('#small').text(obj.message);
                        alert(obj.message);
                        $("#loader").addClass('d-none');
                        $("#loading-overlay").addClass('d-none');
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
<?php
include_once('./app/address/modal_address.php');
// include_once('./app/address/process_address.php');
?>