<table class="table table-hover " id="dataTable">
    <caption class="text-secondary fs-1">Patients Report</caption>
    <thead class="thead-dark">
        <th data-field="id">Patient ID</th>
        <th data-field="first name" >First Name</th>
        <th data-field="last name" >Last Name</th>
        <th data-field="Phone" >Phone</th>
        <th data-field="gender" >Gender</th>
        <th data-field="birth_date">Birth Date</th>
        <th data-field="street">Street</th>
        <th data-field="state">State</th>
        <th data-field="City">City</th>
    </thead>
    <tbody>
        <?php
            $from_date  = $_POST['f_date'];
            $to_date    = $_POST['t_date'];
        include_once("../../database/conn.php");
        $query = "SELECT * FROM `addresses_patients_view` where created_at between '$from_date' and '$to_date'";
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

