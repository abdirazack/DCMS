
<?php
/* This code deletes a patient from the database. The deleteid variable is passed in by the patient.html page when the user clicks on the delete button. The code attempts to delete the patient from the database, and returns a success message if the delete is successful, and an error message if the delete fails. */
include_once('../database/conn.php');
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

if (isset($_POST['deleteid'])) {
    //delete service
    $id = $_POST['deleteid'];
    $chk = mysqli_query($conn, "SELECT * FROM appointments  WHERE patient_id='$id'");

    if (mysqli_num_rows($chk) > 0) {
        $data = ['message' => 'Error deleting patient: Constraint (Patient Exists in another table.)', 'status' => 404];
        echo json_encode($data);
        return;
    } else {
        $sql = mysqli_query($conn, "DELETE FROM patients WHERE patient_id='$id'");

        if ($sql) {
            $data = ['message' => 'success', 'status' => 200];
            echo json_encode($data);
            return;
        } else {
            $data = ['message' => 'Failed To delete Pateint.', 'status' => 404];
            echo json_encode($data);
            return;
        }
    } 
} else {
    $msg =  "Error deleting patient: " . "No post data received";
    $data = ['message' => "$msg", 'status' => 404];
    echo json_encode($data);
    return;
}
?>
