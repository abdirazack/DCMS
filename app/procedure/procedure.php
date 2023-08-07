<?php 
    include_once('./app/database/conn.php') 
?>

    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow overflow-auto rounded  bg-white">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Procedures List</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#procedureModal">
                <i class="fa-solid fa-plus "></i>
                </button>
            </div>

            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                    <th scope="col">#NO</th>

                        <!-- <th>Procedure ID</th> -->
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    $count=0;

                    // Select all Procedures from the database
                    $result = mysqli_query($conn, "SELECT * FROM Procedures");
                   
                    // Loop through the results and output each Procedure as a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        // echo "<td>" . $row['procedure_id'] . "</td>";
                        echo "<td>" . $row['procedure_code'] . "</td>";
                        echo "<td>" . $row['procedure_name'] . "</>";
                        echo "<td>" . $row['procedure_price'] . "</td>";
                        echo "<td>" . $row['procedure_description'] . "</td>";
                        echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editProcedure(" . $row['procedure_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteProcedure(" . $row['procedure_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>




<!-- Modal -->
<div class="modal fade" id="procedureModal" tabindex="-1" aria-labelledby="procedureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staffModalLabel">ADD NEW PROCEDURE</h1>
            </div>
            <form action="./app/procedure/process_procedure.php" method="post" id="formInsertUpdate">
            <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="procedure_code" class="form-label">Code:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="procedure_code" name="procedure_code" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="procedure_name" class="form-label">Name:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="procedure_name" name="procedure_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="procedure_price" class="form-label">Price:</label>
                            <input type="number" class="form-control border border-1 border-primary" id="procedure_price" name="procedure_price" required>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="procedure_description" class="form-label">Description:</label>
                        <textarea class="form-control border border-1 border-primary" id="procedure_description" name="procedure_description" required> </textarea>
                    </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                <button type="submit" id='submit' class="btn btn-outline-primary">Add Procedure</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editProcedure(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/procedure/getProcedure.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#procedure_code').val(data.equipment_type);
                $('#procedure_name').val(data.manufacturer);
                $('#procedure_price').val(data.model);
                $('#procedure_description').val(data.warranty_information);

                $('#submit').text('update procedure')
            }

        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#procedureModal').modal('hide');
            });
            // Show the modal
            $('#procedureModal').modal('show');
        });
    }

    function deleteEquipment(id) {
        var id = id;
        $.ajax({
            url: './app/procedure/deleteProcedure.php',
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
                url: './app/procedure/process_procedure.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#procedureModal').modal('hide');
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


