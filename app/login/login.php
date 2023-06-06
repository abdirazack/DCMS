<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <form action="process_login.php" method="post">

  <div class="container">
	
	<div class="row content">
		<div class="col-md-6 mb-3">
			<img src="undraw_doctors_p6aq.svg" class="img-fluid" alt="image">
		</div>
    <div class="col-md-6">
		<img src="logo.svg" alt="Logo" width="60" height="60">
		        
      <h3 class="signin-text mb-3"> Login</h3>
	  
      <form>
        <div class="form-group">
          <label  for="user">User Name</label>
          <input id="username" type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="pass" >Password</label>
          <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
          <label class="form-check-label" for="checkbox">Remember Me</label>
        </div>
        <button id ="btnLogin"class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </div>
</div>
  
</body>

</html>
<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

.content{
    margin: 12%;
    background-color: #fff;
    padding: 4rem 1rem 4rem 1rem;
    box-shadow: 0 0 5px 5px rgba(0,0,0, .05);
}
.signin-text{
    font-style: normal;
    
      font-size: 34px;
      font-weight: bold;
      margin-bottom: 10px;
    

}




.birthday-section{
    padding: 15px;
}

</style>
