    <?php

    //connect to database
    include('../database/conn.php');


    session_start();
    //get the id of the record to be updated
    $id = $_SESSION["empid"];

    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $sql = "UPDATE employees SET first_name='$firstName',  last_name='$lastName', phone='$phoneNumber', email='$email', address='$address' WHERE employee_id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // change employee session name
        $_SESSION["employee_name"] = $firstName . ' ' . $lastName;
        $data = ['message' => 'succeffully Changed Profile Details ', 'status' => 200];
        echo json_encode($data);
    } else {
        $data = ['message' => 'Failed to  Change Profile Details', 'status' => 404];
        echo json_encode($data);
    }


