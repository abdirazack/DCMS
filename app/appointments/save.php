
<?php
require_once '../conn.php';
extract($_POST);
// Check that a user id was submitted
if(isset($_POST['patients'])){
    $patients= mysqli_real_escape_string($conn, $_POST['patients']);
    $service=mysqli_real_escape_string($conn, $_POST['service']);
    $start_datetime=mysqli_real_escape_string($conn, $_POST['start_datetime']);
    $end_datetime=mysqli_real_escape_string($conn, $_POST['end_datetime']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $dentst = 1;
    $type = 'Walk-in';


    if(empty($patients)){
        $data = ['message'=>'select a patient', 'status'=>404];
        echo json_encode($data);
        return ;
    }
    elseif(empty($service)){
        $data = ['message'=>'select a service', 'status'=>404];
        echo json_encode($data);
        return ;
    }
    else{
    //     $check_patient = mysqli_query($conn, "select * from patients where first_name = '$patients'");
    //     $row = mysqli_fetch_array($check_patient);
    //    // $patient_id = $row['patient_id'];
        
        
            $query=mysqli_query($conn,"insert into appointments values('Walk-in','$patients','$service','$start_datetime','$end_datetime')");
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
    }
    if(isset($_POST['id'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $patients= mysqli_real_escape_string($conn, $_POST['patients']);
        $service=mysqli_real_escape_string($conn, $_POST['service']);
        $start_datetime=mysqli_real_escape_string($conn, $_POST['start_datetime']);
        $end_datetime=mysqli_real_escape_string($conn, $_POST['end_datetime']);
        if(empty($patients)){
            $data = ['message'=>'select a patient', 'status'=>404];
            echo json_encode($data);
            return ;
        }
        elseif(empty($service)){
            $data = ['message'=>'select a service', 'status'=>404];
            echo json_encode($data);
            return ;
        }
        else{
            $check_patient = mysqli_query($conn, "select * from patients where first_name = '$patients'");
            $row = mysqli_fetch_array($check_patient);
            $patient_id = $row['patient_id'];
            $query=mysqli_query($conn,"update appointments set patient_id='$patient_id',service='$service',start_date='$start_datetime',end_date='$end_datetime' where appointment_id='$id'");
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
    }

?>