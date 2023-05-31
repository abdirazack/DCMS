<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $employee_id = mysqli_real_escape_string($conn, $_POST["employee"]);
    $Username = mysqli_real_escape_string($conn, $_POST["Username"]);
    $Password = mysqli_real_escape_string($conn,$_POST["Password"]);

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new logincredentials
    $sql = "INSERT INTO logincredentials (employee_id, Username, Password) VALUES ('$employee_id', '$Username', '$Password')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added logincredentials', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add logincredentials', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the logincredentials

    $sql = "UPDATE logincredentials SET  Username = '$Username', Password = '$Password' WHERE employee_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated logincredentials', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update logincredentials', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
