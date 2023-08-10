<div class="modal fade " id="viewModal" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">More information on this record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>#SNO</th>
                            <th>Medication</th>
                            <th>Instructions</th>
                            <th>Date Prescribed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='servicetable'>
                        <?php
                        $count = 0;
                        include_once("../database/conn.php");
                        $id = $_POST['id'];
                        $query = "SELECT * FROM prescriptionview WHERE patient_id = '$id'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $count++;
                        ?>
                            <!-- Modal -->

                            <tr>
                                <td><?php echo $count; ?> </td>
                                <td><?php echo $row['medication_name']; ?> </td>
                                <td> <?php echo $row['instruction']; ?> </td>
                                <td> <?php echo $row['date_prescribed']; ?> </td>
                                <td class='text-center'>
                                    <button class='btn btn-primary' onclick="EditpatientPrescriptions(<?php echo $row['prescription_id']; ?>)"> <i class='fa fa-edit'></i> </button>
                                    <a href='#' class='btn btn-danger ms-2 mt-1' onclick="DeletepatientPrescriptions(<?php echo $row['prescription_id']; ?>)"> <i class='fa fa-trash'></i> </a>
                            </tr>


                            <?php
                        }
                            ?>

                    </tbody>
            </div>
        </div>
    </div>
</div>