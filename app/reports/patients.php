<table class="table table-hover text-white" id="dataTable">
    <caption class="text-white fs-3">Patients Report</caption>
    <thead class="thead-dark">
        <th data-field="id">Patient ID</th>
        <th data-field="first name" data-sortable="true">First Name</th>
        <th data-field="last name" data-sortable="true">Last Name</th>
        <th data-field="Phone" data-sortable="true">Phone</th>
        <th data-field="gender" data-sortable="true">Gender</th>
        <th data-field="birth_date">Birth Date</th>
        <th data-field="street">Street</th>
        <th data-field="state">State</th>
        <th data-field="City">City</th>
    </thead>
    <tbody>
        <?php
        include_once("../database/conn.php");
        $query = "SELECT * FROM `addresses_patients_view`";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr class="text-dark text-truncate">
                <td><?php echo $row['patient_id'] ;?></td>
                <td><?php echo $row['first_name'] ;?></td>
                <td><?php echo $row['last_name'] ;?></td>
                <td><?php echo $row['phone_number'] ;?></td>
                <td><?php echo $row['gender'] ;?></td>
                <td><?php echo $row['birth_date'] ;?></td>
                <td><?php echo $row['street'] ;?></td>
                <td><?php echo $row['state'] ;?></td>
                <td><?php echo $row['city'] ;?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#dataTable').DataTable({
            dom: 'Bfrtip', // Add buttons to the DataTables' DOM
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print' // Add export buttons
            ],
            // You can add other DataTable options here
        });
    });
</script>