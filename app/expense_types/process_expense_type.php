<?php
// Connect to the database
include_once('../database/conn.php');


    $id = @$_POST["id"];
    $expense_type = mysqli_real_escape_string($conn, @$_POST["expense_type"]);
    $expense_type_description = mysqli_real_escape_string($conn, @$_POST["expense_type_description"]);


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new expense_types
    $sql = "INSERT INTO expense_types (expense_type, expense_type_description) VALUES ('$expense_type', '$expense_type_description')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added expense_types', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add expense_types', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the expense_types

    $sql = "UPDATE expense_types SET  expense_type = '$expense_type', expense_type_description = '$expense_type_description' WHERE expense_type_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated expense_types', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update expense_types', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
