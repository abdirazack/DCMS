<table class="table table-hover text-white" id="dataTable">
    <caption class="text-white fs-3">Employees Report</caption>
    <thead class="text-dark text-truncate">
        <th data-field="id">ID</th>
        <th data-field="first name" data-sortable="true">First Name</th>
        <th data-field="last name" data-sortable="true">Last Name</th>
        <th data-field="service_name" data-sortable="true">Service Name</th>
        <th data-field="IncomeType" data-sortable="true">Income Type</th>
        <th data-field="IncomeAmount" data-sortable="true">Income Amount</th>
        <th data-field="IncomeAmountPaid" data-sortable="true">Income Amount Paid</th>
        <th data-field="IncomeDate">Income Date</th>
    </thead>
    <tbody>
        <?php
        include_once("../database/conn.php");
        $query = "SELECT
        i.IncomeID, 
        i.IncomeType,
        i.IncomeAmount,
        i.IncomeDate,
        p.first_name,
        p.last_name,
        s.name,
        i.IncomeAmountPaid
      FROM incometable i
      JOIN patients p ON i.patient_id = p.patient_id
      LEFT JOIN patientservices ps ON p.patient_id = ps.patient_id
      LEFT JOIN services s ON s.service_id = ps.service_id
      ";
        $result = mysqli_query($conn, $query);
        $total_amount = 0;
        $total_amount_paid = 0;

        while ($row = mysqli_fetch_array($result)) {
            $total_amount += $row['IncomeAmount'];
            $total_amount_paid += $row['IncomeAmountPaid'];
        ?>
            <tr class="text-dark text-truncate">
                <td><?php echo $row['IncomeID'] ;?></td>
                <td><?php echo $row['first_name'] ;?></td>
                <td><?php echo $row['last_name'] ;?></td>
                <td><?php echo $row['name'] ;?></td>
                <td><?php echo $row['IncomeType'] ;?></td>
                <td><?php echo $row['IncomeAmount'] ;?></td>
                <td><?php echo $row['IncomeAmountPaid'] ;?></td>
                <td><?php echo $row['IncomeDate'] ;?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5" style="text-align:right">Total:</th>
            <th><?php echo $total_amount; ?></th>
            <th><?php echo $total_amount_paid; ?></th>
            <th></th>
        </tr>
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