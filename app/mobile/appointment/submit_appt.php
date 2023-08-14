<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     $response = [
//         'statusCode' => 405,
//         'status' => 'error',
//         'message' => 'Method Not Allowed',
//     ];
//     header('Content-Type: application/json', true, 405);
//     echo json_encode($response);
//     exit;
// }

// Create a connection to the database
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

$response = [];

try {
    // Get the data from the POST request
    $type = $_POST['type'] ?? 'Online';
    $status = $_POST['status'] ?? 'Pending';
    $date = $_POST['date'];
    $time = $_POST['time'];
    $patientId = $_POST['patient_id'] ?? 1;
    $note = $_POST['note'] ?? null;

    // Check if the appointment time is already taken
    $checkQuery = "SELECT * FROM appointments 
    WHERE date = ? 
    AND (time = ? OR time = DATE_ADD(?, INTERVAL 10 MINUTE) OR time = DATE_SUB(?, INTERVAL 10 MINUTE))";

    $checkStatement = $connection->prepare($checkQuery);
    $checkStatement->bind_param("ssss", $date, $time, $time, $time);
    $checkStatement->execute();
    $result = $checkStatement->get_result();

    if ($result && $result->num_rows > 0) {
        $response = [
            'statusCode' => 400,
            'status' => 'errorT',
            'message' => 'Time has already been appointed.',
        ];
        header('Content-Type: application/json', true, 400);
        echo json_encode($response);
        exit;
    }

    // Prepare the SQL query to insert the data into the appointments table
    $query = "INSERT INTO appointments (Type, status, date, time, patient_id, note) 
              VALUES (?, ?, ?, ?, ?, ?)";

    $insertStatement = $connection->prepare($query);
    $insertStatement->bind_param("ssssis", $type, $status, $date, $time, $patientId, $note);

    // Execute the query
    if ($insertStatement->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Appointment created successfully';
        header('Content-Type: application/json', true, 200);
    } else {
        throw new Exception('Failed to create appointment: ' . $insertStatement->error);
    }

    // Close the database connection
    $connection->close();
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
    header('Content-Type: application/json', true, 500);
}

// Return a response to the Flutter app
echo json_encode($response);