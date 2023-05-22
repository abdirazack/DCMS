<?php

// require('app/util/auth.php');

$titles = [
    'dashboard' => 'Home',
    // books
        'staff'       => ["title" => 'Staff',                                           "path" => './app/staff/'],
        'view_books'  => ["title" => 'View Books',                                      "path" => './app/books/'],
        'issue_book'  => ["title" => 'Issue Book',                                      "path" => './app/books/issue_book'],
        'return_book' => ["title" => 'Return Book',                                     "path" => './app/books/return_book'],
    // users and members                                
        'new_member'   => ["title" => 'Add New Member',                                 "path" => './app/members'],
        'add_user'   =>   ["title" => 'Add New User',                                     "path" => './app/users'],
        'view_members' => ["title" => 'View Members',                                   "path" => './app/members'],
    // new tab elements                                
        'author'   => ["title" => 'Add New Author',                                     "path" => './new_tabs/author'],
        'publisher'   => ["title" => 'Add New Publisher',                               "path" => './new_tabs/publisher'],
        'genre'   => ["title" => 'Add New Genre',                                       "path" => './new_tabs/genre'],
        'language'   => ["title" => 'Add New Book Language',                            "path" => './new_tabs/language'],
        'cover_format'   => ["title" => 'Add New Book Cover Format',                    "path" => './new_tabs/cover_format'],
    // payments                             
        'pay_member' => ["title" => 'Add New Payment',                                  "path" => './payments'],
        'pay_all'    => ["title" => 'Pay All Members',                                  "path" => './payments'],
        'expenses'   => ["title" => 'New Expenses',                                     "path" => './payments'],
    // reports
        //financial reports
            'all_payments'    => ["title" =>  'Financial Report',                       "path" => './reports'],
            'member_payments' => ["title" => 'Individual Payment Report',               "path" => './reports'],
            'expense_report'  => ["title" => 'Expense Report',                          "path" => './reports'],
            'cash_report'     => ["title" => 'Cash Report',                             "path" => './reports'],
            'income_summary'  => ["title" => 'Income Summary',                          "path" => './reports'],
        // other reports            
            'all_new_books'         => ["title" => 'All New Books',                     "path" => './reports'],
            'all_books'             => ["title" =>'All Books Info',                     "path" => './reports'],
            'all_issued_books'      => ["title" => 'All Issued Books',                  "path" => './reports'],
            'cust_issued_books'     => ["title" =>'Specific Customer Issued Books',     "path" => './reports'],
            'all_returned_books'    => ["title" =>'All Returned Books',                 "path" => './reports'],
            'cust_returned_books'   => ["title" => 'Specific Customer Returned Books',  "path" => './reports'],


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