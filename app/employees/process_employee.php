<?php
  // Connect to the database
  include_once('../database/conn.php');



    $id = @$_POST["id"]; 
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn,$_POST["last_name"]);
    $phone_number = mysqli_real_escape_string($conn,$_POST["phone_number"]);
    $gender = mysqli_real_escape_string($conn,$_POST["gender"]);
    $address = mysqli_real_escape_string($conn,$_POST["address"]);
    $hire_date = mysqli_real_escape_string($conn,$_POST["hire_date"]);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new employess
    $sql = "INSERT INTO employees (first_name, last_name, email, phone, address,  gender, hire_date) VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$address',  '$gender', '$hire_date')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added employees', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add employess', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the employess
    $sql = "UPDATE employees SET first_name = '$first_name', last_name = '$last_name', hire_date = '$hire_date', phone = '$phone_number',  gender = '$gender', address = '$address', email = '$email' WHERE employee_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated employess', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update employess', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
