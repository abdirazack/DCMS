<?php
  // Connect to the database
  include_once('../database/conn.php');


    $id = @$_POST["id"];
    $patient_id = mysqli_real_escape_string($conn, $_POST["patient_id"]);
    $total_cost = mysqli_real_escape_string($conn, $_POST["total_cost"]);
    $paid = mysqli_real_escape_string($conn, $_POST["paid"]);
    $invoice_date = mysqli_real_escape_string($conn, $_POST["invoice_date"]);

    $status = '';
    // make status 1 if paid is paid using ternary operator
    $status = $status = ($paid == "paid") ? 1 : 0;
    


  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new invoices
    $sql = "INSERT INTO invoices (patient_id, invoice_date, total_cost, paid) VALUES ('$patient_id', '$invoice_date', '$total_cost', '$status')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added invoices', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add invoices', 'status'=>404];
        echo json_encode($data);
        return ;
    }
  }
  else {
        // Update the invoices
    $sql = "UPDATE invoices SET patient_id = '$patient_id', invoice_date = '$invoice_date', total_cost = '$total_cost', paid	 = '$paid' WHERE invoice_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated invoices', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update invoices', 'status'=>404];
        echo json_encode($data);
        return ;
    }
  }

  
?>
