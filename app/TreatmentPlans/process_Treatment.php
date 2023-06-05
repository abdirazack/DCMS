<?php
// Connect to the database
include_once('../database/conn.php');

    $id = @$_POST["id"];
    $patient_id = $_POST["patients"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $total_cost = $_POST["total_cost"];
    $status = $_POST["status"];

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new Treatment plans
    $sql = "INSERT INTO treatment_plans (patient_id, start_date, end_date, total_cost,status) VALUES ('$patient_id', '$start_date', '$end_date', '$total_cost', '$status')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added Treatment Plan', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add Treatment Plans', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the Treatment plans

    $sql = "UPDATE treatment_plans SET patient_id = '$patient_id', start_date = '$start_date', end_date = '$end_date', total_cost = '$total_cost', status = '$status' WHERE treatment_plan_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated Treatment Plans', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update Treatment Plan', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
