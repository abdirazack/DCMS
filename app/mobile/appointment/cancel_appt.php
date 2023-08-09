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

// Update query
$query = "UPDATE appointments SET status='Cancelled' WHERE appointment_id='$appointment_id'";

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
