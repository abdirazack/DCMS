<?php
include_once('../database/conn.php');

if(isset($_POST['deleteid'])){
    //delete addresses
    $id = $_POST['deleteid'];
    $sql = mysqli_query($conn,"DELETE FROM addresses WHERE address_id='$id'");

    if($sql){
        $data = ['message'=>'success', 'status'=>200];
                echo json_encode($data);
                return ;
        
    }
    else{
        $data = ['message'=>'failed to delete addresses', 'status'=>404];
        echo json_encode($data);
        return ;
    }
}