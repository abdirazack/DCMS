<?php
// Connect to the database
include_once('../database/conn.php');

    $id = @$_POST["id"];
    $street = mysqli_real_escape_string($conn, $_POST["street"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $state =  mysqli_real_escape_string($conn, $_POST["state"]);
    // $page = mysqli_real_escape_string($conn, $_POST["page"]);


    


    if ($id != '') {
        $sql = "UPDATE addresses SET street='$street', city='$city', state='$state' WHERE address_id='$id'";
        if ($conn->query($sql) === TRUE) {
            $data = ['message' => 'success', 'status' => 200];
            echo json_encode($data);
            return;
         
        } else {
          $data = ['message' => 'Failed', 'status' => 404];
          echo json_encode($data);
          return;
        }
    } else {
        $sql = "INSERT INTO addresses (street, city, state) VALUES ('$street', '$city', '$state')";
        if ($conn->query($sql) === TRUE) {
         
            $data = ['message' => 'success', 'status' => 200];
            echo json_encode($data);
            return;
        } else {
          $data = ['message' => 'Failed', 'status' => 404];
          echo json_encode($data);
          return;
        }
    }

?>
