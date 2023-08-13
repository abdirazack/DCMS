<?php
// Include the database connection file
include_once('../database/conn.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validate and sanitize the username and password
  $username = mysqli_real_escape_string($conn, $username);

  if (!empty($username) && !empty($password)) {
    // Prepare the SQL query using a prepared statement
    $query = "SELECT * FROM logincredentials WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the user exists
    if ($result->num_rows > 0) {
      // Retrieve the user details
      $row = $result->fetch_assoc();
      $empid = $row['employee_id'];

      // Start the session
      session_start();
      $_SESSION['isAdmin'] = $row['isAdmin'];

      // Use a new query for employee details
      $query = "SELECT first_name, last_name, profile FROM employees WHERE employee_id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param('i', $empid);
      $stmt->execute();
      $employeeResult = $stmt->get_result();
      $employeeRow = $employeeResult->fetch_assoc();

      $_SESSION['empid'] = $empid;
      $_SESSION['employee_name'] = $employeeRow['first_name'] . ' ' . $employeeRow['last_name'];
      $_SESSION['profile'] = $employeeRow['profile'];

      // Redirect to the dashboard
      header('Location: ../../index.php?page=dashboard');
      exit(); // Always exit after a header redirect
    } else {
      // Invalid username or password
      echo "<center><h2 style='color: red;' class='mt-4'>Invalid username or password</h2></center>";
    }
  } else {
    // All fields are required
    echo "<center><h2 style='color: red;' class='mt-4'>All fields are required</h2></center>";
  }
} else {
  echo "<center><h2 style='color: red;' class='mt-4'>Invalid request</h2></center>";
  header('Location: ../../login.php');
}
