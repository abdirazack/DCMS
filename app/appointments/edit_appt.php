<?php

require_once("./appt_functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $appt_id = $_POST['appointment_id'];
    $conn = connectDB();

    // Fetch the appointment data along with patient and dentist names
    $sql = "SELECT 
    appointments.*, 
    CONCAT(patients.first_name, ' ', patients.middle_name, ' ', patients.last_name) AS patient_full_name, 
    CONCAT(employees.first_name, ' ', employees.middle_name, ' ', employees.last_name) AS dentist_full_name
FROM appointments 
INNER JOIN patients ON appointments.patient_id = patients.patient_id
INNER JOIN employees ON appointments.employee_id = employees.employee_id
WHERE appointments.appointment_id = $appt_id";

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

        // Return the response as JSON
        echo json_encode($response);
        exit;
    } else {
        $conn->close();
        sendJsonResponse(404, "Error fetching appointment for editModal: " . $conn->error);
    }
} else {
    sendJsonResponse(405, "Invalid request method");
}
?>