<?php
// Connect to the database
include_once('../conn.php');


    $id = @$_POST["id"];
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn,$_POST["last_name"]);
    $phone_number = mysqli_real_escape_string($conn,$_POST["phone_number"]);
    $gender = mysqli_real_escape_string($conn,$_POST["gender"]);
    $address = mysqli_real_escape_string($conn,$_POST["address"]);
    $birth_date = mysqli_real_escape_string($conn,$_POST["birth_date"]);

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new patients
    $sql = "INSERT INTO patients (first_name, last_name, birth_date, gender, phone_number,  address) VALUES ('$first_name', '$last_name', '$birth_date', '$gender', '$phone_number',  '$address')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added patients', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add patients', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the patients


    $sql = "UPDATE patients SET first_name = '$first_name', last_name = '$last_name', birth_date = '$birth_date', phone_number = '$phone_number',  gender = '$gender', address = '$address' WHERE patient_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated patients', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update patients', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
