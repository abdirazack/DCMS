<?php
include_once('./app/database/conn.php')
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow overflow-auto rounded  bg-white">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Expense Types List</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#expenseTypeModal">
                <i class="fa-solid fa-plus "></i>
            </button>
        </div>

        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#NO</th>

                    <!-- <th>Expense Type ID</th> -->
                    <th>Expense Type</th>
                    <th>Expense Type Description</th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM expense_types");

                // Loop through the results and output each staff member as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    // echo "<td>" . $row['role_id'] . "</td>";
                    echo "<td>" . $row['expense_type'] . "</td>";
                    echo "<td>" . $row['expense_type_description'] . "</>";
                    echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editExpense(" . $row['expense_type_id'] . ")'> <i class='fa fa-edit'></i> </button> 
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deleteExpense(" . $row['expense_type_id'] . ")'> <i class='fa fa-trash'></i> </a> 
                                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="expenseTypeModal" tabindex="-1" aria-labelledby="expenseTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="expenseTypeModalLabel">ADD NEW Expense Type</h1>
            </div>
            <form action="./app/expense_types/process_expense_type.php" method="post" id="formInsertUpdate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="expense_type" class="form-label">Expense Type:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="expense_type" name="expense_type" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="expense_type_description" class="form-label">Expense Type Description:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="expense_type_description" name="expense_type_description" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" id="closeButton">Close</button>
                    <button type="submit" id='submit' class="btn btn-outline-primary">Add Expense Type</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editExpense(ids) {

        var id = ids;
        $('#id').val(id);
        showLoader();
        $.ajax({
            url: './app/expense_types/getExpense.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#expense_type').val(data.expense_type);
                $('#expense_type_description').val(data.expense_type_description);
                hideLoader();
            },
            error: function(data) {
                alert(data);
                hideLoader();
            },
            complete: function(data) {
                hideLoader();
            }
        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#expenseTypeModal').modal('hide');
            });
            // Show the modal
            $('#expenseTypeModal').modal('show');
        });
    }

    function deleteExpense(id) {
        var id = id;
        showLoader();
        $.ajax({
            url: './app/expense_types/deleteExpense.php',
            type: 'POST',
            data: {
                deleteid: id
            },
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if (obj.status == 200) {
                    location.reload();
                    hideLoader();
                } else {
                    alert(obj.message);
                    hideLoader();
                }
            },
            error: function(data) {
                alert(data);
                hideLoader();
            },
            complete: function(data) {
                hideLoader();
            }
        });
    }

    $(document).ready(function() {
        hideLoader();
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
            showLoader();
            $.ajax({
                url: './app/expense_types/process_expense_type.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        //hide modal
                        $('#expenseTypeModal').modal('hide');
                        location.reload();
                        hideLoader();
                    } else {
                        //show error on div with id small
                        $('#small').html(obj.message);
                        alert(obj.message);
                        hideLoader();
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    alert(data);
                    hideLoader();
                },
                complete: function(data) {
                    hideLoader();
                }
            });
        });

    });
</script>