<?php
// Connect to the database
include_once('../conn.php');


    $id = @$_POST["id"];
    $date = $_POST["date"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];
    $drug_id = $_POST["drug_id"];
    $expense_type = $_POST["expense_type"];

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new expense
    $sql = "INSERT INTO expenses (date, description,  amount, expense_type, drug_id) VALUES ( '$date','$description', '$amount', '$expense_type', '$drug_id')";
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
    $sql = "UPDATE expenses SET date='$date', description='$description', amount='$amount', expense_type = '$expense_type', drug_id = '$drug_id' WHERE expense_id='$id'";
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
