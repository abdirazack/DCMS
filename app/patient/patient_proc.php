<?php 
// require('./app/database/conn.php');
// require('./app/controller/dbmanager.php');

// $manager = new DatabaseManager();


// $tableName = "patients";
// $columns = [];
// $id = "";
// $update = $manager->update($tableName, $id, $columns);
// if($update){
//     $msg = "success";
//     header("location: ../../index.php?page=patient&&msg=".urlencode("success"));
// }
// else{
//     echo "failed";
// }
?>

<?php
require_once('./encrypt.php');

$plaintext = "hi how are you";
$shift = 4;

$encodec = new encodec();

$msg = $encodec->enco($plaintext, $shift);


header("location: ./patient.php?msg=".urlencode($msg));
exit();
?>