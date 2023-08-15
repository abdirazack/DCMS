<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
</head>

<body class="my-auto">
  <div class="d-flex justify-content-center align-items-center rounded" style="height: 100vh; ">
    <div class="container rounded">
      <div class="row justify-content-center bg-white p-5 rounded shadow-lg ">
        <div class="col-md-8 col-lg-6">
          <div class='text-center'>
            <img src="./app/img/logos/favicon.svg" alt="Logo" width="100" height="100">

            <h3 class="signin-text mb-3"> Login</h3>
          </div>
          <form id="loginForm" action="" method="post">
            <div class="alert alert-danger alert-dismissible fade show d-none" id="alertBlock" role="alert">
              <p class="" id="alertText"></p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form-group">
              <label for="user">User Name</label>
              <input id="username" type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" id="password" name="password" id="password" class="form-control">
            </div>
            <div class="text-center">
              <button id="btnLogin" name="btnLogin" class="btn btn-primary btn-lg">Login</button>
            </div>
          </form>
        </div>
        <div class="col-md-4 col-lg-6 d-flex justify-content-center align-items-center">
          <img src="./app/img/logos/logo.png" class="img-fluid p-5" alt="image">
        </div>
      </div>
    </div>
  </div>


  <?php  require_once('./includes/header.php');?>

  <script>
    $(document).ready(function() {
      $('.alert').alert()

      $('#btnLogin').click(function(e) {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        if (username != '' && password != '') {
          showLoader();
          $.ajax({
            url: "./app/login/process_login.php",
            method: "POST",
            data: {
              username: username,
              password: password
            },
            success: function(data) {
              // alert(data);
              var obj = jQuery.parseJSON(data);
              if(obj.status == 200){
                $('#loginForm')[0].reset();
                window.location.href = "./index.php?page=dashboard";
                hideLoader();
              }
              if (obj.status == 404) {
                
                $('#alertBlock').removeClass('d-none');
                $('#alertText').html(obj.message);
                setTimeout(function() {
                  $('#alertBlock').addClass('d-none');
                }, 3000);
                hideLoader();
              } 
              // hideLoader();
            }
          });
        } else {
          $('#alertBlock').removeClass('d-none');
          $('#alertText').html('Please fill all the fields');
          setTimeout(function() {
            $('#alertBlock').addClass('d-none');
          }, 3000);
          hideLoader();
        }
      });
    });
  </script>