<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $employee_id = mysqli_real_escape_string($conn, $_POST["employee"]);
    $role_id = mysqli_real_escape_string($conn, $_POST["role"]);
    $experience = mysqli_real_escape_string($conn,$_POST["experience"]);

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new staff
    $sql = "INSERT INTO staff (employee_id, role_id, Experience) VALUES ('$employee_id', '$role_id', '$experience')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added staff', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add staff', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the staff

    $sql = "UPDATE staff SET  role_id = '$role_id', Experience = '$experience' WHERE employee_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated staff', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update staff', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
