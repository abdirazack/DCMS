<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $role_name = mysqli_real_escape_string($conn, @$_POST["role_name"]);
    $role_description = mysqli_real_escape_string($conn, @$_POST["role_description"]);


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new roles
    $sql = "INSERT INTO roles (role_name, role_description) VALUES ('$role_name', '$role_description')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added roles', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add roles', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the roles

    $sql = "UPDATE roles SET  role_name = '$role_name', role_description = '$role_description' WHERE role_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated roles', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update roles', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
