<?php
    // Connect to the database
    include_once('../database/conn.php');

    $query = "SELECT 
    CONCAT(patients.first_name, ' ', patients.last_name) AS patient_name,
    DATE(appointments.start_date) AS appointment_date,
    TIME(appointments.start_date) AS appointment_time,
    appointments.status
FROM 
    appointments
INNER JOIN 
    patients ON appointments.patient_id = patients.patient_id
WHERE 
    appointments.status = 'pending';
";

    $result = $conn->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Could not query the database: <br />" . $conn->error);
    }

    $rows = array(); // Array to store rows
    // if number of rows is 0, add a row to the array with a message
if($result->num_rows == 0) {
    $rows[] = array(
        'name' => "No upcoming appointments",
        'date' => "",
        'time' => ""
    );
}
while ($row = $result->fetch_assoc()) {


    // Split the date and time
    $date = $row['appointment_date'];
    $time = $row['appointment_time'];
    $name = $row['patient_name'];

    $rows[] = array(
        'name' => $name,
        'date' => $date,
        'time' => $time
    );

}

header('Content-Type: application/json');
echo json_encode($rows);
return;
    
    ?>