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
$sql = "SELECT * 
FROM appointments 
WHERE patient_id = $patientId
  AND (status = 'Pending' OR status = 'Approved') 
  AND date >= CURDATE() 
ORDER BY date ASC, time ASC 
LIMIT 5";
$result = $conn->query($sql);

$appointments = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = array(
            'appointment_id' => $row['appointment_id'],
            'type' => $row['Type'],
            'status' => $row['status'],
            'date' => $row['date'],
            'time' => $row['time'],
            'patient_id' => $row['patient_id'],
            'employee_id' => $row['employee_id'],
            'note' => $row['note']
        );
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
