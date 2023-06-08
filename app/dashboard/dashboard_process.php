<?php
    // Connect to the database
    include_once('../database/conn.php');

    // Define an array of table names and their identifiers
    $tables = [
        "patients" => "patientNumber",
        "dentists" => "dentistNumber",
        "staff" => "staffNumber"
    ];

    // Initialize an empty array to store the counts
    $counts = [];

    // Fetch the counts for each table
    foreach ($tables as $table => $identifier) {
        $query = "SELECT COUNT(*) AS total FROM $table";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $counts[$identifier] = $row["total"];
    }

    // Close the database connection
    $conn->close();

    // Convert the counts array to JSON format and send it to the client-side
    echo json_encode($counts);
?>

