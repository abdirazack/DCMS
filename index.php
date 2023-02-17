<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once 'header.php'; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <title>LOGIN</title>
    <style>
        body {

            background-color: wheat;
        }

        .inner {
            width: 60%;
            height: 50%;
            background: white;
            border-radius: 26px;
            box-shadow: 0px 12px 4px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }


        .header-text {
            font-size: 36px;
            text-decoration: underline;
        }

        form {
            margin-left: 2%;
            margin-top: 5%;
        }
        .width{
            width: 30%;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-md-center align-items-center vh-100">

        <div class="inner">
            <form>
                <H1 class="header-text">LOGIN HERE</H1>
                <div class="mb-3 mt-5">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control width" id="username">

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control width" id="password">
                </div>
                <input type="submit" class="btn btn-outline-primary mt-5 width" value="LOGIN"></input>
            </form>
        </div>
    </div>





</body>

</html>