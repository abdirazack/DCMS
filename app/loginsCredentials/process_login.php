<?php
// Connect to the database
include_once('../database/conn.php');

// Validate and sanitize input
$id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
$employee_id = isset($_POST["employee"]) ? intval($_POST["employee"]) : 0;
$Username = isset($_POST["Username"]) ? htmlspecialchars($_POST["Username"], ENT_QUOTES, 'UTF-8') : "";
$Password = isset($_POST["Password"]) ? htmlspecialchars($_POST["Password"], ENT_QUOTES, 'UTF-8') : "";
$isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

// Validate input before using in queries
if ($employee_id <= 0 || empty($Username) || empty($Password)) {
    $data = ['message' => 'Invalid input', 'status' => 400];
    echo json_encode($data);
    return;
}

// Prepare SQL statements with parameter binding to prevent SQL injection
if ($id === 0) {
    $stmt = $conn->prepare("INSERT INTO logincredentials (employee_id, Username, Password, isAdmin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $employee_id, $Username, $Password, $isAdmin);
} else {
    $stmt = $conn->prepare("UPDATE logincredentials SET Username = ?, Password = ?, isAdmin = ? WHERE employee_id = ?");
    $stmt->bind_param("ssii", $Username, $Password, $isAdmin, $id);
}

// Execute the prepared statement
if ($stmt->execute()) {
    $data = ['message' => ($id === 0 ? 'Successfully added' : 'Successfully updated') . ' logincredentials', 'status' => 200];
} else {
    $data = ['message' => 'Failed to ' . ($id === 0 ? 'add' : 'update') . ' logincredentials', 'status' => 404];
}

// Close the statement
$stmt->close();

// Output JSON response
echo json_encode($data);
