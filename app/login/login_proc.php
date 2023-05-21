<?php
require_once('../includes/conn.php');
// if(!isset($_SESSION)){
	session_start();	
// }


if(isset($_POST['logout'])){
  session_unset();
  session_destroy();
  exit();
}

else{

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim( $_POST['username']);
    $password = trim($_POST['password']);
  
    try {
      $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
      $stmt->execute([$username]);
      $user = $stmt->fetch();
  
      if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['first_name'];
        $_SESSION['middlename'] = $user['middle_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['last_login_date'] = $user['last_login_date'];
  
        $stmt = $conn->prepare('UPDATE users SET last_login_date = ? WHERE user_id = ?');
        $stmt->execute([date('Y-m-d H:i:s'), $user['user_id']]);
  
        header('Location: ../index.php');
        exit();
      } else {
        $error_message = 'Invalid username or password.';
        header('Location: login.php?error_message=' . urlencode($error_message));
        exit();
      }
    }
    catch(PDOException $e) {
      $error_message = $e->getMessage();
      header('Location: login.php?error_message='. urlencode($error_message));
      exit();
    }
  }
}
?>

<?php
session_start();
require_once 'conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password using MD5
$passwordHash = md5($password);

if (isset($_POST['btnLogin'])) {
    if (empty($username) || empty($password)) {

        echo "<h2 style=color:'red'>All Fields are required</h2>";
        include_once("index.php");
    } else {

        // Look up the user in the database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$passwordHash'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userType = $row['user_type'];

            if ($userType == 'Admin') {
                $_SESSION['username'] = $res['username'];
                $_SESSION['userid'] = $res['userID'];
                header("location: home.php");
            } elseif ($userType == 'Staff') {
                $_SESSION['username'] = $res['username'];
                $_SESSION['userid'] = $res['userID'];
                header("location: test.php");
            } elseif ($userType == 'Patient') {
                $_SESSION['username'] = $res['username'];
                $_SESSION['userid'] = $res['userID'];
                header("location: patient.php");
            } else {
                // If the user doesn't exist or the password is incorrect, show an error message
                echo "Invalid username or password";
            }
        } else {
            echo "<center><h2 style='color: red;' class='mt-4'>Wrong credientails please Try Again</h2></center>";
            include("index.php");
        }
    }
}
