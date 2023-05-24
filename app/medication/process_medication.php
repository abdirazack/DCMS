<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $name = $_POST["name"];
    $dosage = $_POST["dosage"];
    $description = $_POST["description"];


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new medication
    $sql = "INSERT INTO medications  VALUES ( null, '$name', '$dosage', '$description')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added Medication', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add Medication', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the medication

    $sql = "UPDATE medications SET medication_name = '$name', medication_dosage = '$dosage', medication_description = '$description' WHERE medication_id ='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated medication', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update medication', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
