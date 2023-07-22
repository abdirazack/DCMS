<?php
// Replace with your database credentials
$host = 'localhost';
$dbname = 'dental_clinic';
$username = 'root';
$password = '';

try {
  $conn = new mysqli($host, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch appointments data from the database
  $sql = 'SELECT appointment_id, Type AS title, date AS date, time as time FROM appointments where status != "Cancelled" AND status != "Approved"';
  $result = $conn->query($sql);

  $appointments = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $appointments[] = $row;
    }
  }

  echo json_encode($appointments);

  $conn->close();
} catch (Exception $e) {
  echo 'Error fetching appointments data: ' . $e->getMessage();
}
