<?php
  // Connect to the database
  include_once('../database/conn.php');

  session_start();
  $employee_id = $_SESSION['empid'];
    $id = @$_POST["id"];
    $date = $_POST["date"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];
    $quantity = $_POST['Quantity'];
    // $drug_id = $_POST["drug_id"];
    $expense_type = $_POST["expense_type"];

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new expense
    $sql = "INSERT INTO expenses ( employee_id, amount, quantity, description,expense_type, date) VALUES ( '$employee_id', '$amount', '$quantity ','$description', '$expense_type','$date' )";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added expense', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add expense', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the expense
    $sql = "UPDATE expenses SET date='$date', description='$description', amount='$amount', quantity = '$quantity', expense_type = '$expense_type'WHERE expense_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated Expense', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update Expense', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }

  
?>
