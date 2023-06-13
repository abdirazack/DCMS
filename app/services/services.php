<?php
    include_once('./app/database/conn.php')
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Services</title>
</head>

<body>
    <div class="container-fluid mx-auto">
        <div class="row shadow-lg rounded p-2">
            <div class="col-md-8">
                <h1 class="text-primary">Services</h1>
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
                        $count=0;

                        // Select all services from the database
                        $sql = "SELECT * FROM services";
                        $result = mysqli_query($conn, $sql);

                        // Loop through each row and display the data in the table
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . $row["fee"] . "</td>";
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
            <div class="col-md-4">
                <div class="card p-3 rounded">
                    <div class="card-body shadow rounded p-3">
                        <h1 class="card-title text-center text-primary fs-5">New Service</h1>
                        <form>
                            <!-- hidden input -->
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3">
                                <label for="name" class="form-label text-primary ">Service Name</label>
                                <input type="text" class="form-control border border-1 border-primary" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label text-primary">Description</label>
                                <textarea class="form-control border border-1 border-primary" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="fee" class="form-label text-primary">Fee</label>
                                <input type="number" class="form-control border border-1 border-primary" id="fee" name="fee" required>
                            </div>
                            <div class="text-center">
                                <button type="Button" class="btn btn-outline-primary" id="submit" onclick="insertUpdate()">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

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
            }});
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