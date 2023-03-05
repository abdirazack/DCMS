<?php
include_once('header.php');
include_once('conn.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Expenses</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100 rounded">
        <div class="row shadow-lg vw-100 rounded">
            <div class='d-flex justify-content-around mb-4 mt-2'>
                <h2 class="text-center text-primary">Expenses</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary"onclick="openModal()"> ADD NEW EXPENSE</button>
            </div>
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>Expense Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Drug Name </th>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Select all services from the database
                    $sql = "SELECT * FROM expenses_drug_view ";
                    $result = mysqli_query($conn, $sql);

                    // Loop through each row and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row["expense_type"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["amount"] . "</td>";
                        echo "<td>" . $row["drug_name"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editExpenses(" . $row['expense_id'] . ")'> EDIT </button> 
                                    <a href='#' class='btn btn-danger ms-2' onclick='deleteExpense(" . $row['expense_id'] . ")'> DELETE </a> 
                                  </td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="ExpenseModal" tabindex="-1" aria-labelledby="ExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ExpenseModalLabel">New Expenses</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="services/process_service.php" method="post" id="formInsertUpdate">
                        <!-- hidden input -->
                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <label for="name" class="form-label text-primary ">Expenses Type</label>
                            <?php
                            // Get the list of possible enum values for the user_type column
                            $result = mysqli_query($conn, "SHOW COLUMNS FROM expenses WHERE Field='expense_type'");
                            $row = mysqli_fetch_array($result);
                            $enum_list = $row['Type'];

                            // Parse the enum list to extract the individual values
                            preg_match_all("/'([^']+)'/", $enum_list, $matches);
                            $enum_values = $matches[1];

                            // Output the HTML select element
                            echo '<select name="expense_type" id="expense_type" class="form-control border border-1 border-primary">';
                            echo '<option value="">Select Expense Type</option>';
                            foreach ($enum_values as $value) {
                                echo '<option value="' . $value . '">' . $value . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="drug_id" class="form-label text-primary ">Select Drug</label>
                            <select class="form-control select2 border border-1 border-primary" data-bs-container="#ExpenseModal" id="drug_id" name="drug_id" REQUIRED>
                                <option value="">Select Drug</option>
                                <?php
                                $query = "SELECT * FROM `drugs`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['drug_id'] . "'>" . $row['drug_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label text-primary">Description</label>
                            <textarea class="form-control border border-1 border-primary" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fee" class="form-label text-primary">Amount</label>
                            <input type="number" class="form-control border border-1 border-primary" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label text-primary ">Expense Date</label>
                            <input type="date" class="form-control border border-1 border-primary" id="date" name="date" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function editExpenses(ids) {
        var id = ids;

        $('#id').val(id);
        $.ajax({
            url: 'expenses/getExpenses.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                $('.select2').select2();
                var data = JSON.parse(response);
                $('#date').val(data.date);
                $('#description').val(data.description);
                $('#amount').val(data.amount);
                $('#expense_type').val(data.expense_type);
                $('#formInsertUpdate select[name="drug_id"]').val(data.drug_id).trigger('change');

                //toggle modal
                $('#ExpenseModal').modal('show');
            }

        });

        $("#submit").text('Update');
    }

    function deleteExpense(id) {
        var id = id;
        $.ajax({
            url: 'expenses/deleteExpense.php',
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

    function openModal(){
        $('.select2').select2();
        $('#ExpenseModal').modal('show');
    }

    $(document).ready(function() {
        $('.select2').select2();


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
                url: 'expenses/process_expense.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response)
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        location.reload();
                    } else {
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