<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $name = $_POST["name"];
    $cost = $_POST["cost"];
    $description = $_POST["description"];


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new drugs
    $sql = "INSERT INTO drugs  VALUES ( null, '$name', '$description','$cost' )";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added Drugs', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add Drugs', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the Drugs

    $sql = "UPDATE drugs SET drug_name = '$name', drug_cost = '$cost', drug_description = '$description' WHERE drug_id ='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated Drugs', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update Drugs', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
