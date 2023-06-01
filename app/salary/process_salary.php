<?php
  // Connect to the database
  include_once('../database/conn.php');


    $id = @$_POST["id"];
    $employee_id = mysqli_real_escape_string($conn, $_POST["employee_id"]);
    $SalaryType = mysqli_real_escape_string($conn,$_POST["SalaryType"]);
    $Currency = mysqli_real_escape_string($conn,$_POST["Currency"]);
    $PaymentFrequency = mysqli_real_escape_string($conn,$_POST["PaymentFrequency"]);
    $Amount = mysqli_real_escape_string($conn, $_POST["Amount"]);
    $datePaid = mysqli_real_escape_string($conn,$_POST["date_paid"]);

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new salary
    $sql = "INSERT INTO salary (employee_id, SalaryType, Currency, PaymentFrequency, Amount, datePaid) VALUES ('$employee_id', '$SalaryType', '$Currency', '$PaymentFrequency', '$Amount', '$datePaid')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added salary', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add salary', 'status'=>404];
        echo json_encode($data);
        return ;
    }
  }
  else {
        // Update the salary
    $sql = "UPDATE salary SET employee_id = '$employee_id', SalaryType = '$SalaryType', Currency = '$Currency', PaymentFrequency = '$PaymentFrequency', Amount = '$Amount', datePaid = '$datePaid' WHERE salary_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated salary', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update salary', 'status'=>404];
        echo json_encode($data);
        return ;
    }
  }
  
?>
