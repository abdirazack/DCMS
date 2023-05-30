<?php
// Connect to the database
include_once('../database/conn.php');

    $id = @$_POST["id"];
    $procedure_code = $_POST["procedure_code"];
    $procedure_name = $_POST["procedure_name"];
    $procedure_price = $_POST["procedure_price"];
    $procedure_description = $_POST["procedure_description"];

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new Procedure
    $sql = "INSERT INTO Procedures (procedure_code, procedure_name, procedure_price, procedure_description) VALUES ('$procedure_code', '$procedure_name', '$procedure_price', '$procedure_description')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added Procedure', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add Procedure', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the Procedure

    $sql = "UPDATE Procedures SET procedure_code = '$procedure_code', procedure_name = '$procedure_name', procedure_price = '$procedure_price', procedure_description = '$procedure_description' WHERE procedure_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated Procedure', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update Procedure', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
