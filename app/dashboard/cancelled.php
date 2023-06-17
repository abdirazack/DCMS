<?php
    // Connect to the database
    include_once('../database/conn.php');

    $query = "SELECT * FROM appointmentdetails WHERE status IN ('Arrived', 'In Room', 'Pending', 'Cancelled') AND end_date < NOW() ORDER BY end_date ASC LIMIT 5;";
    $result = $conn->query($query);

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
        $date = explode(" ", $row['end_date']);
        $time = $date[1];
        $date = $date[0];
        $name = $row['patient_first_name'] . " " . $row['patient_last_name'];

        $rows[] = array(
            'name' => $name,
            'date' => $date,
            'time' => $time
        );

    }

    header('Content-Type: application/json');
    echo json_encode($rows);
    return;
