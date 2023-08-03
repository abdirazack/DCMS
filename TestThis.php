<?php

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'dental_clinic');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have the appointment ID for which you want to retrieve the services.
$appointmentID = 1;

// Fetch the appointment data from the 'appointments' table
$sql = "SELECT a.appointment_id, a.Type, a.status, a.date, a.time, p.patient_id, p.first_name, p.middle_name, p.last_name, e.employee_id, e.first_name, e.middle_name, e.last_name, e.experience, e.phone, e.address
FROM appointments a
LEFT JOIN patients p ON a.patient_id = p.patient_id
LEFT JOIN employees e ON a.employee_id = e.employee_id
WHERE a.appointment_id =  $appointmentID";

$result = $conn->query($sql);

if ($result === false) {
    die("Error executing the appointment query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $appointmentData = $result->fetch_assoc();

    $sqlServices = "SELECT service FROM appointment_services WHERE appointment_id = $appointmentID";
    $resultServices = $conn->query($sqlServices);

    if ($resultServices === false) {
        die("Error executing the service query: " . $conn->error);
    }

    if ($resultServices->num_rows > 0) {
        // Rest of your code...
    } else {
        echo "No services found for the appointment.";
    }

    if ($resultServices->num_rows > 0) {
        $serviceIDs = array();
        while ($row = $resultServices->fetch_assoc()) {
            $serviceIDs[] = $row['service'];
        }

        // Convert the array of service IDs to a comma-separated string.
        $serviceIDsString = implode(",", $serviceIDs);

        // Fetch the names of the services associated with the appointment from the 'services' table.
        $sqlServiceNames = "SELECT name FROM services WHERE service_id IN ($serviceIDsString)";
        $resultServiceNames = $conn->query($sqlServiceNames);

        $serviceNames = array();
        while ($row = $resultServiceNames->fetch_assoc()) {
            $serviceNames[] = $row['name'];
        }

        // Add the service names to the appointment data.
        $appointmentData['services'] = $serviceNames;
    }

    // Now you have the complete appointment data with associated service names.
    echo json_encode($appointmentData);
} else {
    echo "Appointment not found.";
}

// Close the connection
$conn->close();
