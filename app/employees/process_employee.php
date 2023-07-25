<?php
  // Connect to the database
  include_once('../database/conn.php');



    $id = @$_POST["id"]; 
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn,$_POST["last_name"]);
    $phone_number = mysqli_real_escape_string($conn,$_POST["phone_number"]);
    $gender = mysqli_real_escape_string($conn,$_POST["gender"]);
    $address = mysqli_real_escape_string($conn,$_POST["address"]);
    $hire_date = mysqli_real_escape_string($conn,$_POST["hire_date"]);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $role_id = mysqli_real_escape_string($conn,$_POST["role"]);
    $salary_type = mysqli_real_escape_string($conn,$_POST["salary_type"]);
    $amount = mysqli_real_escape_string($conn,$_POST["amount"]);
    $currency = mysqli_real_escape_string($conn,$_POST["currency"]);
    $experience = mysqli_real_escape_string($conn,$_POST["experience"]);
    $profile = '';

        // get the previouse profile picture
        $sql = "SELECT profile FROM employees WHERE employee_id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        // check if the profile picture is not empty
        if($row['profile'] != ''){
          $oldProfile = $row['profile'];
        }else{
          $oldProfile = '';
        }


    if(isset($_FILES['profile'])){
      $now = new DateTime();
      $name=  $now->getTimestamp(); 
      $filename = $_FILES["profile"]["name"];
      $tempname = $_FILES["profile"]["tmp_name"];
      $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
      $folder = "../img/employee/" . $name.'.'.$ext;
   
      // Now let's move the uploaded image into the folder: image
      if (move_uploaded_file($tempname, $folder)) {
          $profile = $name.'.'.$ext;
          // delete the previouse profile picture
          unlink("../img/employee/".$oldProfile);
      } else {

      }


    }
    else{
      $profile = $oldProfile;
    }

  // Check if the ID field is set (if set, it's an update)
  if ($id == "") {

    // Insert a new employess
    $sql = "INSERT INTO employees (first_name, last_name, email, phone, role_id, experience, address,  gender, profile, salary_type, currency, amount, hire_date) VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$role_id',  '$experience', '$address',  '$gender', '$profile', '$salary_type', '$currency', '$amount',  '$hire_date')";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'Succeesully added employees', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to add employess', 'status'=>404];
        echo json_encode($data);
        return ;
    }



  } else {

        // Update the employess
    $sql = "UPDATE employees SET first_name = '$first_name', last_name = '$last_name', hire_date = '$hire_date', phone = '$phone_number', role_id= '$role_id', salary_type= '$salary_type', currency = '$currency', amount =  '$amount', experience='$experience', gender = '$gender', profile= '$profile', address = '$address', email = '$email' WHERE employee_id='$id'";
    if ($conn->query($sql) === TRUE) {
        $data = ['message'=>'succeffully updated employess', 'status'=>200];
        echo json_encode($data);
        return ;
    } else {
        $data = ['message'=>'failed to update employess', 'status'=>404];
        echo json_encode($data);
        return ;
    }

  }


?>
