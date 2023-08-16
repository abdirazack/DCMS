<table class="table table-hover " id="dataTable">
    <caption class=" fs-3">Employees Report</caption>
    <thead class="thead-dark text-truncate">
        <th data-field="id">Employee ID</th>
        <th data-field="first name" data-sortable="true">First Name</th>
        <th data-field="last name" data-sortable="true">Last Name</th>
        <th data-field="Email" data-sortable="true">Email</th>
        <th data-field="Phone" data-sortable="true">Phone</th>
        <th data-field="Phone" data-sortable="true">Salary Type</th>
        <th data-field="Phone" data-sortable="true">Amount</th>
        <th data-field="Role">Role</th>
    </thead>
    <tbody>
        <?php
        include_once("../database/conn.php");
        $query = "SELECT
        e.employee_id,
        e.first_name,
        e.last_name,
        e.email,
        e.phone,
        r.role_name,
        e.salary_type,
        e.amount
      FROM employees e
      JOIN roles r ON e.role_id = r.role_id
      LEFT JOIN salary s ON e.employee_id = s.employee_id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr class="text-dark text-truncate">
                <td><?php echo $row['employee_id'] ;?></td>
                <td><?php echo $row['first_name'] ;?></td>
                <td><?php echo $row['last_name'] ;?></td>
                <td><?php echo $row['email'] ;?></td>
                <td><?php echo $row['phone'] ;?></td>
                <td><?php echo $row['salary_type'] ;?></td>
                <td><?php echo $row['amount'] ;?></td>
                <td><?php echo $row['role_name'] ;?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

