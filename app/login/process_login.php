<?php
// Include the database connection file
include_once('../database/conn.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validate the username and password
  if (!empty($username) && !empty($password)) {
    // Prepare the SQL query to retrieve the user from the database
    $query = "SELECT * FROM logincredentials WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    // If the user exists
    if ($result->num_rows > 0) {
      // Retrieve the user details
      $row = $result->fetch_assoc();
      $empid = $row['employee_id'];
      

      // Start the session
      session_start();
      $_SESSION['isAdmin'] = $row['isAdmin'];
      // Store the user details in session variables
      $_SESSION['empid'] = $empid;
      $query = "SELECT first_name, last_name, profile FROM employees WHERE employee_id = '$empid'";
      $result = $conn->query($query);
      $rows = $result->fetch_assoc();
      $_SESSION['employee_name'] = $rows['first_name'] . ' ' . $rows['last_name'];
      $_SESSION['profile'] = $rows['profile'];
   
  
      // Redirect to the dashboard
      header('Location: ../../index.php?page=dashboard');
    }
    else {
      // Invalid username or password
      echo "<center><h2 style='color: red;' class='mt-4'>Invalid username or password</h2></center>";
    }
  }
   else {
    // All fields are required
    echo "<center><h2 style='color: red;' class='mt-4'>All fields are required</h2></center>";
  }
}

?>
