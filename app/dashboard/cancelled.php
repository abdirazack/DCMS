<?php
    // Connect to the database
    include_once('../database/conn.php');

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
    a.status = 'Cancelled'
    OR (
        a.status IN ('Approved', 'Pending')
        AND (
            a.date < CURDATE()
            OR (a.date = CURDATE() AND a.time <= CURTIME())
        )
    )
ORDER BY
    a.date, a.time;
";
    $result = $conn->query($query);

    $rows = array(); // Array to store rows
        // if number of rows is 0, add a row to the array with a message
    if($result->num_rows == 0) {
        $rows[] = array(
            'appointment_id' => '0',
            'name' => "No cancelled appointments",
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