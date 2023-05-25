
<?php
  // Connect to the database
  include_once('../database/conn.php') ;
  $patients= mysqli_real_escape_string($conn, $_POST['patients']);
  $service=mysqli_real_escape_string($conn, $_POST['service']);
  $start_datetime=mysqli_real_escape_string($conn, $_POST['start_datetime']);
  $end_datetime=mysqli_real_escape_string($conn, $_POST['end_datetime']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  $dentist = 1;
  $type = 'Walk-in';
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if(empty($patients)){
        $data = ['message'=>'select a patient', 'status'=>404];
        echo json_encode($data);
        return ;
    }
    if(empty($service)){
        $data = ['message'=>'select a service', 'status'=>404];
        echo json_encode($data);
        return ;
    }
   
    if($id==""){
    $query=mysqli_query($conn,"insert into appointments values(null,'Walk-in', '$status','$start_datetime','$end_datetime', '$patients', '$dentist','$service')");
    echo $query;
    if($query){
            $data = ['message'=>'Success', 'status'=>200];
            echo json_encode($data);
            return ;
    }else{
            $data = ['message'=>'Failed to create appointment', 'status'=>404];
            echo json_encode($data);
            return ;
    }
        
}
else{
    $query=mysqli_query($conn,"update appointments set dentist_id= '$dentist' ,patient_id='$patients',status = '$status', service_id ='$service',start_date='$start_datetime',end_date='$end_datetime' where appointment_id='$id'");
    if($query){
            $data = ['message'=>'Success', 'status'=>200];
            echo json_encode($data);
            return ;
    }else{
            $data = ['message'=>'Failed to update appointment', 'status'=>404];
            echo json_encode($data);
            return ;
    }
        }

?>