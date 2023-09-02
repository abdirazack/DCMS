<?php
    include_once('./includes/loader.php');
    // include_once('auth.php');
    session_start();
    if (!isset($_SESSION['empid'])) {
        header('Location: ./login.php');
    }
// require('app/util/auth.php');
$titles = [
        'dashboard'  => ["title" => 'Dashboard',                                       "path" => './app/dashboard/'],
        'profile'   =>  ["title" => 'Profile',                                         "path" => './app/profile/'],
        'changePassword' => ["title" => 'Change Password',                             "path" => './app/profile/'],
        'changePic' => ["title" => 'Change Profile Picture',                          "path" => './app/profile/'],

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
        "patient_service" => ["title" => 'Patient Service',                             "path" => './app/patientService/'], // "patient_service" => "Patient Service
        'feedbacks'  => ["title" => 'Feedbacks',                                       "path" => './app/patient/'],
    // appointments                               
        'appointment' => ["title" => 'Appointment',                                     "path" => './app/appointments'],
    //services
        'services'    => ["title" => 'Services',                                        "path" => './app/services'],
        'payments'    => ["title" => 'Payments',                                        "path" => './app/payments'],
        'invoice'     => ["title" => 'Invoice',                                         "path" => './app/invoice'],
    //expenses
        'expenses'    => ["title" => 'Expenses',                                        "path" => './app/expenses'],
        'expense_type'=> ["title" => 'Expense Type',                                    "path" => './app/expense_types'],
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

    //Reports
        'reports'    => ["title" => 'Reports',                                         "path" => './app/reports/'],
        'patient_reports' => ["title" => 'Patient Reports',                               "path" => './app/reports/rangeReports/'],
        'income_reports' => ["title" => 'Income Reports',                                 "path" => './app/reports/rangeReports/'],
        'expense_reports' => ["title" => 'Expense Reports',                               "path" => './app/reports/rangeReports/'],
        'employee_reports' => ["title" => 'Employee Reports',                             "path" => './app/reports/rangeReports/'],

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
