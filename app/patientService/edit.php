<?php

    include_once("../database/conn.php");
    $id = $_POST['id'];
    $query = "SELECT * FROM `patientServices` WHERE `patientService_id` = '$id'";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_assoc();
    echo json_encode($row);
?>