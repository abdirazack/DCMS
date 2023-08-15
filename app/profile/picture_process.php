<?php

    //connect to database
    include('../database/conn.php');


    session_start();
    //get the id of the record to be updated
    $id = $_SESSION["empid"];

    //change picture

    $profile = '';
    // get the previouse profile picture
    $sql = "SELECT * FROM employees WHERE employee_id='$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $oldProfile = $row['profile'];

    if (isset($_FILES['profile'])) {
        $now = new DateTime();
        $name =  $now->getTimestamp();
        $filename = $_FILES["profile"]["name"];
        $tempname = $_FILES["profile"]["tmp_name"];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $folder = "../img/employee/" . $name . '.' . $ext ?? "../img/employee/" . "default.jpg";

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder)) {
            $profile = $name . '.' . $ext;
            // delete the previouse profile picture
            if ($oldProfile != "") {
                $return = unlink("../img/employee/" . $oldProfile);
            }
            $sql = "UPDATE employees SET profile='$profile' WHERE employee_id='$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data = ['message' => 'succeffully uploaded image', 'status' => 200];
                echo json_encode($data);
                // set new session profile picture
                $_SESSION["profile"] = $profile;
            } else {
                $data = ['message' => 'Failed to upload image', 'status' => 404];
                echo json_encode($data);
            }
        } else {
            $data = ['message' => 'Failed to upload image', 'status' => 404];
            echo json_encode($data);
        }
    } else {
        $data = ['message' => 'Select a proper image', 'status' => 404];
        echo json_encode($data);
    }
