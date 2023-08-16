<?php
// patient/changePass.php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('status' => 'error', 'statusCode' => 405, 'message' => 'Invalid request method.'));
    exit;
}

$connection = mysqli_connect('localhost', 'root', '', 'dental_clinic');

// Check if the connection was successful
if (!$connection) {
    $response = [
        'statusCode' => 500,
        'status' => 'error',
        'message' => 'Error connecting to the database: ' . mysqli_connect_error(),
    ];
    header('Content-Type: application/json', true, 500);
    echo json_encode($response);
    exit;
}

$currentPassword = mysqli_real_escape_string($connection, $_POST['current_pass']);
$newPassword = mysqli_real_escape_string($connection, $_POST['new_pass']);

// You might want to add additional validation and security measures here before changing the password.
// For example, checking if the user is authenticated and authorized to change the password.

// Check if the current password is correct
$checkQuery = "SELECT * FROM patients WHERE password = ?";
$checkStatement = $connection->prepare($checkQuery);
$checkStatement->bind_param("s", $currentPassword);
$checkStatement->execute();
$result = $checkStatement->get_result();

if (!$result || $result->num_rows === 0) {
    $response = [
        'statusCode' => 400,
        'status' => 'errorPass',
        'message' => 'Incorrect current password.',
    ];
    header('Content-Type: application/json', true, 400);
    echo json_encode($response);
    exit;
}

// Update the password
$updateQuery = "UPDATE patients SET password = ? WHERE password = ?";
$updateStatement = $connection->prepare($updateQuery);
$updateStatement->bind_param("ss", $newPassword, $currentPassword);

if ($updateStatement->execute()) {
    $response = [
        'status' => 'success',
        'statusCode' => 200,
        'message' => 'Password changed successfully.',
        "newPass" => "$newPassword"
    ];
    header('Content-Type: application/json', true, 200);
} else {
    $response = [
        'status' => 'error',
        'statusCode' => 500,
        'message' => 'Failed to update password: ' . $updateStatement->error,
    ];
    header('Content-Type: application/json', true, 500);
}

// Close the database connection
$connection->close();

// Send the response back
echo json_encode($response);
exit;
