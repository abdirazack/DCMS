<?php
include_once('../database/conn.php');

if(isset($_POST['deleteid'])){
    //delete payments
    $id = $_POST['deleteid'];
    $sql = mysqli_query($conn,"DELETE FROM incometable WHERE IncomeID='$id'");

    if($sql){
        $data = ['message'=>'success', 'status'=>200];
                echo json_encode($data);
                return ;
        
    }
    else{
        $data = ['message'=>'failed to delete payments', 'status'=>404];
        echo json_encode($data);
        return ;
    }
}