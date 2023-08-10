<?php
    include_once("../database/conn.php");
    session_start();
    // Retrieve the form data
    // get appointment id and employee id from post
    $appointment_id = $_POST['appointmentId'];
    $employee_id = $_POST['employeeId'];

    // query to update appointment table
    $query = "UPDATE `appointments` SET employee_id  = '$employee_id', status = 'Approved' WHERE appointment_id  = '$appointment_id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        
        $data = ['message' => 'Succeesully updated appointment', 'status' => 200];
        echo json_encode($data);
    } else {
        $data = ['message' => 'Failed to update appointment', 'status' => 404];
        echo json_encode($data);
    }
?>