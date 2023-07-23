<?php
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
function sendJsonResponse($statusCode, $message) {
    $response = [
        "statusCode" => $statusCode,
        "message" => $message
    ];
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateAppointmentButton'])) {
        $editAppointmentId = intval($_POST['editAppointmentId']);
        $editAppointmentType = $_POST['editAppointmentType'];
        $editAppointmentStatus = $_POST['editAppointmentStatus'];
        $editAppointmentDate = $_POST['editAppointmentDate'];
        $editAppointmentTime = $_POST['editAppointmentTime'];
        $editAppointmentPatient = intval($_POST['editAppointmentPatient']);
        $editAppointmentDentist = intval($_POST['editAppointmentDentist']);

        // Use prepared statement to prevent SQL injection
        $updateAppt = "UPDATE appointments SET Type = ?, status = ?, date = ?, time = ?, patient_id = ?, employee_id = ? WHERE appointment_id = ?";
        $stmt = $conn->prepare($updateAppt);
        if (!$stmt) {
            sendJsonResponse(500, "Failed to prepare statement for update");
        }

        // Bind parameters and execute the update query
        $stmt->bind_param("ssssiii", $editAppointmentType, $editAppointmentStatus, $editAppointmentDate, $editAppointmentTime, $editAppointmentPatient, $editAppointmentDentist, $editAppointmentId);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            sendJsonResponse(200, "Appointment updated successfully");
        } else {
            sendJsonResponse(422, "Appointment not updated. Query execution failed");
        }
    } elseif (isset($_POST['appointment_id'])) {
        // Fetch the appointment data along with patient and dentist names
        $appointmentId = intval($_POST['appointment_id']);

        // Use prepared statement to prevent SQL injection
        $sql = "SELECT 
                    appointments.*, 
                    CONCAT(patients.first_name, ' ', patients.middle_name, ' ', patients.last_name) AS patient_full_name, 
                    CONCAT(employees.first_name, ' ', employees.middle_name, ' ', employees.last_name) AS dentist_full_name
                FROM appointments 
                INNER JOIN patients ON appointments.patient_id = patients.patient_id
                INNER JOIN employees ON appointments.employee_id = employees.employee_id
                WHERE appointments.appointment_id = ?";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            sendJsonResponse(500, "Failed to prepare statement for appointment retrieval");
        }

        // Bind parameter and execute the query
        $stmt->bind_param("i", $appointmentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // Fetch the appointment data from the result
            $appointmentData = $result->fetch_assoc();

            // Add appointment data to the response
            $response = [
                'appointment_id' => $appointmentData['appointment_id'],
                'p_id' => $appointmentData['patient_id'],
                'p_name' => $appointmentData['patient_full_name'],
                'employee_id' => $appointmentData['employee_id'],
                'e_name' => $appointmentData['dentist_full_name'],
                'date' => $appointmentData['date'],
                'time' => $appointmentData['time'],
                // 'services' => $appointmentData['services'], // This line is commented as you mentioned that it's not needed
                'type' => $appointmentData['Type'],
                'status' => $appointmentData['status'],
                // You can add more appointment details as needed
            ];

            // Return the response as JSON
            echo json_encode($response);
        } else {
            sendJsonResponse(422, "Failed to fetch appointment data. Appointment not found");
        }
    } else {
        sendJsonResponse(400, "Invalid parameters passed");
    }
} else {
    sendJsonResponse(405, "Invalid request method");
}
?>
