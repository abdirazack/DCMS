

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tooth"></i>
            <div class="sidebar-brand-text mx-3">Emirates Dental</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-1">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?page=dashboard">
            <i class="fas fa-fw fa-house"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Books Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?page=appointment">
            <i class="fa fa-fw fa-calendar"></i>
            <span>Appointments</span>
        </a>
        <div id="collapseAppointment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Appointments:</h6>
                <a class="collapse-item" >Add New Appointment</a>
            </div>
        </div>
    </li>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Users Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-fw fa-person-half-dress"></i>
            <span>Patients</span>
        </a>
        <div id="collapsePatient" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">Patients:</h6>
                <a class="collapse-item" href="index.php?page=patients">Patients</a>
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
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStaff" aria-expanded="true" aria-controls="collapseUtilities">
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
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-gear"></i>
            <span>Services & Procedure</span>
        </a>
        <div id="collapseServices" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Services:</h6>
                <a class="collapse-item" href="index.php?page=services">Services</a>
                <h6 class="collapse-header">Procedure:</h6>
                <a class="collapse-item" href="index.php?page=procedure">Procedue</a>
            </div>
        </div>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpenses" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-money-bills"></i>
            <span>Expenses & Payments</span>
        </a>
        <div id="collapseExpenses" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Expenses:</h6>
                <a class="collapse-item" href="index.php?page=expenses">Expense</a>
                <h6 class="collapse-header">Expenses Types:</h6>
                <a class="collapse-item" href="index.php?page=expense_type">Expense Type</a>
                <h6 class="collapse-header">Payments:</h6>
                <a class="collapse-item" href="index.php?page=payments">Payments</a>
            </div>
        </div>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedication" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-pills"></i>
            <span>Medication</span>
        </a>
        <div id="collapseMedication" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Medication:</h6>
                <a class="collapse-item" href="index.php?page=medication">Medication</a>
                <h6 class="collapse-header">Drugs:</h6>
                <a class="collapse-item" href="index.php?page=drug">Drugs</a>

            </div>
        </div>
    </li>

    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier" aria-expanded="true" aria-controls="collapseUtilities">
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
    </li>
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
        <a class="nav-link " href="index.php?page=address" >
        <i class="fa-solid fa-location-dot"></i>
            <span>Address</span>
        </a>
    </li>
    <!-- Nav Item - Reports Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link " href="index.php?page=reports" >
        <i class="fa-solid fa-file"></i>
            <span>Reports</span>
        </a>
    </li>

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
                <li class="mt-3 text-center me-5 fs-4"><?php if (isset($title)) {
                                                            echo $title;
                                                        } ?></li>
                <div class="topbar-divider d-none d-sm-block"></div>


                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["employee_name"];  ?></span>
                        <div class="rounded-circle btn-warning">
                            <img class="img-profile rounded-circle" src="<?php  echo './app/img/employee/'.$_SESSION["profile"];  ?>">
                        </div>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?page=profile">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="./app/login/logout.php" method="post">
                            <input type="submit" class="form-control btn btn-outline-primary" name="logout" id="logout" value="Logout">
                        </form>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->