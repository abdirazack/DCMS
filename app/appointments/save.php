
<?php

// Connect to the database
include_once('../database/conn.php');
$patients = mysqli_real_escape_string($conn, $_POST['patients']);
// $service = $_POST['service'];
$employee_id = mysqli_real_escape_string($conn, $_POST['employee']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$time = mysqli_real_escape_string($conn, $_POST['time']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$type  = "Walk-in";

if (empty($patients)) {
        $data = ['message' => 'select a patient', 'status' => 404];
        echo json_encode($data);
        return;
}
if (empty($status)) {
        $data = ['message' => 'select a status', 'status' => 404];
        echo json_encode($data);
        return;
}

if ($id == "") {

        // check if appointment exists
        $checkAppointmentSql = "SELECT * FROM appointments WHERE `date` = '$date' AND `time` = '$time' ";
        $result = mysqli_query($conn, $checkAppointmentSql);
        $appointment = mysqli_fetch_assoc($result);
        if($appointment) {
                $data = ['message' => 'Unfortunatly this time is already booked. Please Choose another date or time.', 'status' => 404];
                echo json_encode($data);
                return;
        }

        $insertAppointmentSql = "INSERT INTO appointments (`Type`, `status`,`date`, `time`, `patient_id`,`employee_id`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertAppointmentSql);
        mysqli_stmt_bind_param($stmt, "ssssii", $type, $status, $date, $time, $patients, $employee_id);
        mysqli_stmt_execute($stmt);
        $appointmentId = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);

 

        // Close the database connection
        mysqli_close($conn);

        if ($result) {
                $data = ['message' => 'Success', 'status' => 200];

                echo json_encode($data);
                return;
        } else {
                $data = ['message' => 'Failed to create appointment: ' . mysqli_error($conn), 'status' => 404];
                echo json_encode($data);
                return;
        }

} else {
        $query = mysqli_query($conn, "update appointments set employee_id= '$employee_id' ,patient_id='$patients',status = '$status', date='$date', time='$time ' where appointment_id='$id'");
        if ($query) {
                $data = ['message' => 'Success', 'status' => 200];
                echo json_encode($data);
                return;
        } else {
                $data = ['message' => 'Failed to update appointment', 'status' => 404];

                echo json_encode($data);
                return;
        }
}

?>