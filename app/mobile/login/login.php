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
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Perform the necessary validation and authentication logic here
        // You may use prepared statements to prevent SQL injection

        $sql = "SELECT * FROM logincredentials WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            // Authentication successful
            $response = [
                'message' => 'success',
                'data' => [
                    'user_id' => $row['employee_id'],
                    'username' => $row['Username'],
                    'password' => $row['Password']
                ]
            ];
        } else {
            // Authentication failed
            $response = [
                'message' => 'error',
                'data' => null
            ];
        }

        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
?>
