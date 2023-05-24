<?php

// require('app/util/auth.php');

$titles = [
    'dashboard' => 'Home',
    // books
        'staff'       => ["title" => 'Staff',                                           "path" => './app/staff/'],
        'patients'    => ["title" => 'Patients',                                        "path" => './app/patient/'],

    // users and members                                
        'new_member'   => ["title" => 'Add New Member',                                 "path" => './app/members'],
        'add_user'   =>   ["title" => 'Add New User',                                     "path" => './app/users'],
        'view_members' => ["title" => 'View Members',                                   "path" => './app/members'],
    // appointments                               
        'appointment' => ["title" => 'Appointment',                                     "path" => './app/appointments'],
    //services
        'services'    => ["title" => 'Services',                                        "path" => './app/services'],

    //expenses
        'expenses'    => ["title" => 'Expenses',                                        "path" => './app/expenses'],
    
    //medication
        'medication'    => ["title" => 'Medication',                                        "path" => './app/medication'],

    // payments                             
        'pay_member' => ["title" => 'Add New Payment',                                  "path" => './payments'],
        'pay_all'    => ["title" => 'Pay All Members',                                  "path" => './payments'],
        //'expenses'   => ["title" => 'New Expenses',                                     "path" => './payments'],


];
$is404 = false;
$page = '';
if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
    $title = $titles[$page]["title"];
    $file = $titles[$page]["path"]."/$page.php";

    // $FOF = ;
    if(!file_exists($file)){
        $is404 = true;
    }
}
elseif(!in_array($page, $titles)){
    $is404 = true;
}
else{
    header("Location: index.php?page=dashboard");
}
require_once('./includes/header.php');
require_once('./includes/sidebar.php');
require_once($is404 ? 'dashboard.php' : $file );

ECHO '<div class="mb-2"></div>';
require_once('./includes/footer.php');
?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="./vendor/DataTables/datatables.css" rel="stylesheet">
    <link href="./vendor/select2/css/select2.css" rel="stylesheet">
    
    <script src="./vendor/DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="./vendor//DataTables/DataTables/js/dataTables.bootstrap5.min.js"></script>
    <script src="./vendor/select2/js/select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>