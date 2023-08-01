<?php

$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic');

if (!$conn) {
    $response = ['status' => 'error', 'data' => 'Error connecting to the database.'];
    echo json_encode($response);
    exit;
}

$patient_id = $_POST['patient_id'] ?? 3;
$patient_id = mysqli_real_escape_string($conn, $patient_id); // Prevent SQL injection

$sql = "SELECT appointments.appointment_id, CONCAT(patients.first_name, ' ', patients.middle_name, ' ', patients.last_name) as patient, appointments.patient_id, CONCAT(employees.first_name, ' ', employees.middle_name, ' ', employees.last_name) as dentist, employees.employee_id, date, time, note, Type, status FROM appointments
JOIN employees ON appointments.employee_id = employees.employee_id
JOIN patients ON appointments.patient_id = patients.patient_id
WHERE appointments.patient_id = '$patient_id'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $response = ['status' => 'error', 'data' => 'Error executing the SQL query.'];
    echo json_encode($response);
    exit;
}

$appointments = array();
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

if (!empty($appointments)) {
    $response = ['status' => 'success', 'data' => $appointments];
} else {
    $response = ['status' => 'error', 'data' => 'No appointment found'];
}

echo json_encode($response);
