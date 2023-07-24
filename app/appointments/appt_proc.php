<?php
require_once("./appt_functions.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['appointment_id'])) {
        // Get the appointment_id from the POST request and fetch the appointment data
        $appointmentId = $_POST['appointment_id'];

        if (isset($_POST['cancelButton'])) {
            // Update the appointment status to "Cancelled"
            $updateSql = "UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = $appointmentId";

            if ($conn->query($updateSql) === TRUE) {
                // Return a success message
                echo json_encode(['status' => 'Appointment successfully cancelled']);
            } else {
                // Handle the case when the query fails
                echo json_encode(['error' => 'Failed to update appointment status']);
            }
        } else {
            // Fetch and return the appointment data
            echo fetchAppointmentData($appointmentId);
        }
    } else {
        // Invalid request, return an error response
        echo json_encode(['error' => 'Invalid request']);
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request method for this endpoint
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode(['error' => 'Invalid request method']);
}
