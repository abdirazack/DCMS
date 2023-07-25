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
    $profile = '';



    // get the previouse profile picture
    $sql = "SELECT * FROM employees WHERE employee_id='$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $oldProfile = $row['profile'];
    $gender = $row['gender'];
    $hire_date = $row['hire_date'];


    if(isset($_FILES['profile'])){
        $now = new DateTime();
        $name=  $now->getTimestamp(); 
        $filename = $_FILES["profile"]["name"];
        $tempname = $_FILES["profile"]["tmp_name"];
        $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $folder = "../img/employee/" . $name.'.'.$ext ?? "../img/employee/" . "default.jpg";

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder)) {
            $profile = $name.'.'.$ext;
            // delete the previouse profile picture
            $return = unlink("../img/employee/".$oldProfile);
            echo $return;
        } else {
                echo "Failed to upload image";
        }
    }

    echo $profile;

    //update the record
    $sql = "UPDATE employees SET first_name='$firstName', gender='$gender', hire_date = '$hire_date', last_name='$lastName', phone='$phoneNumber', profile = '$profile',email='$email', address='$address' WHERE employee_id='$id'";
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
