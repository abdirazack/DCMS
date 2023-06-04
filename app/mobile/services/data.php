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
    $query = $_POST['query'];

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch the data
        $data = mysqli_fetch_assoc($result);
        $response = [
            'success' => true,
            'data' => $data,
        ];
    } else {
        // Query execution failed
        $response = [
            'success' => false,
            'message' => 'Failed to retrieve data',
        ];
    }

    echo json_encode($response);
}
?>
