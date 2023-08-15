<?php

    //connect to database
    include('../database/conn.php');


    session_start();
    //get the id of the record to be updated
    $id = $_SESSION["empid"];
    //change password
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmNewPassword = mysqli_real_escape_string($conn, $_POST['confirmNewPassword']);
    //confirm new password
    if ($newPassword == $confirmNewPassword) {
        $sql = "UPDATE logincredentials SET Password='$newPassword' WHERE employee_id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data = ['message' => 'succeffully updated logincredentials', 'status' => 200];
            echo json_encode($data);
        } else {
            $data = ['message' => 'Failed to update logincredentials', 'status' => 404];
            echo json_encode($data);
        }
    } else {
        $data = ['message' => "Paasword Don't match", 'status' => 004];
        echo json_encode($data);
    }
