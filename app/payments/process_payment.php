<?php
  // Connect to the database
  include_once('../database/conn.php');


    $id = @$_POST["id"];
    $patient_id = mysqli_real_escape_string($conn, $_POST["patient_id"]);
    $amount = mysqli_real_escape_string($conn, $_POST["amount"]);
    $amount_paid = mysqli_real_escape_string($conn,$_POST["amount_paid"]);
    $amountDue = mysqli_real_escape_string($conn,$_POST["amountDue"]);
    $discount = mysqli_real_escape_string($conn,$_POST["discount"]);
    $date_paid = mysqli_real_escape_string($conn,$_POST["date_paid"]);
    $payment_method = mysqli_real_escape_string($conn,$_POST["payment_method"]);

   $amountPaid = $amount_paid + $discount;

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

  
        $data = ['message'=>'Cannot Directly insert new record from here.', 'status'=>404];
        echo json_encode($data);
        return ;
    
  }
  else {
        // Update the payments
   $sql = "UPDATE incometable SET patient_id='$patient_id', IncomeAmount='$amount', IncomeAmountPaid='$amountPaid',  IncomeDate='$date_paid'  WHERE IncomeID='$id'";
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
