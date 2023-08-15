<?php
include_once('./app/database/conn.php')
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Services</title>
</head>
<div class="container-fluid ">

    <div class=" mt-1 p-3 rounded overflow-auto shadow  bg-white">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-white bg-primary px-2">Services List</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#serviceModal">
                <i class="fa-solid fa-plus "></i>
            </button>
        </div>
        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#NO</th>

                    <th>Name</th>
                    <th>Description</th>
                    <th>Fee</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

                // Select all services from the database
                $sql = "SELECT * FROM services";
                $result = mysqli_query($conn, $sql);

                // Loop through each row and display the data in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["fee"]) . "</td>";
                    echo "<td class='text-center'> 
                            <button  class='btn btn-primary' onclick='editServices(" . $row['service_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                            <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteServices(" . $row['service_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                          </td>";
                    echo "</tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">New Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- hidden input -->
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="name" class="form-label text-primary ">Service Name</label>
                        <input type="text" class="form-control border border-1 border-primary" id="name" name="name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label text-primary">Description</label>
                        <textarea class="form-control border border-1 border-primary" id="description"
                            name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fee" class="form-label text-primary">Fee</label>
                        <input type="number" class="form-control border border-1 border-primary" id="fee" name="fee"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="Button" class="btn btn-outline-primary" id="submit"
                            onclick="insertUpdate()">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


</html>
<script>
function editServices(ids) {

    var id = ids;
    $('#id').val(id);
    //get services data

    $.ajax({
        url: './app/services/getService.php',
        type: 'POST',
        data: {
            updateid: id
        },
        success: function(response) {
            var data = JSON.parse(response);
            // alert(data.name);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#fee').val(data.fee);
            // show modal
            $('#serviceModal').modal('show');
        }

    });
    $("#submit").text('Update');
}

function deleteServices(id) {
    var id = id;
    $.ajax({
        url: './app/services/deleteService.php',
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
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });
    //$('#dataTable').DataTable();


});

function insertUpdate() {

    var name = $('#name').val();
    var description = $('#description').val();
    var fee = $('#fee').val();
    var id = $('#id').val();
    var ulr = './app/services/process_service.php';
    var data = {
        name: name,
        description: description,
        fee: fee,
        id: id
    };

    $.ajax({
        url: ulr,
        type: 'POST',
        data: data,
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
</script>