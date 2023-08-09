<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = [
        'statusCode' => 405,
        'status' => 'error',
        'data' => 'Method Not Allowed',
    ];
    echo json_encode($response);
    exit;
}

// Create a connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic');

// Check if the connection was successful
if (!$conn) {
    $response = [
        'statusCode' => 500,
        'status' => 'error',
        'data' => 'Error connecting to the database: ' . mysqli_connect_error(),
    ];
    echo json_encode($response);
    exit;
}

// Assuming you have a patient ID to retrieve appointments for
$patientId = $_POST['patient_id'] ?? 1;

// Fetch the top 3 upcoming appointments for the patient
$sql = "SELECT
appointments.appointment_id,
CONCAT(patients.first_name, ' ', patients.middle_name, ' ', patients.last_name) as patient,
appointments.patient_id,
CONCAT(employees.first_name, ' ', employees.middle_name, ' ', employees.last_name) as dentist,
employees.employee_id,
appointments.date,
appointments.time,
appointments.note,
appointments.type,
appointments.status
FROM
appointments
JOIN
employees ON appointments.employee_id = employees.employee_id
JOIN
patients ON appointments.patient_id = patients.patient_id
WHERE
appointments.patient_id = '$patientId'
AND (appointments.status = 'Pending' OR appointments.status = 'Approved')
AND appointments.date >= CURDATE()
ORDER BY
appointments.date ASC, appointments.time ASC
LIMIT 5;
";
$result = $conn->query($sql);

$appointments = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'appointment_id' => $row['appointment_id'],
            'type' => $row['type'],
            'status' => $row['status'],
            'date' => $row['date'],
            'time' => $row['time'],
            'patient_id' => $row['patient_id'],
            'employee_id' => $row['employee_id'],
            'note' => $row['note'],
            'patient' => $row['patient'],
            'dentist' => $row['dentist']
        ];
    }

    $response = [
        'statusCode' => 200,
        'status' => 'success',
        'data' => $appointments,
    ];
} else {
    $response = [
        'statusCode' => 404,
        'status' => 'error',
        'data' => 'No upcoming appointments found.',
    ];
}

// Close the database connection
$conn->close();

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
