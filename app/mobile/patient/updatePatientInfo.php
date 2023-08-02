<?php

$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic');

if (!$conn) {
    $response = ['status' => 'error', 'data' => 'Error connecting to the database.'];
    echo json_encode($response);
    exit;
}

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = ['status' => 'error', 'data' => 'Invalid request method.'];
    echo json_encode($response);
    exit;
}

// Retrieve the patient data from the request
$patientId = $_POST['patient_id'] ?? null;
$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$birthDate = $_POST['birth_date'] ?? '';
$phoneNumber = $_POST['phone_number'] ?? '';
$address = $_POST['address'] ?? '';

// Validate the data (you can add more validation if needed)
if (empty($patientId) || empty($firstName) || empty($lastName) || empty($birthDate) || empty($phoneNumber) || empty($address)) {
    $response = ['status' => 'error', 'data' => 'Please fill all the required fields.'];
    echo json_encode($response);
    exit;
}

// Update the patient data in the database
$sql = "UPDATE patients 
        SET first_name = '$firstName', 
            last_name = '$lastName', 
            birth_date = '$birthDate', 
            phone_number = '$phoneNumber', 
            address = '$address' 
        WHERE patient_id = $patientId";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response = ['status' => 'success', 'data' => 'Patient information updated successfully.'];
    echo json_encode($response);
} else {
    $response = ['status' => 'error', 'data' => 'Failed to update patient information.'];
    echo json_encode($response);
}

mysqli_close($conn);

?>
