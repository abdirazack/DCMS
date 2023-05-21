<?php 
session_start();

if(!isset($_SESSION['user_id']) || !isset($_SESSION['username'])){
    header('location: index.php');
    exit;
}
else{
    header('location: login folder/login.php');
    exit;
}
?>
