<?php 
    include_once('../database/conn.php');

    if(isset($_POST['updateid'])){
        $id = $_POST['updateid'];
        $sql = "SELECT * FROM salary_employee_view WHERE salary_id='$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo json_encode($row);
      }
      
    if(isset($_POST['employee_id'])){
        $employee_id = $_POST['employee_id'];
        $sql = "SELECT * FROM employees WHERE employee_id='$employee_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo json_encode($row);
    }

?>