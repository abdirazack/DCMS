<?php
// Connect to the database
include_once('../database/conn.php');

    $id = @$_POST["id"];
    $equipment_type = $_POST["equipment_type"];
    $manufacturer = $_POST["manufacturer"];
    $model = $_POST["model"];
    $purchase_date = $_POST["purchase_date"];
    $warranty_information = $_POST["warranty_information"];

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new Equipment
    $sql = "INSERT INTO Equipment (equipment_type, manufacturer, model, purchase_date, warranty_information) VALUES ('$equipment_type', '$manufacturer', '$model', '$purchase_date', '$warranty_information')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added Equipment', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add Equipment', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the Equipments

    $sql = "UPDATE Equipment SET equipment_type = '$equipment_type', manufacturer = '$manufacturer', model = '$model', purchase_date = '$purchase_date', warranty_information = '$warranty_information' WHERE equipment_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated Equipment', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update Equipment', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
