<?php
include_once('./app/database/conn.php');
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow overflow-auto rounded">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Inventory List</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#inventoryModal">
            <i class="fa-solid fa-plus "></i>
            </button>
        </div>

        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                <th scope="col">#NO</th>

                    <!-- <th>Inventory ID</th> -->
                    <th>Item Name</th>
                    <th>Unit Cost</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Description</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=0;

                // Select all Inventory from the database
                $result = mysqli_query($conn, "SELECT * FROM inventory");

                // Loop through the results and output each Inventory item as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    // echo "<td>" . $row['inventory_id'] . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['unit_cost'] . "</>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['supplier_id'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editInventory(" . $row['inventory_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteInventory(" . $row['inventory_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="inventoryModal" aria-labelledby="inventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="inventoryModalLabel">ADD NEW ITEM</h1>
            </div>
            <form action="./app/inventory/process_inventory.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="first_name" class="form-label">Item Name:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="item_name" name="item_name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="unit_cost" class="form-label">Unit Cost:</label>
                            <input type="number" class="form-control border border-1 border-primary" id="unit_cost" name="unit_cost" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="quantity" name="quantity" required>
                        </div>
                        <!-- supplier id from database into a select2  -->
                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">Supplier:</label>
                            <select class="form-control border border-1 border-primary select2" id="supplier_id" name="supplier_id" required>
                                <option value="">Select Supplier</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM suppliers");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['supplier_id'] . "'>" . $row['supplier_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>


                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description:</label>
                            <textarea type='text' class="form-control border border-1 border-primary" id="description" name="description" required> </textarea>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary">Add Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editInventory(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: './app/inventory/getInventory.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#item_name').val(data.item_name);
                $('#unit_cost').val(data.unit_cost);
                $('#quantity').val(data.quantity);
               // $('#supplier_id').val(data.supplier_id);
                $('#description').val(data.description);
                $('#formInsertUpdate select[name="supplier_id"]').val(data.supplier_id).trigger('change');

            }

        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#inventoryModal').modal('hide');
            });
            // Show the modal
            $('#inventoryModal').modal('show');
        });
    }

    function deleteInventory(id) {
        var id = id;
        $.ajax({
            url: './app/inventory/deleteInventory.php',
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


        $('#supplier_id').select2({
            dropdownParent: $('#inventoryModal')
        });



        $('#dataTable').DataTable();

        $('#formInsertUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/inventory/process_inventory.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#inventoryModal').modal('hide');
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