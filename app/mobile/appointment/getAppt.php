<?php

$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic');

if (!$conn) {
    $response = [
        'statusCode' => 500,
        'status' => 'error',
        'data' => 'Error connecting to the database: ' . mysqli_connect_error(),
    ];
    echo json_encode($response);
    exit;
}

$patient_id = isset($_POST['patient_id']);
// Add additional validation for $patient_id here, if required

// $patient_id = mysqli_real_escape_string($conn, $patient_id);

$sql = "SELECT appointments.appointment_id, CONCAT(patients.first_name, ' ', patients.middle_name, ' ', patients.last_name) as patient, appointments.patient_id, CONCAT(employees.first_name, ' ', employees.middle_name, ' ', employees.last_name) as dentist, employees.employee_id, date, time, note, type, status FROM appointments
JOIN employees ON appointments.employee_id = employees.employee_id
JOIN patients ON appointments.patient_id = patients.patient_id
WHERE appointments.patient_id = '$patient_id'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $response = [
        'statusCode' => 500,
        'status' => 'error',
        'data' => 'Error executing the SQL query: ' . mysqli_error($conn),
    ];
    echo json_encode($response);
    exit;
}

$appointments = array();
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = [
        'appointment_id' => $row['appointment_id'],
        'patient' => $row['patient'],
        'patient_id' => $row['patient_id'],
        'dentist' => $row['dentist'],
        'employee_id' => $row['employee_id'],
        'date' => $row['date'],
        'time' => $row['time'],
        'note' => $row['note'],
        'type' => $row['type'],
        'status' => $row['status'],
    ];
}

if (!empty($appointments)) {
    $response = [
        'statusCode' => 200,
        'status' => 'success',
        'data' => $appointments,
    ];
} else {
    $response = [
        'statusCode' => 404,
        'status' => 'error',
        'data' => 'No appointment found',
    ];
}

echo json_encode($response);
?>