<?php 
include_once('../database/conn.php');

if(isset($_POST['updateid'])){
    $id = intval($_POST['updateid']); // Sanitize input

    // Prepare the SQL statement with parameter binding
    $stmt = $conn->prepare("SELECT * FROM logincredentials WHERE employee_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Close the statement
    $stmt->close();

    echo json_encode($row);
}
