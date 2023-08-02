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
    $response = [
        'statusCode' => 500,
        'status' => 'error',
        'message' => 'Connection Failed: ' . mysqli_connect_error()
    ];
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = mysqli_real_escape_string($conn, trim($_POST['username']));
            $password = mysqli_real_escape_string($conn, trim($_POST['password']));

            // Validate input (e.g., check for empty fields or length restrictions)

            // Prepare and bind the SQL statement
            $sql = "SELECT patient_id, first_name, middle_name, last_name, birth_date, gender, phone_number, address
                    FROM patients WHERE username = ? AND password = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result and fetch data
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                // Authentication successful
                $response = [
                    'statusCode' => 200,
                    'status' => 'success',
                    'data' => [
                        'patient_id' => $row['patient_id'],
                        'first_name' => $row['first_name'],
                        'middle_name' => $row['middle_name'],
                        'last_name' => $row['last_name'],
                        'birth_date' => $row['birth_date'],
                        'gender' => $row['gender'],
                        'phone_number' => $row['phone_number'],
                        'address' => $row['address']
                    ]
                ];
            } else {
                // Authentication failed
                $response = [
                    'statusCode' => 401,
                    'status' => 'error',
                    'message' => 'Authentication failed'
                ];
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $response = [
                'statusCode' => 400,
                'status' => 'error',
                'message' => 'Invalid request. Username and password are required.'
            ];
        }
    } else {
        $response = [
            'statusCode' => 405,
            'status' => 'error',
            'message' => 'Method not allowed'
        ];
    }
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
