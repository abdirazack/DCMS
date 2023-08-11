<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php 
        session_start();
        include_once 'header.php'; 
        include_once('db-connect.php')
        ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <title>LOGIN</title>

</head>

<body style='background-color: #F5F4F3; width: 100vw;'>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container">
            <div class="row justify-content-center bg-white p-5 rounded-5 shadow-lg ">
                <div class="col-md-7 col-lg-6">
                    <form action="loginProcess.php" method="post">
                        <h1 class="fs-3 text-decoration-underline">LOGIN HERE</h1>
                        <div class="mb-3 mt-3">
                            <label for="username" class="form-label fs-6 text-primary">Username</label>
                            <input type="text" class="form-control shadow border border-2 border-primary" name="username" id=" username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fs-6 text-primary">Password</label>
                            <input type="password" class="form-control shadow border border-2 border-primary" name="password" id="password">
                        </div>
                        <button type="submit" name='btnLogin' class="btn btn-outline-primary shadow mt-4">Login</button>
                    </form>
                </div>
                <div class="col-md-5 col-lg-6 d-flex justify-content-center align-items-center">
                    <img src="one.jpg" class="img-fluid shadow rounded" alt="Image" style="width: 400px; height: 350px;">
                </div>
            </div>
        </div>
    </div>
</body>

</html>