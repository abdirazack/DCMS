<?php
$database = 'dental_clinic';
$username = 'root';
$host = 'localhost';
$password = '';
$msg = '';

ini_set('display_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED);

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableName = $_POST['tableName'];
    $columnName = $_POST['column'];
    $id = $_POST['id'];
    $id = intval($id);

    // Create your SQL query
    $sql = "DELETE FROM $tableName WHERE $columnName = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // Delete was successful
        $response = [
            'success' => true,
            'message' => 'Data deleted successfully',
        ];
    } else {
        // Delete failed
        $response = [
            'success' => false,
            'message' => 'Failed to delete data',
        ];
    }

    echo json_encode($response);
}
?>
