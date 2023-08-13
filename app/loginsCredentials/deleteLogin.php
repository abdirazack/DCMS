<?php
include_once('../database/conn.php');

if(isset($_POST['deleteid'])){
    $id = intval($_POST['deleteid']); // Validate input

    if ($id <= 0) {
        $data = ['message'=>'Invalid input', 'status'=>400];
        echo json_encode($data);
        return;
    }

    // Prepare the DELETE query using a prepared statement
    $stmt = $conn->prepare("DELETE FROM logincredentials WHERE employee_id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $data = ['message'=>'Success', 'status'=>200];
        echo json_encode($data);
        return;
    } else {
        $data = ['message'=>'Failed to delete staff', 'status'=>404];
        echo json_encode($data);
        return;
    }

    // Close the statement
    $stmt->close();
}
