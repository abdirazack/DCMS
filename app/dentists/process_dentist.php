<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $employee_id = mysqli_real_escape_string($conn, $_POST["employee"]);
    $specialty = mysqli_real_escape_string($conn, $_POST["Specialty"]);
    $experience = mysqli_real_escape_string($conn,$_POST["experience"]);
    $qualification = mysqli_real_escape_string($conn,$_POST["Qualification"]);

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new dentists
    $sql = "INSERT INTO dentists (employee_id, Specialty, Qualification, Experience) VALUES ('$employee_id', '$specialty', '$qualification', '$experience')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added dentists', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add dentists', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the dentists

    $sql = "UPDATE dentists SET  Specialty = '$specialty', Experience = '$experience', Qualification = '$qualification' WHERE employee_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated dentists', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update dentists', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
