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

    <div class="container  border border-secondary rounded m-1">
        <form action="">
            <div class="row">
                <div class="card p-5">
                    <h3>Patients List</h3>
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
            </div>
            <div class="col" id="display">
                <div class="row">
                    <div class="card  p-2 d-flex flex-row align-items-center justify-content-between">
                        <div class="ms-2">
                            <label for="service_id" class="form-label ">Service</label> <br>
                            <select class="form-control select2" id="service_id" name="service_id" REQUIRED>
                                <option value="">Select Service</option>
                                <?php
                                $query = "SELECT * FROM `services`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['service_id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="quantity" class="form-label ">Quantity</label>
                            <input type="number" class="form-control " id="quantity" name="quantity" REQUIRED>
                        </div>
                        <div>
                            <label for="cost" class="form-label ">Cost</label>
                            <input type="number" class="form-control " id="cost" name="cost" REQUIRED>
                        </div>
                        <div>
                            <!-- <label for="cost" class="form-label ">Amount</label> -->
                            <button class="btn btn-secondary mt-4 me-2" name="addNewRec" id="addNewRec">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row m-3 text-center">
                <div class="col">
                    <button class="btn btn-primary " name="submit" id="submit">SAVE</button>
                </div>
            </div>
        </form>
    </div>



    <script>
        $(document).ready(function() {
            $('.select2').select2();
            // make the width of select2 service 100
            // $('#service_id').css('width', '100%');

            // When someone clicks on the add button, create a new col and append it to the row and change the add icon to remove icon  

            $('#addNewRec').click(function() {

                var new_col = "<div class='row'><div class='card  p-2 d-flex flex-row align-items-center justify-content-between'><div class='ms-2'><label for='service_id' class='form-label '>Service</label> <br><select class='form-control select2' id='service_id' name='service_id' REQUIRED><option value=''>Select Service</option><?php $query = 'SELECT * FROM `services`';
                                                                                                                                                                                                                                                                                                                                            $result = mysqli_query($conn, $query);
                                                                                                                                                                                                                                                                                                                                            while ($row = mysqli_fetch_array($result)) {
                                                                                                                                                                                                                                                                                                                                                echo '<option value=' . $row['service_id'] . '>' . $row['name'] . '</option>';
                                                                                                                                                                                                                                                                                                                                            } ?></select></div><div ><label for='quantity' class='form-label '>Quantity</label><input type='number' class='form-control ' id='quantity' name='quantity' REQUIRED></div><div ><label for='cost' class='form-label '>Cost</label><input type='number' class='form-control ' id='cost' name='cost' REQUIRED></div><div ><button class='btn btn-danger mt-4 me-2' name='removeRec' id='removeRec'><i class='fas fa-minus'></i></button></div></div></div>";
                $('#display').append(new_col);
                $('.select2').select2();
            });

            // When someone clicks on the remove button, remove the col and change the remove icon to add icon
            $('#display').on('click', '#removeRec', function() {
                $(this).closest('.row').remove();
            });

        });
    </script>