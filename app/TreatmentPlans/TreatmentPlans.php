<?php 
    include_once('./app/database/conn.php') 
?>

    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow-lg rounded">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Treatment Plans List</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#treatmentModal">
                    ADD NEW Treatment Plan
                </button>
            </div>
                <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">#NO</th>
                        <!-- <th>Treatment Plan ID</th> -->
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total total_Cost</th>
                        <th>Status Date</th>

                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    $count=0;

                    // Select all treatment plans from the database
                    $result = mysqli_query($conn, "SELECT * FROM TreatmentPlan_Patients_View");

                    // Loop through the results and output each Plan as a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        // echo "<td>" . $row['treatment_plan_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['start_date'] . "</td>";
                        echo "<td>" . $row['end_date'] . "</td>";
                        echo "<td>" . $row['total_cost'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editTreatment(" . $row['treatment_plan_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteTreatment(" . $row['treatment_plan_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="treatmentModal" tabindex="-1" aria-labelledby="treatmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="treatmentModalLabel">ADD NEW Treatment Plan</h1>
            </div>
            <form action="./app/TreatmentPlans/process_Treatment.php" method="post" id="formInsertUpdate">
            <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="patients" class="control-label">Patient ID:</label>
                            <select class="form-control select2" id="patients" name="patients" REQUIRED> <br>
                                <option value="">Select Patient ID</option>
                                <?php
                                $query = "SELECT * FROM `patients`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['patient_id'] . "'>" . $row['first_name'] .' '. $row['last_name'] . "</option>";
                                }
                                ?>
                             </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="start_date" class="form-label">Start Date:</label>
                            <input type="date" class="form-control border border-1 border-primary" id="start_date" name="start_date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="end_date" class="form-label">End Date:</label>
                            <input type="date" class="form-control border border-1 border-primary" id="end_date" name="end_date" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="total_cost" class="form-label">Total total_Cost:</label>
                            <input type="number" class="form-control border border-1 border-primary" id="total_cost" name="total_cost" required>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label for="title" class="control-label">Status</label> 
                                    <!-- select treatment plan status  -->
                                    <select class="form-control" id="title" name="status" id="status" REQUIRED>
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <option value="Saved">Saved</option>
                                        
                                    </select>
                    </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                <button type="submit" id='submit' class="btn btn-outline-primary">Add Treatment Plan</button>
            </div>
            </form>
        </div>
    </div>
</div>





<script>
    function editTreatment(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/TreatmentPlans/getTreatment.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#formInsertUpdate select[name="patients"]').val(data.patient_id).trigger('change');
                // $('#patients').val(data.patient_id);
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
                $('#total_cost').val(data.total_cost);
                $('#formInsertUpdate select[name="status"').val(data.status).trigger('change');

                $('#submit').text('update treatment')
            }

        });

        $("#submit").text('Update');
        // Show the modal
        $('#treatmentModal').modal('show');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#treatmentModal').modal('hide');
            });
            
        });
      
    }

    function deleteTreatment(id) {
        var id = id;
        $.ajax({
            url: './app/TreatmentPlans/deleteTreatment.php',
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
        $('#dataTable').DataTable({
            pagingType: 'full_numbers',
            "aLengthMenu": [
                [5, 10, , 20, 50, 75, -1],
                [5, 10, 20, 50, 75, "All"]
            ],
            "iDisplayLength": 5,
            "bDestroy": true
        });

        $(".select2").select2();

        //make the width of the select2 100%
    $('.select2').css('width', '100%');


    $('#patients').select2({
        dropdownParent: $('#treatmentModal')
    });

        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/TreatmentPlans/process_treatment.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response)
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#treatmentModal').modal('hide');
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
