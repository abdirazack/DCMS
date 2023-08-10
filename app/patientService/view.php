<div class="modal fade" id="viewModal" aria-labelledby="viewModalLabel" aria-hidden="true">
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
                            <th>#SNO</th>
                            <th>Service</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='servicetable'>
                        <?php
                        $count = 0;
                        include_once("../database/conn.php");
                        $id = $_POST['id'];
                        $query = "SELECT * FROM patientservicesview WHERE patient_id = '$id'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $count++;
                        ?>
                            <!-- Modal -->

                            <tr>
                                <td><?php echo $count; ?> </td>
                                <td><?php echo $row['service_name']; ?> </td>
                                <td> <?php echo $row['quantity']; ?> </td>
                                <td> <?php echo $row['cost']; ?> </td>
                                <td class="text-center">
                                    <button class="btn btn-primary " onclick="EditpatientService(<?php echo $row['patientService_id']; ?>)" name="edit" id="edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger" onclick="DeletepatientService(<?php echo $row['patientService_id']; ?>)" name="delete" id="delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>

                            <?php
                        }
                            ?>

                    </tbody>
            </div>
        </div>
    </div>
</div>