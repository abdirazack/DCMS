<?php
include_once('./app/database/conn.php')
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow rounded overflow-auto">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Suppliers</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#supplierModal">
            <i class="fa-solid fa-plus "></i>
            </button>
        </div>

        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#NO</th>
                    <!-- <th>Supplier ID</th> -->
                    <th>Supplier Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=0;

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM Addresses_Supplier_View");

                // Loop through the results and output each staff member as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    // echo "<td>" . $row['supplier_id'] . "</td>";
                    echo "<td>" . $row['supplier_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['street'] .' '. $row['city'].' ' . $row['state']. "</td>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editSupplier(" . $row['supplier_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteSupplier(" . $row['supplier_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="supplierModalLabel">Add New Supplier</h1>
            </div>
            <form action="./app/supplier/process_supplier.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Supplier Name:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="name" name="name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="phone_number" name="phone_number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control border border-1 border-primary" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <div class="mb-3 input-group">
                            <!-- select2 address from addresses table  -->
                            <select style="width: 90%;" class="form-control border border-1 border-primary select2" id="address" name="address">
                                <option value="">Select Address</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM Addresses");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['address_id'] . "'>" .' '. $row['street'] .' '.  $row['city'] .' ' . $row['state'] . "</option>";
                                }
                                ?>
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary ms-1 d-inline" data-toggle="modal" data-target="#addressModal">
                                    <!-- Add a plus icon with tooltip that says 'add new address' -->
                                    <icon class="fa fa-plus"></icon>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary">Add Supplier</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>



<script>
    function editSupplier(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/supplier/getSupplier.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#name').val(data.supplier_name);
                $('#email').val(data.email);
                $('#phone_number').val(data.phone_number);
                $('#formInsertUpdate select[name = "address"]').val(data.address).trigger('change');
                
            }

        });

        $('#submit').text('update Sipplier')
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#supplierModal').modal('hide');
            });
            // Show the modal
            $('#supplierModal').modal('show');
        });
    }

    function deleteSupplier(id) {
        var id = id;
        $.ajax({
            url: './app/supplier/deleteSupplier.php',
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
        // select2
        $(".select2").select2();
        $('#address').select2({
            dropdownParent: $('#supplierModal')
        });

        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/supplier/process_supplier.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#supplierModal').modal('hide');
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


<!-- Handle Address  -->
<script>
    $(document).ready(function() {
        $('#formInsertUpdateAddress').submit(function(e) {
            // var page = 'employee';
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
                        // location.reload();
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