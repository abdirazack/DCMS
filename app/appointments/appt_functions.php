<?php
// Replace with your database credentials
$host = 'localhost';
$dbname = 'dental_clinic';
$username = 'root';
$password = '';



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to handle database connection
function connectDB()
{
    global $host, $username, $password, $dbname;
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to handle JSON responses
function sendJsonResponse($statusCode, $message)
{
    $response = [
        "statusCode" => $statusCode,
        "message" => $message
    ];
    echo json_encode($response);
    exit;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to fetch appointment data based on appointment_id
function fetchAppointmentData($appointmentId)
{
    $conn = connectDB();

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
            'status' => $appointmentData['status']
        ];
        $conn->close();

        // Return the response as JSON
        echo json_encode($response);
    } else {
        $conn->close();
        sendJsonResponse(404, "Error fetching appointment for editModal: " . $conn->error);
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to update appointment status to "Cancelled"
function cancelAppointment($appointmentId)
{
    $conn = connectDB();

    $updateSql = "UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = $appointmentId";

    if ($conn->query($updateSql) === TRUE) {
        $conn->close();
        sendJsonResponse(200, "Appointment cancelled successfully");
    } else {
        $conn->close();
        sendJsonResponse(404, "Failed to cancel appointment: " . $conn->error);
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to update appointment data
function updateAppointment($appointmentId, $type, $status, $patient_id, $emp_id,  $newDate, $newTime)
{
    $conn = connectDB();

    // Use prepared statement to prevent SQL injection
    $updateSql = "UPDATE appointments SET Type = ?, status = ?, date = ?, time = ?, patient_id = ?, employee_id = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($updateSql);
    if (!$stmt) {
        $conn->close();
        sendJsonResponse(500, "Failed to prepare statement for update");
        exit;
    }

    // Bind parameters and execute the update query
    $stmt->bind_param("ssssi", $type, $status, $newDate, $newTime, $patient_id, $emp_id, $appointmentId);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        sendJsonResponse(200, "Appointment updated successfully");
        exit;
    } else {
        $stmt->close();
        $conn->close();
        sendJsonResponse(404, "Appointment not updated: " . $conn->error);
        exit;
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to create a new appointment
function createAppointment($appointmentType, $appointmentStatus, $appointmentDate, $appointmentTime, $appointmentPatient, $appointmentDentist)
{
    $conn = connectDB();

    // Prepare and execute the query
    $stmt = $conn->prepare('INSERT INTO appointments (Type, status, date, time, patient_id, employee_id) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssssii', $appointmentType, $appointmentStatus, $appointmentDate, $appointmentTime, $appointmentPatient, $appointmentDentist);

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        sendJsonResponse(200, "Created appointment successfully");
    } else {
        $stmt->close();
        $conn->close();
        sendJsonResponse(404, "Error creating appointment: " . $conn->error);
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getAppointmentForCalendar(){
    $conn = connectDB();
    // Fetch appointments data from the database
    $sql = 'SELECT appointment_id, Type AS title, date AS date, time as time FROM appointments ';
    $result = $conn->query($sql);
  
    $appointments = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
      }
    }
  
    echo json_encode($appointments);
    $conn->close();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////-FUNCTION DIVIDER-/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////