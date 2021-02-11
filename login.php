<?php
require_once('includes/connection.php')

  ini_set('error_reporting','1');
  if(isset($_POST['email'])&&!empty($_POST['email']) &&
     isset($_POST['password'])&&!empty($_POST['password'])) {

      $_POST = array_map('trim',$_POST);
      $password = ($_POST['password']);

      if($password=='vikas@tv' && $_POST['email']=='vikas.nice@gmail.com') {
        $total_users = 1;
      }

      if($total_users == 1)
      {
        ### SET COOKIE  ####
        if(isset($_POST['remember'])) {
          $time = time()+30;
          setcookie('email',$_POST['email'],$time);
          setcookie('password',$_POST['password'],$time);
        } else {
          $time = time()-1;
          setcookie('email',$_POST['email'],$time);
          setcookie('password',$_POST['password'],$time);
        }
        //print_r($user);
        $_SESSION['rajuname'] = 'vikas';
        header('Location:'.BASE_URL);
      }

  } else {
    echo "Email/Password required";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" name="email" class="form-control" value="<?=@$_COOKIE['email']?>" placeholder="Email address" autofocus>
        <input type="password" value="<?=@$_COOKIE['password']?>" name="password" class="form-control" placeholder="Password">
        <label class="checkbox">
          <input name="remember" checked type="checkbox"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br>
        <span ><a href="register.html">Not a member yet</a></span>
      </form>

    </div> <!-- /container -->

