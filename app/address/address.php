<?php
include_once('./app/database/conn.php');
?>

<div class="container-fluid ">
    <div class=" mt-1 p-3 shadow overflow-auto rounded">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Address</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#addressModal">
            <i class="fa-solid fa-plus "></i>

            </button>
        </div>
        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#NO</th>
                    <!-- <th>Address ID</th> -->
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=0;

                // Select all treatment plans from the database
                $result = mysqli_query($conn, "SELECT * FROM addresses");

                // Loop through the results and output each Plan as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    // echo "<td>" . $row['address_id'] . "</td>";
                    echo "<td>" . $row['street'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['state'] . "</td>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editAddress(" . $row['address_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteAddress(" . $row['address_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div> 

<?php
include_once('./app/address/modal_address.php');
?>


<script>
    function editAddress(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/address/getAddress.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#street').val(data.street);
                $('#city').val(data.city);
                $('#state').val(data.state);
            }
        });

        $("#submit").text('Update');
        //toggle modal
        $('#addressModal').modal('show');
    }

    function deleteAddress(id) {
        var id = id;
        $.ajax({
            url: './app/address/deleteAddress.php',
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



        $('#formInsertUpdateAddress').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/address/process_address.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response)
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#addressModal').modal('hide');
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

