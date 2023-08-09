<div class="modal fade " id="viewModal" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">More information on the record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Medication</th>
                            <th>Quantity</th>
                            <th>Dosage</th>
                            <th>Expiry Date</th>
                            <th>Prescribed Date</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='servicetable'>
                        <?php
                        include_once("../database/conn.php");
                        $id = $_POST['id'];
                        $query = "SELECT * FROM patientdrugsview WHERE patient_id = '$id'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <!-- Modal -->

                            <tr>
                                <td><?php echo $row['medication_name']; ?> </td>
                                <td> <?php echo $row['drug_quantity']; ?> </td>
                                <td> <?php echo $row['medication_dosage']; ?> </td>
                                <td> <?php echo $row['drug_expiry_date']; ?> </td>
                                <td> <?php echo $row['date_prescribed']; ?> </td>
                                <td> <?php echo $row['drug_cost']; ?> </td>
                                <td class='text-center'>
                                    <button class='btn btn-primary' onclick="EditpatientDrugs(<?php echo $row['drug_id']; ?>)"> <i class='fa fa-edit'></i> </button>
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick="DeletepatientDrugs(<?php echo $row['drug_id']; ?>)"> <i class='fa fa-trash'></i> </a>
                            </tr>


                            <?php
                        }
                            ?>

                    </tbody>
            </div>
        </div>
    </div>
</div>