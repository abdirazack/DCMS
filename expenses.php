<?php
include_once('header.php');
include_once('conn.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Services</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100 rounded">
        <div class="row shadow-lg vw-100 rounded">
            <div class="col-md-8">
                <h1 class="text-center text-primary">Expenses</h1>
                <table class="table table-hover" id="dataTable">
                    <thead>
                        <tr>
                            
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Select all services from the database
                        $sql = "SELECT * FROM expenses";
                        $result = mysqli_query($conn, $sql);

                        // Loop through each row and display the data in the table
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . $row["amount"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editExpenses(" . $row['expense_id'] . ")'> EDIT </button> 
                                    <a href='#' class='btn btn-danger ms-2' onclick='deleteExpense(" . $row['expense_id'] . ")'> DELETE </a> 
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
                        <h1 class="card-title text-center text-primary fs-5">New Expense</h1>
                        <form action="services/process_service.php" method="post" id="formInsertUpdate">
                            <!-- hidden input -->
                            <input type="hidden" name="id" id="id">
                            
                            <div class="mb-3">
                                <label for="description" class="form-label text-primary">Description</label>
                                <textarea class="form-control border border-1 border-primary" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="fee" class="form-label text-primary">Amount</label>
                                <input type="number" class="form-control border border-1 border-primary" id="amount" name="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label text-primary ">Service Name</label>
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
                var data = JSON.parse(response);
                $('#date').val(data.date);
                $('#description').val(data.description);
                $('#amount').val(data.amount);
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
                url: 'expenses/process_expense.php',
                type: 'POST',
                data: formData,
                success: function(response) {
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