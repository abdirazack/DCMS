<!DOCTYPE html>
<html>

<head>
    <title>Staff Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once('./app/database/conn.php');
    ?>
</head>

<body>

    <div class="container p-3 rounded shadow bg-white overflow-auto">
        <form id="formPS" class="m-2">
            <div>
                <h3 class="text-center">Patient Drugs</h3>
            </div>
            <div class="row m-5">
                <!-- hidden id input -->
                <input type="hidden" name="id" id="id">
                <label for="patient_id" class="form-label ">Patient Name</label>
                <select class="form-control select2" id="patient_id" name="patient_id" REQUIRED>
                    <option value="">Select Patient</option>
                    <?php
                    $query = 'SELECT * FROM `patients`';
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value=' . $row['patient_id'] . '>' . $row['first_name'] . ' ' . $row['last_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="input-field">
                <table class="table table-bordered" id="medicationtable">
                    <thead>
                        <tr>
                            <th scope="col">Medication</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Expiry date</th>
                            <th scope="col">Prescribed date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control select2" id="medication_id" name="medication_id[]" REQUIRED>
                                    <option value="">Select Service</option>
                                    <?php
                                    $query = 'SELECT * FROM `medications`';
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value=' . $row['medication_id'] . '>' . $row['medication_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="number" class="form-control" id="quantity" name="quantity[]" REQUIRED></td>
                            <td><input type="number" class="form-control" id="cost" name="cost[]" REQUIRED></td>
                            <td><input type="date" class="form-control" id="expiry_date" name="expiry_date[]" REQUIRED></td>
                            <td><input type="date" class="form-control" id="prescribed_date" name="prescribed_date[]" REQUIRED></td>
                            <td><button class="btn btn-warning" name="addNewRec" id="addNewRec"><i class="fas fa-plus"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <CENTER>
                <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
            </CENTER>
        </form>

        <!-- display area -->
        <div id="display">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr>
                    <th scope="col">#NO</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Total Medicine Taken</th>

                    <th> Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    $query = 'SELECT * FROM `patient_drugs_view` group by patient_id';
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;
?>          
                        <tr>
                        <td> <?php echo $count ?></td>
                        <td> <?php echo $row['first_name']?> </td>
                        <td> <?php echo $row['last_name'] ?></td>
                        <td> <?php echo $row['medication_name'] ?></td>
                        <td class="text-center"> 
                            <button class="btn btn-primary me-5" onclick="ViewpatientDrugs(<?php echo $row['patient_id']; ?>)" name='view' id='view'>
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-primary me-5" onclick="EditpatientDrugs(<?php echo $row['drug_id']; ?>)" name="edit" id="edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" onclick="DeletepatientDrugs(<?php echo $row['drug_id']; ?>)" name="delete" id="delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <script>
        //   
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

            var html = '';
            // When someone clicks on the add button, create a new col and append it to the row and change the add icon to remove icon  
            html += '<tr>';
            html += '<td><select class="form-control select2" id="medication_id" name="medication_id[]" REQUIRED><option value="">Select Service</option><?php $query = "SELECT * FROM `medications`";
                                                                                                                                                    $result = mysqli_query($conn, $query);
                                                                                                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                                                                                                        echo "<option value=" . $row["medication_id"] . ">" . $row["medication_name"] . "</option>";
                                                                                                                                                    } ?></select></td>';
            html+= "<td><input type='number' class='form-control' id='quantity' name='quantity[]' REQUIRED></td>";
            html+= "<td><input type='number' class='form-control' id='cost' name='cost[]' REQUIRED></td>";
            html+= "<td><input type='date' class='form-control' id='expiry_date' name='expiry_date[]' REQUIRED></td>";
            html+= '<td><input type="date" class="form-control" id="prescribed_date" name="prescribed_date[]" REQUIRED></td>';
            html += '<td><button class="btn btn-danger" name="removeRec" id="removeRec"><i class="fas fa-minus"></i></button></td>';
            html += '</tr>';

            $('#addNewRec').click(function() {

                // append the new row to the table
                $('#medicationtable').append(html);
                $('.select2').select2();
                // $('.select2').removeAttr('select2-hidden-accessible');
            });

            // When someone clicks on the remove button, remove the col and change the remove icon to add icon
            $("#medicationtable").on('click', '#removeRec', function() {
                $(this).closest('tr').remove();
            });

            //on submit
            $('#formPS').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "./app/drugs/process_drug.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        // alert(data);
                        location.reload();
                    },
                    error: function(data) {
                        alert(data);
                    }
                });
            });


        });
        //on delete
        function DeletepatientDrugs(id) {
            id = id;
            $.ajax({
                url: "./app/drugs/deleteDrug.php",
                method: "POST",
                data: {
                    deleteid: id
                },
                success: function(data) {
                    // alert(data);
                    console.log(data);
                    obj = JSON.parse(data);
                    if (obj.status == 200) {
                        // alert(obj.message);
                        location.reload();
                    } else {
                        alert(obj.message);
                    }
                }
            });
        }

        //on edit
        function EditpatientDrugs(id) {
            id = id;
            $.ajax({
                url: "./app/drugs/getDrug.php",
                method: "POST",
                data: {
                    updateid: id
                },
                success: function(data) {
                    // alert(data);
                    console.log(JSON.parse(data));
                    var obj = JSON.parse(data);
                    $('#id').val(obj.drug_id);
                    $('#formPS  select[name="patient_id"]').val(obj.patient_id).trigger('change');
                    $('#formPS  select[name="medication_id[]"]').val(obj.medication_id).trigger('change');
                    $('#quantity').val(obj.drug_quantity);
                    $('#cost').val(obj.drug_cost);
                    $('#expiry_date').val(obj.drug_expiry_date);
                    $('#prescribed_date').val(obj.date_prescribed);
                    $('#submit').html('Update');
                }
            });

        }
        //on view
        function ViewpatientDrugs(id) {
            id = id;
            // create a small pop up modal to show the details of the patientService
            $.ajax({
                url: "./app/drugs/view.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    // alert(data);
                    // to show the modal
                    $('#modalDisplay').html(data);
                    $('#viewModal').modal('show');
                }
            });

        }
    </script>

<div id='modalDisplay' class="container-fluid">

</div>

<!-- Q: Do you see any unclosed brackets? -->
