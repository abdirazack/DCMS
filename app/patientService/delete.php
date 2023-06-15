<?php

    include_once("../database/conn.php");
    $id = $_POST['id'];
    $query = "DELETE FROM `patientServices` WHERE `patientService_id` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $data = ['message'=>'Succeesully deleted patient_Service', 'status'=>200];
        echo json_encode($data);
    } else {
        $data = ['message'=>'Failed to delete  patient_Service', 'status'=>404];
        echo json_encode($data);
    }



?>