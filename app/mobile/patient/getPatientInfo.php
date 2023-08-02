<?php

$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic');

if (!$conn) {
    $response = ['status' => 'error', 'data' => 'Error connecting to the database.'];
    echo json_encode($response);
    exit;
}

$patient_id = $_POST['patient_id'] ?? 3;

$sql = "SELECT * FROM patients where patient_id = '$patient_id'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $response = ['status' => 'error', 'data' => 'Error executing the SQL query.'];
    echo json_encode($response);
    exit;
}

$patients = array(); // Change $patient to $patients
while ($row = mysqli_fetch_assoc($result)) {
    // Append each patient to the $patients array
    $patients[] = [
        "patient_id" =>  $row['patient_id'],
        "first_name" =>  $row['first_name'],
        "middle_name" =>  $row['middle_name'],
        "last_name" => $row['last_name'],
        "gender" => $row['gender'],
        "birth_date" => $row['birth_date'],
        "phone_number" => $row['phone_number'],
        "address" => $row['address']
    ];
}

if (!empty($patients)) {
    $response = ['status' => 'success', 'data' => $patients];
} else {
    $response = ['status' => 'error', 'data' => 'No Patient found'];
}

echo json_encode($response);
