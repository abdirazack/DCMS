<?php
include_once('../conn.php');

// handle update when date is changed
if (isset($_POST['id'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $sql = "UPDATE appointments SET start_date = '$start', end_date = '$end' WHERE appointment_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: Dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}   

?>