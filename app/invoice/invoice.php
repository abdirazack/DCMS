<?php
// Connect to the database
include_once('./app/database/conn.php');
// Select all services from the database
$sql = "SELECT * FROM Invoice_Patients_View ";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoices List</title>
</head>

<body>
    <div class="container-fluid ">

        <div class=" mt-1 p-3 shadow-lg rounded">
            <div class='small' id='small'></div>
            <div class='d-flex justify-content-between mb-4'>
                <h2 class="text-center text-primary">Invoice List</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#InvoiceModal"> ADD NEW INVOICE</button>
            </div>
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Invoice Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each row and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = ($row["paid"] == 1) ? "Paid" : "Unpaid";
                    ?>
                        <tr>
                            <td><?php echo  $row["invoice_id"]; ?></td>
                            <td><?php echo  $row["first_name"]; ?></td>
                            <td><?php echo  $row["last_name"]; ?></td>
                            <td><?php echo  $row["total_cost"]; ?></td>
                            <td><?php echo  $status; ?></td>
                            <td><?php echo  $row["invoice_date"]; ?></td>
                            <td class='text-center'>
                                <button class='btn btn-primary' onclick='editInvoice(<?php echo  $row["invoice_id"]; ?>)'> <i class='fa fa-edit'></i> </button>
                                <a href='#' class='btn btn-danger ms-2' onclick='deleteInvoice( <?php echo  $row["invoice_id"]; ?> )'> <i class='fa fa-trash'></i> </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="InvoiceModal" aria-labelledby="InvoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="InvoiceModalLabel">New Invoice</h1>
                </div>
                <form id="formInsertUpdate" action="./app/invoice/process_invoice.php" method='POST'>
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
                            <!-- total_cost -->
                            <label for="total_cost" class="form-label text-primary">Total Cost</label>
                            <input type="number" class="form-control border border-1 border-primary" id="total_cost" name="total_cost" required>
                        </div>

                        <div class="mb-3">
                            <!-- paid -->
                            <label for="paid" class="form-label text-primary">Payment Status</label>
                            <select  class="form-control border border-1 border-primary" id="paid" name="paid" required>
                                <option value="">Select Status</option>
                                <option value="0">Unpaid</option>
                                <option value="1">Paid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <!-- invoice_date -->
                            <label for="invoice_date" class="form-label text-primary">Date Paid</label>
                            <input type="date" class="form-control border border-1 border-primary" id="invoice_date" name="invoice_date" required>
                        </div>
                        <div class="text-center">

                        </div>

                    </div>
                    <!-- modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary" onclick="insertUpdate()" id="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function editInvoice(ids) {
        var id = ids;

        $('#id').val(id);
        $.ajax({
            url: './app/invoice/getInvoice.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#formInsertUpdate select[name="patient_id"]').val(data.patient_id).trigger('change');
                $('#total_cost').val(data.total_cost);
                $('#paid').val(data.paid);
                $('#invoice_date').val(data.invoice_date);

            }

        });

        $("#submit").text('Update');
        //toggle modal
        $('#InvoiceModal').modal('show');
    }

    function deleteInvoice(id) {
        var id = id;
        $.ajax({
            url: './app/invoice/deleteInvoice.php',
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
            dropdownParent: $('#InvoiceModal')
        });

        $('#dataTable').DataTable();

        // handle form submit
        $('#formInsertUpdate').on('submit', function(e) {
            e.preventDefault();
            var id = $('#id').val();
            var patient_id = $('#patient_id').val();
            var total_cost = $('#total_cost').val();
            var paid = $('#paid').val();
            var invoice_date = $('#invoice_date').val();

            $.ajax({
                url: './app/invoice/process_invoice.php',
                type: 'POST',
                data: {
                    id: id,
                    patient_id: patient_id,
                    total_cost: total_cost,
                    paid: paid,
                    invoice_date: invoice_date
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
        });

    });

    // function insertUpdate() {
    //     $("#submit").text('Update');
    //     var id = $('#id').val();
    //     var patient_id = $('#patient_id').val();
    //     var total_cost = $('#total_cost').val();
    //     var payment_method = $('#payment_method').val();
    //     var invoice_date = $('#invoice_date').val();


    //     $.ajax({
    //         url: './app/invoice/process_invoice.php',
    //         type: 'POST',
    //         data: {
    //             id: id,
    //             patient_id: patient_id,
    //             total_cost: total_cost,
    //             paid: paid,
    //             invoice_date: invoice_date
    //         },
    //         success: function(response) {
    //             alert(response);
    //             var obj = jQuery.parseJSON(response);
    //             if (obj.status == 200) {
    //                 location.reload();
    //             } else {
    //                 alert(obj.message);
    //             }
    //         }
    //     });
    // }
</script>