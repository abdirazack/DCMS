<?php
if (!isset($_SESSION)) {
    // session_start();
}
$database    = 'dental_clinic';
$username    = 'root';
$host        = 'localhost';
$password    = '';
$msg         = '';

ini_set('display_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED);

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn == false) {
    die("Connection Failed: " . mysqli_connect_error());
}
