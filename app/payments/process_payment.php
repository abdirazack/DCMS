<?php
  // Connect to the database
  include_once('../database/conn.php');


    $id = @$_POST["id"];
    $patient_id = mysqli_real_escape_string($conn, $_POST["patient_id"]);
    $amount = mysqli_real_escape_string($conn, $_POST["amount"]);
    $amount_paid = mysqli_real_escape_string($conn,$_POST["amount_paid"]);
    $description = mysqli_real_escape_string($conn,$_POST["description"]);
    $date_paid = mysqli_real_escape_string($conn,$_POST["date_paid"]);
    $payment_method = mysqli_real_escape_string($conn,$_POST["payment_method"]);

    $amount_due = $amount - $amount_paid;


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new payments
    $sql = "INSERT INTO payments (patient_id, amount, amount_paid, amount_due, description, date_paid, payment_method) VALUES ('$patient_id', '$amount', '$amount_paid', '$amount_due', '$description', '$date_paid', '$payment_method')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added payments', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add payments', 'status'=>404];
        echo json_encode($data);
        return ;
    }
  }
  else {
        // Update the payments
    $sql = "UPDATE payments SET patient_id = '$patient_id', amount = '$amount', amount_paid = '$amount_paid', amount_due = '$amount_due', description = '$description', date_paid = '$date_paid', payment_method = '$payment_method' WHERE payment_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated payments', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update payments', 'status'=>404];
        echo json_encode($data);
        return ;
    }
  }

  
?>
