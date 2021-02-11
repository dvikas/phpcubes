<?php
session_start();
$msg = '';

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) ){
	$username = md5(md5((trim($_POST['email']))));
	$password = md5(md5((trim($_POST['password']))));
	
	if($username = '64d49bd9c53d5547b86a034e146ff58e' && $password=='1be9749a0972013e581296048fb752da'){
		# User valid
		//session_start();
		$_SESSION['id'] = time();
		header("location:pages/index.php");
		exit;
	} else {
		$msg = "Invalid username / password ";		
	}
} else if(isset($_POST['email'])){
	$msg = "Email/Password required.";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../../favicon.ico">

    <title>Cubes Web Authoring</title>

    <!-- Bootstrap core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">


  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post">
		  <?php
		  if($msg){
			echo '<div role="alert" class="alert alert-danger">
				  '.$msg.'
				</div>';
			}
		  ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" >
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>
