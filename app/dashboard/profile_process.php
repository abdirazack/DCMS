<?php

    //connect to database
    include('../database/conn.php');

    //get the id of the record to be updated
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmNewPassword = mysqli_real_escape_string($conn, $_POST['confirmNewPassword']);


    //update the record
    $sql = "UPDATE employees SET first_name='$firstName', last_name='$lastName', phone='$phoneNumber', email='$email', address='$address' WHERE employee_id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = ['message'=>'succeffully updated employee', 'status'=>200];
        echo json_encode($data);
    } else {
        $data = ['message'=>'succeffully updated employee', 'status'=>404];
        echo json_encode($data);
    }

    //confirm new password
    if ($newPassword == $confirmNewPassword) {
        $sql = "UPDATE logincredentials SET Password='$newPassword' WHERE employee_id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data = ['message'=>'succeffully updated logincredentials', 'status'=>200];
            echo json_encode($data);
        } else {
            $data = ['message'=>'succeffully updated logincredentials', 'status'=>404];
            echo json_encode($data);
        }
    } else {
        $data = ['message'=>"Paasword Don't match", 'status'=>004];
        echo json_encode($data);
    }

?>