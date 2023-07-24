
<?php
        // Connect to the database
        include_once('../database/conn.php') ;
        $patients= mysqli_real_escape_string($conn, $_POST['patients']);
        $service=mysqli_real_escape_string($conn, $_POST['service']);
        $employee_id=mysqli_real_escape_string($conn, $_POST['employee']);
        $date =mysqli_real_escape_string($conn, $_POST['date']);
        $time =mysqli_real_escape_string($conn, $_POST['time']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
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
                $query=mysqli_query($conn,"insert into appointments values(null,'Walk-in', '$status','$date','$time ', '$patients', '$employee_id','$service')");
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
                $query=mysqli_query($conn,"update appointments set employee_id= '$employee_id' ,patient_id='$patients',status = '$status', date='$date', time='$time ' where appointment_id='$id'");
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