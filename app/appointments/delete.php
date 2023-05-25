<?php

include_once('../database/conn.php') ;

//delete appointment
if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $query=mysqli_query($conn,"delete from appointments where appointment_id='$id'");
    if($query){
        $data = ['message'=>'Success', 'status'=>200];
        echo json_encode($data);
        return ;
    }else{
        $data = ['message'=>'Failed to delete appointment', 'status'=>404];
        echo json_encode($data);
        return ;
    }
}


?>