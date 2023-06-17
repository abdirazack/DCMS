<?php
// Connect to the database
include_once('./app/database/conn.php');
// Select all services from the database
$sql = "SELECT * FROM Payments_Patients_View ";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Payments</title>
</head>

<body>
    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow-lg rounded">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Payments</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#PaymentsModal">
                <i class="fa-solid fa-plus "></i>
                    </button>
            </div>
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                    <th scope="col">#NO</th>

                        <!-- <th>Payments ID</th> -->
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Amount</th>
                        <th>Amount Paid</th>
                        <th>Amount Due</th>
                        <th>Description</th>
                        <th>Payment Method</th>
                        <th>Date Paid</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    // Loop through each row and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo  $row["first_name"]; ?></td>
                            <td><?php echo  $row["last_name"]; ?></td>
                            <td><?php echo  $row["amount"]; ?></td>
                            <td><?php echo  $row["amount_paid"]; ?></td>
                            <td><?php echo  $row["amount_due"]; ?></td>
                            <td><?php echo  $row["description"]; ?></td>
                            <td><?php echo  $row["payment_method"]; ?></td>
                            <td><?php echo  $row["date_paid"]; ?></td>
                            <td class='text-center'>
                                <button class='btn btn-primary' onclick='editPayment(<?php echo  $row["payment_id"]; ?>)'> <i class='fa fa-edit'></i> </button>
                                <a href='#' class='btn btn-danger ms-2' onclick='deletePayment( <?php echo  $row["payment_id"]; ?> )'> <i class='fa fa-trash'></i> </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="PaymentsModal" aria-labelledby="PaymentsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="PaymentsModalLabel">New Payments</h1>
                </div>
                <form id="formInsertUpdate">
                    <div class="modal-body">

                        <!-- hidden input -->
                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <!-- Select2 for patient -->
                            <Label for="patient_id" class="form-label text-primary">Select Patient</Label> <br>
                            <select class="form-control select2" id="patient_id" name="patient_id" REQUIRED>
                                <option value="">Select Patient</option>
                                <?php
                                $query = "SELECT * FROM `patients`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['patient_id'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
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
                            <!-- amount_paid -->
                            <label for="amount_paid" class="form-label text-primary">Amount Paid</label>
                            <input type="number" class="form-control border border-1 border-primary" id="amount_paid" name="amount_paid" required>
                        </div>
                        <div class="mb-3">
                            <!-- description -->
                            <label for="description" class="form-label text-primary">Description</label>
                            <input type="text" class="form-control border border-1 border-primary" id="description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <!-- payment_method -->
                            <label for="payment_method" class="form-label text-primary">Payment Method</label>
                            <input type="text" class="form-control border border-1 border-primary" id="payment_method" name="payment_method" required>
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
    function editPayment(ids) {
        var id = ids;

        $('#id').val(id);
        $.ajax({
            url: './app/payments/getPayment.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#formInsertUpdate select[name="patient_id"]').val(data.patient_id).trigger('change');
                $('#amount').val(data.amount);
                $('#amount_paid').val(data.amount_paid);
                $('#description').val(data.description);
                $('#payment_method').val(data.payment_method);
                $('#date_paid').val(data.date_paid);

            }

        });

        $("#submit").text('Update');
        $(document).ready(function() {
            $('#closeButton').on('click', function() {
                // Close the modal
                $('#PaymentsModal').modal('hide');
            });
            // Show the modal
            $('#PaymentsModal').modal('show');
        });
    }

    function deletePayment(id) {
        var id = id;
        $.ajax({
            url: './app/payments/deletePayment.php',
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


        $('#patient_id').select2({
            dropdownParent: $('#PaymentsModal')
        });

        $('#dataTable').DataTable();

    });

    function insertUpdate() {
        $("#submit").text('Update');
        var id = $('#id').val();

        var patient_id = $('#patient_id').val();
        var amount = $('#amount').val();
        var amount_paid = $('#amount_paid').val();
        var description = $('#description').val();
        var payment_method = $('#payment_method').val();
        var date_paid = $('#date_paid').val();


        $.ajax({
            url: './app/payments/process_payment.php',
            type: 'POST',
            data: {
                id: id,
                patient_id: patient_id,
                amount: amount,
                amount_paid: amount_paid,
                description: description,
                payment_method: payment_method,
                date_paid: date_paid
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
</script>