<?php
include_once('../database/conn.php');

$sql = "UPDATE appointments SET viewed = 1 WHERE viewed = 0";
if ($conn->query($sql) === TRUE) {
    $data = ['message'=>'succeffully updated appointments', 'status'=>200];
    echo json_encode($data);
    return ;
} else {
    $data = ['message'=>'failed to update appointments', 'status'=>404];
    echo json_encode($data);
    return ;
}
?>