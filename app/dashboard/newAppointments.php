<?php
    // Replace with your database credentials
    $host = 'localhost';
    $dbname = 'dental_clinic';
    $username = 'root';
    $password = '';

    $conn = new mysqli($host, $username, $password, $dbname);

    $query = "SELECT
    a.appointment_id,
    CONCAT(p.first_name, ' ', p.last_name) AS patient_name,
    a.date,
    a.time
FROM
    appointments a
JOIN
    patients p ON a.patient_id = p.patient_id
WHERE
    a.status = 'Pending'
    AND (a.date > CURDATE() OR (a.date = CURDATE() AND a.time > CURTIME()))
ORDER BY
    a.date, a.time;
";

    $result = $conn->query($query);

    // Check if the query was successful
    if (!$result) {
        echo "Could not successfully run query ($query) from DB: " . $conn->error;
        die("Could not query the database: <br /> . $conn->connect_error");
    }

    $rows = array(); // Array to store rows
    // if number of rows is 0, add a row to the array with a message
if($result->num_rows == 0) {
    $rows[] = array(
        'appointment_id' => '0',
        'name' => "No Pending appointments",
        'date' => "",
        'time' => ""
    );
}
while ($row = $result->fetch_assoc()) {


    // Split the date and time
    $appointment_id = $row['appointment_id'];
    $date = $row['date'];
    $time = $row['time'];
    $name = $row['patient_name'];

    $rows[] = array(
        'appointment_id' => $appointment_id,
        'name' => $name,
        'date' => $date,
        'time' => $time
    );

}

header('Content-Type: application/json');
echo json_encode($rows);
return;
    
?>