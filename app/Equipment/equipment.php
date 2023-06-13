<?php 
    include_once('./app/database/conn.php') 
?>

    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow-lg rounded">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Equipment List</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#equipmentModal">
                    ADD NEW EQUIPMENT
                </button>
            </div>

            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                    <th scope="col">#NO</th>
                        <!-- <th>Equipment ID</th> -->
                        <th>Equipment type</th>
                        <th>Manu Facturer</th>
                        <th>Model</th>
                        <th>Purchase Date</th>
                        <th>Warranty Info</th>
                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    $count=0;

                    // Select all Equipment from the database
                    $result = mysqli_query($conn, "SELECT * FROM Equipment");

                    // Loop through the results and output each Equipment as a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        // echo "<td>" . $row['equipment_id'] . "</td>";
                        echo "<td>" . $row['equipment_type'] . "</td>";
                        echo "<td>" . $row['manufacturer'] . "</>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['purchase_date'] . "</td>";
                        echo "<td>" . $row['warranty_information'] . "</td>";
                        echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editEquipment(" . $row['equipment_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteEquipment(" . $row['equipment_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="equipmentModal" tabindex="-1" aria-labelledby="equipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staffModalLabel">ADD NEW EQUIPMENT</h1>
            </div>
            <form action="./app/Equipment/process_equipment.php" method="post" id="formInsertUpdate">
            <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="equipment_type" class="form-label">Equipment type:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="equipment_type" name="equipment_type" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="manufacturer" class="form-label">Manufacturer:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="manufacturer" name="manufacturer" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="model" class="form-label">Model:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="model" name="model" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="purchase_date" class="form-label">Purchase date:</label>
                            <input type="date" class="form-control border border-1 border-primary" id="purchase_date" name="purchase_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="warranty_information" class="form-label">Warranty information:</label>
                        <textarea class="form-control border border-1 border-primary" id="warranty_information" name="warranty_information" required> </textarea>
                    </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                <button type="submit" id='submit' class="btn btn-outline-primary">Add Equipment</button>
            </div>
            </form>
        </div>
    </div>
</div>





<script>
    function editEquipment(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/Equipment/getEquipment.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#equipment_type').val(data.equipment_type);
                $('#manufacturer').val(data.manufacturer);
                $('#model').val(data.model);
                $('#purchase_date').val(data.purchase_date);
                $('#warranty_information').val(data.warranty_information);

                $('#submit').text('update equipment')
            }

        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#equipmentModal').modal('hide');
            });
            // Show the modal
            $('#equipmentModal').modal('show');
        });
    }

    function deleteEquipment(id) {
        var id = id;
        $.ajax({
            url: './app/Equipment/deleteEquipment.php',
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
                url: './app/Equipment/process_equipment.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#equipmentModal').modal('hide');
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
