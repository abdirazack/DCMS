<?php
// Assuming you have established a database connection

// Retrieve the form data
$patient_id = $_POST['patient_id'];
$service_ids = $_POST['service_id'];
$quantities = $_POST['quantity'];
$costs = $_POST['cost'];

// Verify that the arrays contain elements before using the count() function
if (is_array($service_ids) && is_array($quantities) && is_array($costs)) {
    // Iterate over the arrays
    for ($i = 0; $i < count($service_ids); $i++) {
        $service_id = $service_ids[$i];
        $quantity = $quantities[$i];
        $cost = $costs[$i];
        
        // Insert the values into the database
        $query = "INSERT INTO `patient_services` (`patient_id`, `service_id`, `quantity`, `cost`) VALUES ('$patient_id', '$service_id', '$quantity', '$cost')";
        echo $query;
    }
} else {
   echo 'One or more of the arrays is empty';
   echo $costs;
   echo $quantities;
    echo $service_ids;
}


?>
