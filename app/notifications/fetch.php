

<?php
include_once('../database/conn.php');

$sql = "SELECT count(*) as total  FROM appointmentdetails WHERE viewed = 0 limit 5";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo $row['total'];

?>

