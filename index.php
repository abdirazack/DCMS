<?php
    session_start();
    if (!isset($_SESSION['empid'])) {
        header('Location: ./login.php');
    }
// require('app/util/auth.php');
$titles = [
        'dashboard'  => ["title" => 'Dashboard',                                       "path" => './app/dashboard/'],
        'profile'   =>  ["title" => 'Profile',                                         "path" => './app/dashboard/'],    
   
    //Address
        'address'    => ["title" => 'Address',                                         "path" => './app/address/'],

     // Employees
        'employee'   => ["title" => 'Employees',                                       "path" => './app/employees/'],
        'staff'      => ["title" => 'Staff',                                           "path" => './app/staff/'],
        'dentist'    => ["title" => 'Dentists',                                        "path" => './app/dentists/'],
        'role'       => ["title" => 'Roles',                                           "path" => './app/roles/'],
        'salary'     => ["title" => 'Salary',                                          "path" => './app/salary/'],
        'logins'     => ["title" => 'Login Credentials',                               "path" => './app/loginsCredentials/'], // 'auth' => 'Auth
    
    // Patients
        'patients'   => ["title" => 'Patients',                                        "path" => './app/patient/'],

    // appointments                               
        'appointment' => ["title" => 'Appointment',                                     "path" => './app/appointments'],
    //services
        'services'    => ["title" => 'Services',                                        "path" => './app/services'],
        'payments'    => ["title" => 'Payments',                                        "path" => './app/payments'],
        'invoice'     => ["title" => 'Invoice',                                         "path" => './app/invoice'],
    //expenses
        'expenses'    => ["title" => 'Expenses',                                        "path" => './app/expenses'],
    
    //medication
        'drug'          => ["title" => 'Drugs',                                            "path" => './app/drugs'],
        'medication'    => ["title" => 'Medication',                                       "path" => './app/medication'],
        'prescription'  => ["title" => 'Prescriptions',                                    "path" => './app/prescriptions'],

    //Supplier 
        'supplier'    => ["title" => 'Suppliers',                                        "path" => './app/supplier'],
    
    //inventory 
        'inventory'    => ["title" => 'Inventory',                                        "path" => './app/inventory'],
    
    //Equipment 
        'equipment'    => ["title" => 'Equipment',                                         "path" => './app/Equipment'],
    
    //TreatmentPlans & procedure 
        'TreatmentPlans'    => ["title" => 'Treatment Plans',                                "path" => './app/TreatmentPlans'],
        'procedure'    => ["title" => 'Procedure',                                         "path" => './app/procedure'],

    //Login Page
        'login'     =>  ["title" => 'Login',                                           "path" => './app/login/'],
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
require_once($is404 ? './includes/404.php' : $file );

// ECHO '<div class="mb-2"></div>';
require_once('./includes/footer.php');
?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <link href="./vendor/DataTables/datatables.css" rel="stylesheet">
    <link href="./vendor/select2/css/select2.css" rel="stylesheet">

    

    <script src="./vendor/DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="./vendor/DataTables/DataTables/js/dataTables.bootstrap5.min.js"></script>
    <script src="./vendor/select2/js/select2.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->