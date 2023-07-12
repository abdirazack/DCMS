<div class="modal fade" id="viewModal" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody id='servicetable'>
                        <?php
                        include_once("../database/conn.php");
                        $id = $_POST['id'];
                        $query = "SELECT * FROM patientservicesview WHERE patient_id = '$id'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <!-- Modal -->

                            <tr>
                                <td><?php echo $row['service_name']; ?> </td>
                                <td> <?php echo $row['quantity']; ?> </td>
                                <td> <?php echo $row['cost']; ?> </td>


                            <?php
                        }
                            ?>

                    </tbody>
            </div>

        </div>
    </div>
</div>