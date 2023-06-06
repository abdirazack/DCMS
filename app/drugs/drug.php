<?php
include_once('./app/database/conn.php')
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow-lg rounded">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Drugs</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#drugModal">
                ADD NEW DRUG
            </button>
        </div>

        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>Drug ID</th>
                    <th>Drug Name</th>
                    <th>Drug Description</th>
                    <th>Drug Cost</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM drugs");

                // Loop through the results and output each staff member as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['drug_id'] . "</td>";
                    echo "<td>" . $row['drug_name'] . "</td>";
                    echo "<td>" . $row['drug_description'] . "</td>";
                    echo "<td>" . $row['drug_cost'] . "</>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editDrug(" . $row['drug_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteDrug(" . $row['drug_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="drugModal" tabindex="-1" aria-labelledby="drugModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="drugModalLabel">ADD NEW DRUG</h1>
            </div>
            <form action="./app/medication/process_medication.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Drug Name:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="name" name="name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="cost" class="form-label">Drug Cost:</label>
                            <input type="number" class="form-control border border-1 border-primary" id="cost" name="cost" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Drug Description:</label>
                            <textarea  type="text" class="form-control  border border-1 border-primary" id="description" name="description" required> </textarea>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                        <button type="submit" id='submit' class="btn btn-outline-primary">Add Drug</button>
                    </div>
            </form>
        </div>
    </div>
</div>



<script>
    function editDrug(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/drugs/getDrug.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#name').val(data.drug_name);
                $('#cost').val(data.drug_cost);
                $('#description').val(data.drug_description);

                
            }

        });

        $('#submit').text('update Drug')
        $(document).ready(function() {
    $('#closeButton').on('click', function() {
      // Close the modal
      $('#drugModal').modal('hide');
    });
    
    // Show the modal
    $('#drugModal').modal('show');
  });
    }

    function deleteDrug(id) {
        var id = id;
        $.ajax({
            url: './app/drugs/deleteDrug.php',
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

        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/drugs/process_drug.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#drugModal').modal('hide');
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