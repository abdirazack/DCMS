<table class="table table-hover" id="dataTable">
    <caption class="text-white fs-3">Appointment Summary Report</caption>
    <thead class="thead-dark text-truncate">
        <th data-field="appointment_date" data-sortable="true">Date</th>
        <th data-field="total_appointments" data-sortable="true">Total Appointments</th>
        <th data-field="approved_appointments" data-sortable="true">Approved Appointments</th>
        <th data-field="pending_appointments" data-sortable="true">Pending Appointments</th>
        <th data-field="cancelled_appointments" data-sortable="true">Cancelled Appointments</th>
        <th data-field="completed_appointments" data-sortable="true">Completed Appointments</th>
    </thead>
    <tbody>
        <?php
        include_once("../database/conn.php");
        $query = "SELECT
            DATE(a.date) AS appointment_date,
            COUNT(*) AS total_appointments,
            SUM(CASE WHEN a.status = 'Approved' THEN 1 ELSE 0 END) AS approved_appointments,
            SUM(CASE WHEN a.status = 'Pending' THEN 1 ELSE 0 END) AS pending_appointments,
            SUM(CASE WHEN a.status = 'Cancelled' THEN 1 ELSE 0 END) AS cancelled_appointments,
            SUM(CASE WHEN a.status = 'Completed' THEN 1 ELSE 0 END) AS completed_appointments
        FROM
            appointments a
        WHERE
            a.date >= CURDATE()
        GROUP BY
            DATE(a.date)
        ORDER BY
            appointment_date";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr class="text-dark text-truncate">
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['total_appointments']; ?></td>
                <td><?php echo $row['approved_appointments']; ?></td>
                <td><?php echo $row['pending_appointments']; ?></td>
                <td><?php echo $row['cancelled_appointments']; ?></td>
                <td><?php echo $row['completed_appointments']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

