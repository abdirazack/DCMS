<style>
.bg {
    background-color: rgb(49, 64, 83);
}

@import url('https://fonts.cdnfonts.com/css/poppins');

body {
    font-family: 'poppins';
}
</style>

<!-- Sidebar -->
<ul class="navbar-nav bg sidebar sidebar-dark accordion sticky-top" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-1" href="index.php?page=dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <img class="sidebar-brand-icon" src="./app/img/logos/favicon.svg" height="60px" width="60px">

        </div>
        <h5 class="sidebar-brand-text rotate-n-15">Emirates Dental</h5>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider mt-2">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?page=dashboard">
            <i class="fas fa-fw fa-house"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="index.php?page=appointment">
            <i class="fa fa-fw fa-calendar"></i>
            <span>Appointments</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Books Collapse Menu ---------------------------------------------------------------- -->

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Users Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-fw fa-person-half-dress"></i>
            <span>Patients</span>
        </a>
        <div id="collapsePatient" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">Patients:</h6>
                <a class="collapse-item" href="index.php?page=patients">Patients</a>
                <h6 class="collapse-header">Drugs:</h6>
                <a class="collapse-item" href="index.php?page=drug">Drugs</a>
                <h6 class="collapse-header">Patient_Service:</h6>
                <a class="collapse-item" href="index.php?page=patient_service">Patient_Service</a>
                <h6 class="collapse-header">Prescriptions:</h6>
                <a class="collapse-item" href="index.php?page=prescription">Prescriptions</a>
                <h6 class="collapse-header">Treatment Plans:</h6>
                <a class="collapse-item" href="index.php?page=TreatmentPlans">Treatment Plans</a>

            </div>
        </div>
    </li>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - New Tab Collapse Menu ---------------------------------------------------------------- -->
    <?php

    if ($_SESSION['isAdmin']) {

    ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStaff" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Employees</span>
        </a>
        <div id="collapseStaff" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Employees:</h6>
                <a class="collapse-item" href="index.php?page=employee">Employees</a>
                <h6 class="collapse-header">Employee Roles:</h6>
                <a class="collapse-item" href="index.php?page=role">Roles</a>
                <h6 class="collapse-header">Employee Salaries:</h6>
                <a class="collapse-item" href="index.php?page=salary">Salaries</a>
                <h6 class="collapse-header">Employee Logins:</h6>
                <a class="collapse-item" href="index.php?page=logins">Employee Login Credentials</a>
            </div>
        </div>
    </li>
    <?php
    } ?>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpenses"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-money-bills"></i>
            <span>Expenses</span>
        </a>
        <div id="collapseExpenses" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Expenses Types:</h6>
                <a class="collapse-item" href="index.php?page=expense_type">Expense Type</a>
                <h6 class="collapse-header">Expenses:</h6>
                <a class="collapse-item" href="index.php?page=expenses">Expense</a>
            </div>
        </div>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->

    <li class="nav-item">
        <a class="nav-link " href="index.php?page=payments">
            <i class="fas fa-fw fa-money-bills"></i>
            <span>Payments</span>
        </a>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link " href="index.php?page=services">
            <i class="fas fa-fw fa-gear"></i>
            <span>Services </span>
        </a>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link collapsed" href="index.php?page=medication">
            <i class="fas fa-fw fa-pills"></i>
            <span>Medication</span>
        </a>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <!-- <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-industry"></i>
            <span>Supplier & Inventory</span>
        </a>
        <div id="collapseSupplier" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Suppliers:</h6>
                <a class="collapse-item" href="index.php?page=supplier">Suppliers</a>
                <h6 class="collapse-header">Inventory:</h6>
                <a class="collapse-item" href="index.php?page=inventory">Inventory</a>
            </div>
        </div>
    </li> -->
    <!-- ------------------------------------------------------------------------------------------------ -->

    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link" href="index.php?page=equipment">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Equipment</span>
        </a>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link " href="index.php?page=address">
            <i class="fa-solid fa-location-dot"></i>
            <span>Address</span>
        </a>
    </li>

    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-file"></i>
            <span>Reports</span>
        </a>
        <div id="collapseReports" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Report:</h6>
                <a class="collapse-item" href="index.php?page=reports">ALL</a>
                <h6 class="collapse-header">Patient Report:</h6>
                <a class="collapse-item" href="index.php?page=patient_reports">Patient</a>
                <h6 class="collapse-header">Income Report:</h6>
                <a class="collapse-item" href="index.php?page=income_reports">Income</a>
                <h6 class="collapse-header">Expense Report:</h6>
                <a class="collapse-item" href="index.php?page=expense_reports">Expense</a>
                <h6 class="collapse-header">Employees Report:</h6>
                <a class="collapse-item" href="index.php?page=employee_reports">Employees</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Reports Collapse Menu ---------------------------------------------------------------- -->
    <!-- <li class="nav-item">
        <a class="nav-link " href="index.php?page=reports">
            <i class="fa-solid fa-file"></i>
            <span>Reports</span>
        </a>
    </li> -->

    <!-- ------------------------------------------------------------------------------------------------ -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="mt-3 text-center me-5 fs-4">
                    <?php if (isset($title)) {
                        echo $title;
                    } ?>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- add notification button -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <span id="counter" class="badge badge-danger badge-counter">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="notificationsDropdown">
                        <h6 class="dropdown-header text-primary">
                            Notifications
                        </h6>
                        <div id="notifications">

                        </div>
                        <!-- mark all as read -->
                        <a class="dropdown-item text-center small text-gray-500" href="#" onclick="markAllAsRead()">Mark
                            all as read</a>
                    </div>
                </li>


                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["employee_name"];  ?></span>
                        <div class="rounded-circle " style="border: 1px solid grey;">
                            <img class="img-profile rounded-circle" alt=""
                                src="<?php echo './app/img/employee/' . $_SESSION["profile"];  ?>">
                        </div>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?page=profile">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="index.php?page=changePassword">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <a class="dropdown-item" href="index.php?page=changePic">
                            <i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Picture
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="./app/login/logout.php" method="post">
                            <input type="submit" class="form-control btn btn-outline-primary" name="logout" id="logout"
                                value="Logout">
                        </form>
                    </div>
                </li>




            </ul>

        </nav>
        <!-- End of Topbar -->
        <script>
        function fetchNotificationCounter() {
            $.ajax({
                type: "GET",
                url: "./app/notifications/fetch.php",
                dataType: "html",
                success: function(data) {
                    // alert(data);
                    //    console.log(data);
                    $("#counter").text(data);

                }
            });
        }

        function fetchNotificationsDetails() {
            $.ajax({
                url: './app/notifications/get.php', // Replace with the path to your PHP script
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // alert(data);
                    var notificationsContainer = $('#notifications');
                    notificationsContainer.empty();


                    $.each(data, function(index, notification) {
                        appointmed_id = notification.appointment_id;
                        var notificationHtml = `
                                <a class="dropdown-item"  onclick="goToTriggerEdit(${appointmed_id}); return false;" id="notyLink">
                                    <i class="fas fa-envelope fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ${notification.patient_name}
                                    <span class="float-right text-muted small">${notification.time}</span>
                                </a>
                    `;
                        notificationsContainer.append(notificationHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function goToTriggerEdit(id) {
            console.log(id);
            $.ajax({
                type: "GET",
                url: "./index.php",
                data: {
                    page: "appointment",
                    trigger_id: id
                },
                success: function(response) {
                    // Handle the response if needed
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }


        $(document).ready(function() {
            $("#sidebarToggle").click(function() {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
            });

            // Attach a click event to the notification link


            // Initial notifications update
            fetchNotificationCounter();







            // Update notifications on an interval (e.g., every 1 minute)
            setInterval(fetchNotificationCounter, 600); // 60000 ms = 1 minute
            setInterval(fetchNotificationsDetails, 600); // 60000 ms = 1 minute


        });
        // mark all as read
        function markAllAsRead() {
            // alert("mark all as read");
            showLoader();
            $.ajax({
                type: "GET",
                url: "./app/notifications/markAsRead.php",
                dataType: "html",
                success: function(data) {
                    // alert(data);
                    console.log(data);

                    var obj = JSON.parse(data);
                    if (obj.status == 200) {
                        fetchNotificationCounter();
                        fetchNotificationsDetails();
                        hideLoader();
                    } else {
                        hideLoader();
                        alert("Something went wrong");
                    }

                },
                error: function(xhr, status, error) {
                    console.error(error);
                    console.error(error);
                    hideLoader();
                }
            });
        }
        </script>