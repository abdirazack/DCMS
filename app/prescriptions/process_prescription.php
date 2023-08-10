<?php
// Connect to the database
include_once('../database/conn.php');

$id = @$_POST["id"];
$patient_id =  $_POST["patient_id"];
$medications =  $_POST["medication_id"];
$instructions =  $_POST["instructions"];
$dates_prescribed =  $_POST["date_prescribed"];

// Check if the ID field is set (if set, it's an update)
if (is_array($medications) && is_array($instructions) && is_array($dates_prescribed)) {
  for ($i = 0; $i < count($medications); $i++) {
    $medication = $medications[$i];
    $instruction = $instructions[$i];
    $date_prescribed = $dates_prescribed[$i];

    if ($id == "") {
      // Insert a new prescription
      $sql = "INSERT INTO prescriptions (patient_id, medication_id, instructions, date_prescribed) VALUES ('$patient_id', '$medication', '$instruction', '$date_prescribed')";
    } else {
      // Update the prescription
      $sql = "UPDATE prescriptions SET patient_id='$patient_id', medication_id='$medication', instructions='$instruction', date_prescribed='$date_prescribed' WHERE prescription_id='$id'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $data = ['message' => ($id == "") ? 'Successfully added prescription' : 'Successfully updated prescription', 'status' => 200];
      echo json_encode($data);
    } else {
      $data = ['message' => ($id == "") ? 'Failed to add prescription' : 'Failed to update prescription', 'status' => 404];
      echo json_encode($data);
    }
  }
} else {
  $data = ['message' => 'Something is wrong with the arrays', 'status' => 404];
  echo json_encode($data);
}
