<?php
    // Connect to the database
    include_once('../database/conn.php');

    $query = "SELECT * FROM appointmentdetails WHERE  date >= CURRENT_DATE ORDER BY date ASC LIMIT 5;";
    $result = $conn->query($query);

    $rows = array(); // Array to store rows
        // if number of rows is 0, add a row to the array with a message
    if($result->num_rows == 0) {
        $rows[] = array(
            'appointment_id' => '0',    
            'name' => "No upcoming appointments",
            'date' => "",
            'time' => ""
        );
    }
    while ($row = $result->fetch_assoc()) {

        $appointment_id = $row['appointment_id'];
        $time = $row['time'];
        $date = $row['date'];
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