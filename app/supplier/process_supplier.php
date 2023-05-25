<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new Suppplier
    $sql = "INSERT INTO suppliers  VALUES ( null, '$name', '$email', '$phone_number', '$address')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added Supplier', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add Supplier', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the Supplier

    $sql = "UPDATE suppliers SET supplier_name = '$name', email = '$email', phone_number = '$phone_number', address = '$address' WHERE supplier_id ='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated Supplier', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update Supplier', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
