<?php
require("./appt_functions.php");
// Replace with your database credentials
$host = 'localhost';
$dbname = 'dental_clinic';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle JSON responses
function sendJsonResponse($statusCode, $message)
{
    $response = [
        "statusCode" => $statusCode,
        "message" => $message
    ];
    echo json_encode($response);
    exit; // Always exit after sending JSON response
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['editAppointmentId'])) {
        $editAppointmentId = intval($_POST['editAppointmentId']);
        $editAppointmentType = $_POST['editAppointmentType'];
        $editAppointmentStatus = $_POST['editAppointmentStatus'];
        $editAppointmentDate = $_POST['editAppointmentDate'];
        $editAppointmentTime = $_POST['editAppointmentTime'];
        $editAppointmentPatient = intval($_POST['editAppointmentPatient']);
        $editAppointmentDentist = intval($_POST['editAppointmentDentist']);

        updateAppointment($editAppointmentId, $editAppointmentType, $editAppointmentStatus, $editAppointmentPatient, $editAppointmentDentist, $editAppointmentDate, $editAppointmentTime);
    } else {
        sendJsonResponse(400, "Invalid parameters passed");
        exit;
    }
} else {
    sendJsonResponse(405, "Invalid request method");
    exit;
}

// echo json_encode("in the update appointment process file");
?>