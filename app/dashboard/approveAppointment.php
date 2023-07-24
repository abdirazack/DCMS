<?php
    // coonect to database
    include_once('../database/conn.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $query = "UPDATE appointments SET status = 'Approved' WHERE appointment_id = $id;";
        $result = $conn->query($query);
        if($result){
            $data = ['message'=>'Success', 'status'=>200];
            echo json_encode($data);
            return ;
        } else {
            $data = ['message'=>'failed to Approve Appointment', 'status'=>404];
            echo json_encode($data);
            return ;
        }
    }
    else{
        $data = ['message'=>'ID is not set', 'status'=>404];
        echo json_encode($data);
        return ;
    } 
?>