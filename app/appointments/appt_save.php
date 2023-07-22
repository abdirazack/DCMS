<?php
// Replace with your database credentials
$host = 'localhost';
$dbname = 'dental_clinic';
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    // Get form data
    $appointmentType = $_POST['appointmentType']      ?? NULL;
    $appointmentStatus = $_POST['appointmentStatus']  ?? NULL;
    $appointmentDate = $_POST['appointmentDate']      ?? NULL;
    $appointmentTime = $_POST['appointmentTime']      ?? NULL;
    $appointmentPatient = $_POST['appointmentPatient' ?? NULL];
    $appointmentDentist = $_POST['appointmentDentist' ?? NULL];

    // Validate form data (add your own validation here if needed)

    // Create a new appointment in the database
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query
    $stmt = $conn->prepare('INSERT INTO appointments (Type, status, date, time, patient_id, employee_id) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssssii', $appointmentType, $appointmentStatus, $appointmentDate, $appointmentTime, $appointmentPatient, $appointmentDentist);

    // Execute the query
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Send a success message back to the client
    echo 'Appointment created successfully';
    echo json_encode('success');
  } catch (Exception $e) {
    // Send an error message back to the client
    echo 'Error creating appointment: ' . $e->getMessage();
  }
}
