<?php
    include_once("../database/conn.php");

    // Retrieve the form data
    $id = @$_POST['id'];
    $patient_id = $_POST['patient_id'];
    $service_ids = $_POST['service_id'];
    $quantities = $_POST['quantity'];
    $costs = $_POST['cost'];

    if($id==""){
        // Verify that the arrays contain elements before using the count() function
        if (is_array($service_ids) && is_array($quantities) && is_array($costs)) {
            // Iterate over the arrays
            for ($i = 0; $i < count($service_ids); $i++) {
                $service_id = $service_ids[$i];
                $quantity = $quantities[$i];
                $cost = $costs[$i];
                
                // Insert the values into the database
                $query = "INSERT INTO `patientServices` (`patient_id`, `service_id`, `quantity`, `cost`) VALUES ('$patient_id', '$service_id', '$quantity', '$cost')";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $data = ['message'=>'Succeesully added patient_Service', 'status'=>200];
                    echo json_encode($data);
        
                } else {
                    $data = ['message'=>'Failed to add  patient_Service', 'status'=>404];
                    echo json_encode($data);

                }
            }
        } else {
            $data = ['message'=>'Something is wrong with te arrays', 'status'=>404];
            echo json_encode($data);
            return;
        }
    }
    else{

        for ($i = 0; $i < count($service_ids); $i++) {
            $service_id = $service_ids[$i];
            $quantity = $quantities[$i];
            $cost = $costs[$i];
        
            $query = "UPDATE patientservices SET patient_id = '$patient_id', service_id = '$service_id', quantity = '$quantity', cost = '$cost'  WHERE patientService_id = '$id'";
            echo $query;
            $result = mysqli_query($conn, $query);
            if ($result) {
                $data = ['message'=>'Succeesully updated patient_Service', 'status'=>200];
                echo json_encode($data);

            } else {
                $data = ['message'=>'Failed to update  patient_Service', 'status'=>404];
                echo json_encode($data);

            }
    }
    }
