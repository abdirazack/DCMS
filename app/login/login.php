<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOGIN PAGE</title>

    <!-- Custom fonts for this template-->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <?php
// Clear the query string if the page is refreshed
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   header("Location: ".$_SERVER['PHP_SELF']);
//   exit();
// }

// Output the HTML code
?>
</head>
<!-- HTML form for logging in -->

<body>
    <form method="POST" action="login_proc.php">
        <center>
            <div class="container" style="margin-top: 10%;">
                <div class="card border-light">
                    <div class="card-header">
                        <h3 class="card-title">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php 
                      if(isset($_GET['error_message'])){
                        $msg = $_GET['error_message'];
                        echo "<strong style='color:red;'>".$msg."</strong>";

                      }
                      ?>
                        <input class="form-control mb-3" type="text" name="username" placeholder="Enter username"
                            id="username">
                        <input class="form-control" type="password" name="password" placeholder="Enter password"
                            id="password">
                    </div>
                    <div class="card-footer  m-0 p-0">
                        <button class="btn btn-primary w-100" type="submit">Log In</button>
                    </div>
                </div>
            </div>
        </center>


    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>