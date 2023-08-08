<?php

// Ensure this is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('statusCode' => 405, 'status' => 'error', 'message' => 'Method Not Allowed'));
    exit();
}

// Connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'dental_clinic');

// Check connection
if (!$connection) {
    $response['statusCode'] = 500;
    $response['status'] = 'error';
    $response['message'] = 'Database connection error';
    echo json_encode($response);
    exit();
}

// Get appointment ID to update
$appointment_id = $_POST['appointment_id'];

// Validate and sanitize input
$appointment_id = $_POST['appointment_id'];
$type = $_POST['type'] ?? "Online";
$status = $_POST['status'] ?? 'Pending';
$date = $_POST['date'];
$time = $_POST['time'];
$patientId = $_POST['patient_id'];
$note = $_POST['note'];

// Check for conflicting appointments
$checkQuery = "SELECT * FROM appointments 
    WHERE date = '$date' 
    AND (time = '$time' OR time = DATE_ADD('$time', INTERVAL 10 MINUTE) OR time = DATE_SUB('$time', INTERVAL 10 MINUTE))";
$result = $connection->query($checkQuery);

if ($result && $result->num_rows > 0) {
    $response['statusCode'] = 400;
    $response['status'] = 'errorT';
    $response['message'] = 'Time has already been appointed.';
    echo json_encode($response);
    exit();
}

// Update query
$query = "UPDATE appointments 
          SET Type='$type', 
              status='$status',
              date='$date',
              time='$time', 
              patient_id='$patientId',
              note='$note'
          WHERE appointment_id='$appointment_id'";

// Execute update query
if ($connection->query($query) === TRUE) {
    $response['statusCode'] = 200;
    $response['status'] = 'success';
    $response['message'] = 'Appointment updated successfully';
} else {
    $response['statusCode'] = 500;
    $response['status'] = 'error';
    $response['message'] = 'Error updating appointment: ' . $connection->error;
}

// Close the database connection
mysqli_close($connection);

// Return response
echo json_encode($response);
