<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $employee_id = mysqli_real_escape_string($conn, $_POST["employee"]);
    $Username = mysqli_real_escape_string($conn, $_POST["Username"]);
    $Password = mysqli_real_escape_string($conn,$_POST["Password"]);
    $isAdmin = false;
    if(isset($_POST['isAdmin'])){
        $isAdmin = true;
    }

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new logincredentials
    $sql = "INSERT INTO logincredentials (employee_id, Username, Password, isAdmin) VALUES ('$employee_id', '$Username', '$Password', '$isAdmin')";
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

    $sql = "UPDATE logincredentials SET  Username = '$Username', Password = '$Password', isAdmin = '$isAdmin' WHERE employee_id = '$id'";
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
