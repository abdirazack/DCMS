<?php
include_once("../database/conn.php");

// Retrieve the form data
$id = @$_POST['id'];
$patient_id = $_POST['patient_id'];
$service_ids = $_POST['service_id'];
$quantities = $_POST['quantity'];
// $discounts = $_POST['discount'];
$costs = $_POST['cost'];

// Verify that the arrays contain elements before using the count() function
if (is_array($service_ids) && is_array($quantities) && is_array($costs)) {
    // Iterate over the arrays
    for ($i = 0; $i < count($service_ids); $i++) {
        $service_id = $service_ids[$i];
        $quantity = $quantities[$i];
        $cost = $costs[$i];

        if ($id == "") {
            // Insert the values into the database
            $query = "INSERT INTO `patientServices` (`patient_id`, `service_id`, `quantity`, `cost`) VALUES ('$patient_id', '$service_id', '$quantity', '$cost')";
        } else {
            // Update the values in the database
            $query = "UPDATE patientservices SET patient_id = '$patient_id', service_id = '$service_id', quantity = '$quantity', cost = '$cost'  WHERE patientService_id = '$id'";
        }

        $result = mysqli_query($conn, $query);

        if ($result) {
            if ($id == "") {
                // Check if the patient exists in the income table
                $queryToCheck = "SELECT * FROM incometable WHERE patient_id = '$patient_id' AND IncomeType='Services'";
                $res = mysqli_query($conn, $queryToCheck);

                if (mysqli_num_rows($res) > 0) {
                    // Update the existing income entry
                    $updateIncome = "UPDATE IncomeTable SET IncomeAmount = IncomeAmount + '$cost' WHERE patient_id = '$patient_id'";
                    $resultIncome = mysqli_query($conn, $updateIncome);

                    if ($resultIncome) {
                        $data = ['message' => 'Successfully updated IncomeTable', 'status' => 200];
                        echo json_encode($data);
                    } else {
                        $data = ['message' => 'Failed to update IncomeTable', 'status' => 404];
                        echo json_encode($data);
                    }
                } else {
                    // Insert a new income entry
                    $insertIntoIncome = "INSERT INTO `IncomeTable` (`patient_id`, `IncomeType`, `IncomeAmount`,  `IncomeDate`) VALUES ('$patient_id', 'Services', '$cost', NOW())";
                    $resultIncome = mysqli_query($conn, $insertIntoIncome);

                    if ($resultIncome) {
                        $data = ['message' => 'Successfully added IncomeTable', 'status' => 200];
                        echo json_encode($data);
                    } else {
                        $data = ['message' => 'Failed to add IncomeTable', 'status' => 404];
                        echo json_encode($data);
                    }
                }
            } else {
                $data = ['message' => 'Successfully updated patient_Service', 'status' => 200];
                echo json_encode($data);
            }
        } else {
            if ($id == "") {
                $data = ['message' => 'Failed to add patient_Service', 'status' => 404];
            } else {
                $data = ['message' => 'Failed to update patient_Service', 'status' => 404];
            }
            echo json_encode($data);
        }
    }
} else {
    $data = ['message' => 'Something is wrong with the arrays', 'status' => 404];
    echo json_encode($data);
}
