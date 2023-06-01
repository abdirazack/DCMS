<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $patient_id = mysqli_real_escape_string($conn, $_POST["patient"]);
    $medication = mysqli_real_escape_string($conn, $_POST["medication"]);
    $dosage = mysqli_real_escape_string($conn,$_POST["dosage"]);
    $instructions = mysqli_real_escape_string($conn, $_POST["instruction"]);
    $date_prescribed = mysqli_real_escape_string($conn, $_POST["date_prescribed"]);

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new prescriptions
    $sql = "INSERT INTO prescriptions (patient_id, medication_id, dosage, instructions, date_prescribed) VALUES ('$patient_id', '$medication', '$dosage', '$instructions', '$date_prescribed')";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added prescriptions', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add prescriptions', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the prescriptions

    $sql = "UPDATE prescriptions SET  medication_id = '$medication', dosage = '$dosage', instructions = '$instructions', date_prescribed = '$date_prescribed' WHERE prescription_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated prescriptions', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update prescriptions', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
