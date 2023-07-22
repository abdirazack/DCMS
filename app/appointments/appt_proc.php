<?php
// Replace with your database credentials
$host = 'localhost';
$dbname = 'dental_clinic';
$username = 'root';
$password = '';

// Function to fetch appointment data based on appointment_id
function fetchAppointmentData($conn, $appointmentId)
{
    // Fetch the appointment data along with patient and dentist names
    $sql = "SELECT 
    appointments.*, 
    CONCAT(patients.first_name, ' ', patients.middle_name, ' ', patients.last_name) AS patient_full_name, 
    CONCAT(employees.first_name, ' ', employees.middle_name, ' ', employees.last_name) AS dentist_full_name
FROM appointments 
INNER JOIN patients ON appointments.patient_id = patients.patient_id
INNER JOIN employees ON appointments.employee_id = employees.employee_id
WHERE appointments.appointment_id = $appointmentId";

    // Execute the query
    $result = $conn->query($sql);

    if ($result) {
        // Fetch the appointment data from the result
        $appointmentData = $result->fetch_assoc();

        // Add appointment data to the response
        $response = [
            'appointment_id' => $appointmentData['appointment_id'],
            'patient_full_name' => $appointmentData['patient_full_name'],
            'dentist_full_name' => $appointmentData['dentist_full_name'],
            'date' => $appointmentData['date'],
            'time' => $appointmentData['time'],
            // 'services' => $appointmentData['services'], // This line is commented as you mentioned that it's not needed
            'type' => $appointmentData['Type'],
            'status' => $appointmentData['status'],
            // You can add more appointment details as needed
        ];

        // Return the response as JSON
        return json_encode($response);
    } else {
        // Handle the case when the query fails
        return json_encode(['error' => 'Failed to fetch appointment data']);
    }
}

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
        } else if (isset($_POST['editButton'])) {
            // Perform the appointment update based on the edited data
            // Assuming you have form fields for edited appointment data with names like 'editAppointmentDate' and 'editAppointmentTime'
            $newDate = $_POST['editAppointmentDate'];
            $newTime = $_POST['editAppointmentTime'];
            // You can get more edited appointment data as needed

            // Update the appointment data in the database
            $updateSql = "UPDATE appointments SET date = '$newDate', time = '$newTime' WHERE appointment_id = $appointmentId";

            if ($conn->query($updateSql) === TRUE) {
                // Return a success message
                echo json_encode(['status' => 'Appointment successfully updated']);
            } else {
                // Handle the case when the query fails
                echo json_encode(['error' => 'Failed to update appointment data']);
            }
        } else {
            // Fetch and return the appointment data
            echo fetchAppointmentData($conn, $appointmentId);
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
