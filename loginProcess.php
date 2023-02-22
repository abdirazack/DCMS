<?php
session_start();
require_once 'conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password using MD5
$passwordHash = md5($password);

if (isset($_POST['btnLogin'])) {
    if (empty($username) || empty($password)) {

        echo "<h2 style=color:'red'>All Fields are required</h2>";
        include_once("index.php");
    } else {

        // Look up the user in the database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$passwordHash'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userType = $row['user_type'];

            if ($userType == 'Admin') {
                $_SESSION['username'] = $res['username'];
                $_SESSION['userid'] = $res['userID'];
                header("location: home.php");
            } elseif ($userType == 'Staff') {
                $_SESSION['username'] = $res['username'];
                $_SESSION['userid'] = $res['userID'];
                header("location: test.php");
            } elseif ($userType == 'Patient') {
                $_SESSION['username'] = $res['username'];
                $_SESSION['userid'] = $res['userID'];
                header("location: patient.php");
            } else {
                // If the user doesn't exist or the password is incorrect, show an error message
                echo "Invalid username or password";
            }
        } else {
            echo "<center><h2 style='color: red;' class='mt-4'>Wrong credientails please Try Again</h2></center>";
            include("index.php");
        }
    }
}
