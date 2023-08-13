<?php
// Connect to the database
include_once('../database/conn.php');

// Validate and sanitize inputs
$id = @$_POST["id"];
$patient_id = isset($_POST["patient_id"]) ? intval($_POST["patient_id"]) : 0;
$amount = isset($_POST["amount"]) ? floatval($_POST["amount"]) : 0.0;
$amount_paid = isset($_POST["amount_paid"]) ? floatval($_POST["amount_paid"]) : 0.0;
$amountDue = isset($_POST["amountDue"]) ? floatval($_POST["amountDue"]) : 0.0;
$discount = isset($_POST["discount"]) ? floatval($_POST["discount"]) : 0.0;
$date_paid = isset($_POST["date_paid"]) ? mysqli_real_escape_string($conn, $_POST["date_paid"]) : "";
// $payment_method = isset($_POST["payment_method"]) ? mysqli_real_escape_string($conn, $_POST["payment_method"]) : "";

// Check if the ID field is set (if set, it's an update)
if ($id == "") {
  $data = ['message' => 'Cannot directly insert new record from here.', 'status' => 404];
  echo json_encode($data);
  return;
} else {
  // Prepare the UPDATE query using a prepared statement
  $stmt = $conn->prepare("UPDATE incometable SET patient_id=?, discount=discount+?, IncomeAmountPaid=IncomeAmountPaid+?, IncomeDate=? WHERE IncomeID=?");
  $stmt->bind_param("idssi", $patient_id, $discount, $amount_paid, $date_paid, $id);

  if ($stmt->execute()) {
    $data = ['message' => 'Successfully updated payments', 'status' => 200];
    echo json_encode($data);
    return;
  } else {
    $data = ['message' => 'Failed to update payments', 'status' => 404];
    echo json_encode($data);
    return;
  }
}
