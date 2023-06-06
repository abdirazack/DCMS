<?php
// Connect to the database
include_once('./app/database/conn.php');
// Select all services from the database
$sql = "SELECT * FROM Salary_Employee_View ";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Salary</title>
</head>

<body>
    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow-lg rounded">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Salary</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SalaryModal"> ADD NEW SALARY</button>
            </div>
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Salary Type</th>
                        <th>Currency</th>
                        <th>Payment Frequency</th>
                        <th>Amount</th>
                        <th>Date Paid</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each row and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo  $row["employee_id"]; ?></td>
                            <td><?php echo  $row["first_name"]; ?></td>
                            <td><?php echo  $row["last_name"]; ?></td>
                            <td><?php echo  $row["SalaryType"]; ?></td>
                            <td><?php echo  $row["Currency"]; ?></td>
                            <td><?php echo  $row["PaymentFrequency"]; ?></td>
                            <td><?php echo  $row["Amount"]; ?></td>
                            <td><?php echo  $row["datePaid"]; ?></td>
                            <td class='text-center'>
                                <button class='btn btn-primary' onclick='editSalary(<?php echo  $row["salary_id"]; ?>)'> <i class='fa fa-edit'></i> </button>
                                <a href='#' class='btn btn-danger ms-2' onclick='deleteSalary( <?php echo  $row["salary_id"]; ?> )'> <i class='fa fa-trash'></i> </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="SalaryModal" aria-labelledby="SalaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="SalaryModalLabel">New Salary</h1>
                </div>
                <form id="formInsertUpdate">
                    <div class="modal-body">

                        <!-- hidden input -->
                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <!-- Select2 for patient -->
                            <Label for="employee_id" class="form-label text-primary">Select Patient</Label> <br>
                            <select class="form-control select2" id="employee_id" name="employee_id" REQUIRED>
                                <option value="">Select Employee</option>
                                <?php
                                $query = "SELECT * FROM `employees`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['employee_id'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <!-- amount -->
                            <label for="amount" class="form-label text-primary">Amount</label>
                            <input type="number" class="form-control border border-1 border-primary" id="amount" name="amount" required>
                        </div>

                        <div class="mb-3">
                            <!-- SalaryType -->
                            <label for="SalaryType" class="form-label text-primary">Salary Type</label>
                            <input type="text" class="form-control border border-1 border-primary" id="SalaryType" name="SalaryType" required>
                        </div>
                        <div class="mb-3">
                            <!-- Currency -->
                            <label for="Currency" class="form-label text-primary">Currency</label>
                            <input type="text" class="form-control border border-1 border-primary" id="Currency" name="Currency" required>
                        </div>
                        <div class="mb-3">
                            <!-- PaymentFrequency -->
                            <label for="PaymentFrequency" class="form-label text-primary">Payment Frequency</label>
                            <input type="text" class="form-control border border-1 border-primary" id="PaymentFrequency" name="PaymentFrequency" required>
                        </div>
                        <div class="mb-3">
                            <!-- date_paid -->
                            <label for="date_paid" class="form-label text-primary">Date Paid</label>
                            <input type="date" class="form-control border border-1 border-primary" id="date_paid" name="date_paid" required>
                        </div>
                        <div class="text-center">

                        </div>

                    </div>
                    <!-- modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                        <button type="Button" class="btn btn-outline-primary" onclick="insertUpdate()" id="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function editSalary(ids) {
        var id = ids;

        $('#id').val(id);
        $.ajax({
            url: './app/salary/getSalary.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                // alert(response)
                $('#formInsertUpdate select[name="employee_id"]').val(data.employee_id).trigger('change');
                $('#amount').val(data.Amount);
                $('#SalaryType').val(data.SalaryType);
                $('#Currency').val(data.Currency);
                $('#PaymentFrequency').val(data.PaymentFrequency);
                $('#date_paid').val(data.date_paid);

            }

        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#SalaryModal').modal('hide');
            });
            // Show the modal
            $('#SalaryModal').modal('show');
        });
    }

    function deleteSalary(id) {
        var id = id;
        $.ajax({
            url: './app/salary/deleteSalary.php',
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


        $('#employee_id').select2({
            dropdownParent: $('#SalaryModal')
        });

        $('#dataTable').DataTable();

    });

    function insertUpdate() {
        $("#submit").text('Update');
        var id = $('#id').val();
        var employee_id = $('#employee_id').val();
        var amount = $('#amount').val();
        var SalaryType = $('#SalaryType').val();
        var Currency = $('#Currency').val();
        var PaymentFrequency = $('#PaymentFrequency').val();
        var date_paid = $('#date_paid').val();


        $.ajax({
            url: './app/salary/process_salary.php',
            type: 'POST',
            data: {
                id: id,
                employee_id: employee_id,
                Amount: amount,
                SalaryType: SalaryType,
                Currency: Currency,
                PaymentFrequency: PaymentFrequency,
                date_paid: date_paid
            },
            success: function(response) {
                // alert(response);
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