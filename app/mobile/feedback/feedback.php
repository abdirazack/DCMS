<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = [
        'statusCode' => 405,
        'status' => 'error',
        'message' => 'Method Not Allowed',
    ];
    header('Content-Type: application/json', 405);   
    echo json_encode($response);
    exit;
}

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

    if (!isset($_POST['feedback'])) {
        $response = [
            'statusCode' => 400,
            'status' => 'error',
            'message' => 'Bad Request: Missing feedback data',
        ];
        header('Content-Type: application/json', 400);
        echo json_encode($response);
        exit;
    }
    

    // Get the data from the POST request
    $feedback = $_POST['feedback'];
 

    // Prepare the SQL query to insert the data into the appointments table
    $query = "INSERT INTO feedbacks (feedback) 
              VALUES (?)";

    $insertStatement = $connection->prepare($query);
    $insertStatement->bind_param("s", $feedback);

    // Execute the query
    if ($insertStatement->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Feedback sent successfully';
        header('Content-Type: application/json', true, 200);
    } else {
        throw new Exception('Failed to send feedback: ' . $insertStatement->error);
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
