<?php
// Connect to the database
include_once('../database/conn.php');


    $id = mysqli_real_escape_string($conn,  @$_POST["id"]);
    $item_name = mysqli_real_escape_string($conn, $_POST["item_name"]);
    $unit_cost = mysqli_real_escape_string($conn, $_POST["unit_cost"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $supplier_id = mysqli_real_escape_string($conn, $_POST["supplier_id"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new inventory
    $sql = "INSERT INTO inventory  VALUES (null,'$item_name', '$description', '$unit_cost', '$quantity', '$supplier_id' )";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added inventory', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add inventory', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the inventory

    $sql = "UPDATE inventory SET item_name='$item_name', description='$description', unit_cost='$unit_cost', quantity='$quantity', supplier_id='$supplier_id' WHERE inventory_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated inventory', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update inventory', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
