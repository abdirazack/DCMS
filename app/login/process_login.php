<?php
// Include the database connection file
require_once('../database/conn.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validate the username and password
  if (!empty($username) && !empty($password)) {
    // Prepare the SQL query to retrieve the user from the database
    $query = "SELECT * FROM logincredentials WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    // Check if a matching user is found
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
      // Start the session and store the username
      session_start();
      $_SESSION['username'] = $username;
      
      // Redirect to the home page or any desired page after successful login
      header("Location: .../index.php?page=dashboard.php");
      exit();
    } else {
      // Invalid username or password
      echo "<center><h2 style='color: red;' class='mt-4'>Wrong credentials. Please try again</h2></center>";
    }

    // Close the statement
    $stmt->close();
  }
   else {
    // All fields are required
    echo "<center><h2 style='color: red;' class='mt-4'>All fields are required</h2></center>";
  }
}
?>
