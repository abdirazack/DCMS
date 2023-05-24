<?php
  // Connect to the database
  include_once('../database/conn.php') ;


    $id = @$_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $fee = $_POST["fee"];

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new service
    $sql = "INSERT INTO services (name, description, fee) VALUES ('$name', '$description', '$fee')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added service', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add service', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the service


    $sql = "UPDATE services SET name='$name', description='$description', fee='$fee' WHERE service_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated service', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update service', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
