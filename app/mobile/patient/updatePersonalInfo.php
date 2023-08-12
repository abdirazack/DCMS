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
    http_response_code(500); // Internal Server Error
    echo json_encode(array('statusCode' => 500, 'status' => 'error', 'message' => 'Database connection error'));
    exit();
}

// Retrieve data from the request
$patient_id = $_POST['patient_id'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$birth_date = $_POST['birth_date'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$username = $_POST['username'];

// Prepare and execute the update query
$query = "UPDATE patients SET first_name = ?, middle_name = ?, last_name = ?, birth_date = ?, address = ?, phone_number = ?, username = ? WHERE patient_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("sssssssi", $first_name, $middle_name, $last_name, $birth_date, $address, $phone_number, $username, $patient_id);

if ($stmt->execute()) {
    // Fetch updated data from the database
    $selectQuery = "SELECT * FROM patients WHERE patient_id = ?";
    $selectStmt = $connection->prepare($selectQuery);
    $selectStmt->bind_param("i", $patient_id);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $patientData = $result->fetch_assoc();

    $response = array(
        "statusCode" => 200,
        "status" => "success",
        "message" => "Profile updated successfully",
        "data" => $patientData
    );
} else {
    http_response_code(500);
    $response = array("statusCode" => 500, "status" => "error", "message" => "Failed to update profile");
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the prepared statements and database connection
$stmt->close();
$selectStmt->close();
$connection->close();
