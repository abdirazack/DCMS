<table class="table table-hover" id="dataTable">
    <caption class="text-white fs-3">Expenses Report</caption>
    <thead class="thead-dark text-truncate">
        <th data-field="id">ID</th>
        <th data-field="expense_type" data-sortable="true">Expense Type</th>
        <th data-field="description" data-sortable="true">Description</th>
        <th data-field="amount" data-sortable="true">Amount</th>
        <th data-field="quantity" data-sortable="true">Quantity</th>
        <th data-field="date" data-sortable="true">Date</th>
    </thead>
    <tbody>
        <?php
        include_once("../database/conn.php");
        $query = "
            SELECT
                e.expense_id,
                'Regular Expense' AS expense_type,
                et.expense_type AS description,
                e.amount,
                e.quantity,
                e.date
            FROM
                expenses e
            JOIN
                expense_types et ON e.expense_type = et.expense_type_id

            UNION ALL

            SELECT
                s.salary_id AS expense_id,
                'Salary' AS expense_type,
                CONCAT('Salary for ', emp.first_name, ' ', emp.last_name) AS description,
                s.amount,
                1 AS quantity,
                s.datePaid AS date
            FROM
                salary s
            JOIN
                employees emp ON s.employee_id = emp.employee_id
        ";

        $result = mysqli_query($conn, $query);
        $total_amount = 0;

        while ($row = mysqli_fetch_array($result)) {
            $total_amount += $row['amount'];
        ?>
            <tr class="text-dark text-truncate">
                <td><?php echo $row['expense_id']; ?></td>
                <td><?php echo $row['expense_type']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['date']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align:right">Total:</th>
            <th colspan="3"><?php echo $total_amount; ?></th>
        </tr>
    </tfoot>
</table>

<script>
    $(document).ready(function () {
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
