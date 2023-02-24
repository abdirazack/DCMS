<?php 
    include_once('../conn.php');

    if(isset($_POST['updateid'])){
        $id = $_POST['updateid'];
        $sql = "SELECT * FROM users WHERE user_id='$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo json_encode($row);
      }
      

?>