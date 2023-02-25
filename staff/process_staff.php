<?php
// Connect to the database
include_once('../conn.php');


    $id = @$_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $address = $_POST["address"];

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new staff
    $sql = "INSERT INTO staff (first_name, last_name, phone_number, email, address) VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$address')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added staff', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add staff', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the staff


    $sql = "UPDATE staff SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone_number', email = '$email', address = '$address' WHERE staff_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated staff', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update staff', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
