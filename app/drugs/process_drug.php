<?php
include_once("../database/conn.php");
session_start();
// Retrieve the form data
$id = @$_POST['id'];
$costs = $_POST['cost'];
$quantities = $_POST['quantity'];
$expiry_dates = $_POST['expiry_date'];
$patient_id = $_POST['patient_id'];
$employee_id = $_SESSION['empid'];
$medication_ids = $_POST['medication_id'];
$prescribed_date = $_POST['prescribed_date'];

if ($id == "") {
    // Verify that the arrays contain elements before using the count() function
    if (is_array($medication_ids) && is_array($quantities) && is_array($costs)) {
        // Iterate over the arrays
        for ($i = 0; $i < count($medication_ids); $i++) {
            $medication_id = $medication_ids[$i];
            $quantity = $quantities[$i];
            $cost = $costs[$i];
            $expiry_date = $expiry_dates[$i];
            $prescribed_date = $prescribed_date[$i];


            // Insert the values into the database
            $query = "INSERT INTO `drugs` ( `drug_cost`, `drug_quantity`,`drug_expiry_date`,`patient_id`, `employee_id`,`medication_id`,`date_prescribed`) VALUES ('$cost','$quantity','$expiry_date','$patient_id','$employee_id' ,'$medication_id', '$prescribed_date' )";
            // $result = mysqli_query($conn, $query);
            echo "<script>console.log('$query')</script>";
            if ($conn->query($query) === TRUE) {
                
                $patientExistsInIncome = False ;
                $queryToCheck = "SELECT * FROM incometable WHERE patient_id = '$patient_id' and IncomeType='Medications'";
                $res = mysqli_query($conn, $queryToCheck);
                if (mysqli_num_rows($res) > 0) {
                    $patientExistsInIncome = True;
                } else {
                    $patientExistsInIncome = False;
                }


                if ($patientExistsInIncome) {

                    $updateIncome = "UPDATE IncomeTable SET IncomeAmount = IncomeAmount + '$cost' WHERE patient_id = '$patient_id'";
                    $result = mysqli_query($conn, $updateIncome);
                    if ($result) {
                        $data = ['message' => 'Succeesully updated IncomeTable', 'status' => 200];
                        echo json_encode($data);
                    } else {
                        $data = ['message' => 'Failed to update  IncomeTable', 'status' => 404];
                        echo json_encode($data);
                    }
                } else {

                    $insertIntoIncome = "INSERT INTO `IncomeTable` (`patient_id`, `IncomeType`, `IncomeAmount`,  `IncomeDate`) VALUES ('$patient_id', 'Medications', '$cost', NOW())";
                    $result = mysqli_query($conn, $insertIntoIncome);
                    if ($result) {
                        $data = ['message' => 'Succeesully added IncomeTable', 'status' => 200];
                        echo json_encode($data);
                    } else {
                        $data = ['message' => 'Failed to add  IncomeTable', 'status' => 404];
                        echo json_encode($data);
                    }
                    
                }
            } else {
                $data = ['message' => 'Failed to add  patient_Service', 'status' => 404];
                echo json_encode($data);
            }
        }
    } else {
        $data = ['message' => 'Something is wrong with te arrays', 'status' => 404];
        echo json_encode($data);
        return;
    }
} else {

    for ($i = 0; $i < count($medication_ids); $i++) {
      $medication_id = $medication_ids[$i];
      $quantity = $quantities[$i];
      $cost = $costs[$i];
      $expiry_date = $expiry_dates[$i];
      $prescribed_date = $prescribed_date[$i];

        $query = "UPDATE drugs SET patient_id = '$patient_id', medication_id = '$medication_id', employee_id='$employee_id', drug_quantity = '$quantity', drug_cost = '$cost',date_prescribed = '$prescribed_date',drug_expiry_date='$expiry_date',  WHERE drug_id = '$id'";
        echo $query;
        $result = mysqli_query($conn, $query);
        if ($result) {

            $data = ['message' => 'Succeesully updated patient_Service', 'status' => 200];
            echo json_encode($data);
        } else {
            $data = ['message' => 'Failed to update  patient_Service', 'status' => 404];
            echo json_encode($data);
        }
    }
}
