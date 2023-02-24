<?php
// Connect to the database
include_once('../conn.php');


    $id = @$_POST["id"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $user_type = $_POST["user_type"];



  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new expense
    $sql = "INSERT INTO users (username, password,  user_type) VALUES ( '$username','$password', '$user_type')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added user', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add user', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the expense
    $sql = "UPDATE users SET username='$username', password='$password', user_type='$user_type' WHERE user_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated user', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update user', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }

  
?>
