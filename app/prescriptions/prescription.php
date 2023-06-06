<?php
include_once('./app/database/conn.php')
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow-lg rounded">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Prescriptions List</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prescriptionModal">
                add new prescriptions
            </button>
        </div>

        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>

                    <th>Prescription ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Medication Name</th>
                    <th>Dosage</th>
                    <th>Instruction</th>
                    <th>Date Prescribed</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM PrescriptionView ");

                // Loop through the results and output each staff member as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['prescription_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</>";
                    echo "<td>" . $row['medication_name'] . "</td>";
                    echo "<td>" . $row['dosage'] . "</td>";
                    echo "<td>" . $row['instruction'] . "</td>";
                    echo "<td>" . $row['date_prescribed'] . "</td>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editPrescription(" . $row['prescription_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deletePrescription(" . $row['prescription_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="prescriptionModalLabel">ADD NEW PRESCRIPTIONS</h1>
            </div>
            <form action="./app/prescriptions/process_prescription.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3">
                            <!-- select   first_name and last_name from  Patient table -->
                            <label for="patient" class="form-label">Name:</label>
                            <select class="form-control select2 border border-1 border-primary" id="patient" name="patient" required>
                                <option value="">Select Patient</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM patients");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['patient_id'] . "'>" . $row['first_name'] . ' ' . $row['last_name']  . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 ">
                            <!-- select2 for medication -->
                            <label for="medication" class="form-label">Medication:</label>
                            <select class="form-control select2 border border-1 border-primary" id="medication" name="medication" required>
                                <option value="">Select Medication</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM medications");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['medication_id'] . "'>" . $row['medication_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 ">
                            <!-- dosage -->
                            <label for="dosage" class="form-label">Dosage:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="dosage" name="dosage" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 ">
                            <!-- instruction -->
                            <label for="instruction" class="form-label">Instruction:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="instruction" name="instruction" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <!-- DATE Prescribed -->
                            <label for="date_prescribed" class="form-label">Date Prescribed:</label>
                            <input type="date" class="form-control border border-1 border-primary" id="date_prescribed" name="date_prescribed" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary">Add Prescronton</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editPrescription(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/prescriptions/getPrescription.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                // alert(response);
                var data = JSON.parse(response);
                $('#formInsertUpdate select[name="patient"]').val(data.patient_id).trigger('change');
                $('#formInsertUpdate select[name="medication"]').val(data.medication_id).trigger('change');
                $('#dosage').val(data.dosage);
                $('#instruction').val(data.instruction);
                $('#date_prescribed').val(data.date_prescribed);

            }
        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#prescriptionModal').modal('hide');
            });
            // Show the modal
            $('#prescriptionModal').modal('show');
        });
    }

    function deletePrescription(id) {
        var id = id;
        $.ajax({
            url: './app/prescriptions/deletePrescription.php',
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



        $('#patient').select2({
            dropdownParent: $('#prescriptionModal')
        });
        $('#medication').select2({
            dropdownParent: $('#prescriptionModal')
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
                url: './app/prescriptions/process_prescription.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#prescriptionModal').modal('hide');
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