<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tooth"></i><div class="sidebar-brand-text mx-3">Amina Dental</div>
        </div>
        
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-1">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointment" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fa fa-fw fa-calendar"></i>
            <span>Appointments</span>
        </a>
        <div id="collapseAppointment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Books:</h6>
                <a class="collapse-item" href="index.php?page=patient">Add New Patient</a>
                <a class="collapse-item" href="index.php?page=view_books">View All Books</a>
                <a class="collapse-item" href="index.php?page=issue_book">Issue Book</a>
                <a class="collapse-item" href="index.php?page=return_book">Return Book</a>
            </div>
        </div>
    </li>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Users Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fa-solid fa-fw fa-person-half-dress"></i>
            <span>Patients</span>
        </a>
        <div id="collapsePatient" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                
                <h6 class="collapse-header">Users:</h6>
                <a class="collapse-item" href="index.php?page=add_user">Add New Patient</a>
                <a class="collapse-item" href="index.php?page=view_users">View All Patients </a>
                
            </div>
        </div>
    </li>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - New Tab Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStaff" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Staff</span>
        </a>
        <div id="collapseStaff" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="index.php?page=author">Add Author</a>
                <a class="collapse-item" href="index.php?page=publisher">Add Publisher</a>
                <a class="collapse-item" href="index.php?page=genre">Add Genre</a>
                <a class="collapse-item" href="index.php?page=language">Add Language</a>
                <a class="collapse-item" href="index.php?page=cover_format">Add Cover Format</a>
            </div>
        </div>
    </li>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-gear"></i>
            <span>Services</span>
        </a>
        <div id="collapseServices" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users:</h6>
                <a class="collapse-item" href="#">Pay Member</a>
                <a class="collapse-item" href="#">Pay All Members</a>
                <h6 class="collapse-header">Expenses:</h6>
                <a class="collapse-item" href="#">Add New Expense</a>
            </div>
        </div>
    </li>
    
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpenses"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-money-bills"></i>
            <span>Expenses</span>
        </a>
        <div id="collapseExpenses" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users:</h6>
                <a class="collapse-item" href="#">Pay Member</a>
                <a class="collapse-item" href="#">Pay All Members</a>
                <h6 class="collapse-header">Expenses:</h6>
                <a class="collapse-item" href="#">Add New Expense</a>
            </div>
        </div>
    </li>
    
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Payments Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users:</h6>
                <a class="collapse-item" href="#">Pay Member</a>
                <a class="collapse-item" href="#">Pay All Members</a>
                <h6 class="collapse-header">Expenses:</h6>
                <a class="collapse-item" href="#">Add New Expense</a>
            </div>
        </div>
    </li>
    
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- Nav Item - Reports Collapse Menu ---------------------------------------------------------------- -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-file-lines"></i>
            <span>Reports</span>
        </a>
        <div id="collapseReports" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Financial Reports:</h6>
                <a class="collapse-item" href="#">All Payments </a>
                <a class="collapse-item" href="#">User Payments</a>
                <a class="collapse-item" href="#">Expenses</a>
                <a class="collapse-item" href="#">All gains & losses</a>
                <h6 class="collapse-header">Other Reports:</h6>
                <a class="collapse-item" href="#">All New Books</a>
                <a class="collapse-item" href="#">All Books</a>
                <a class="collapse-item" href="#">All Issued Books</a>
            </div>
        </div>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small">Patient-Zero</span>
                        <div class="rounded-circle btn-warning">
                            <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                        </div>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
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
                        <form action="login_folder/form_login.php" method="post">
                            <input type="submit" class="form-control btn btn-outline-primary" name="logout" id="logout" value="Logout">
                        </form>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->