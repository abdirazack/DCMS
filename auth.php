<?php 
session_start();

if(isset($_SESSION['empid'])){
    header('location: index.php?page=dashboard');
    exit;
}
else{
    header('location: ./login.php');
    exit;
}
?>
