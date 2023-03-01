<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once('header.php'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Dental Clinic Management System</title>
    <style>
        /* Sidebar */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #37474f;
            color: #fff;
            transition: all 0.3s;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background-color: #555;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background-color: #455a64;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background-color: #4d6474;
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background-color: #5d6d7e;
            border-left: 3px solid #fff;
        }

        #sidebarCollapse {
            background-color: #455a64;
            color: #fff;
            border: none;
        }

        #sidebarCollapse:hover {
            background-color: #616e7d;
        }

        /* Content */
        #content {
            width: 100%;
            padding: 20px;
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            #sidebar {
                min-width: 80px;
                max-width: 80px;
                text-align: center;
                transition: all 0.3s;
            }

            #sidebar ul.components {
                padding: 0;
            }

            #sidebar ul li a {
                padding: 5px;
            }

            #sidebar ul li a span {
                display: none;
            }

            #sidebar ul li a i {
                font-size: 1.2em;
                margin-right: 5px;
            }

            #sidebarCollapse span {
                display: none;
            }
        }
    </style>
</head>

<body>
<div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>My Menu</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-home"></i> Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-info-circle"></i> About</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-alt"></i> Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-envelope"></i> Contact</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>