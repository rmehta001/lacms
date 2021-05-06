<?php

session_start();

if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
  header('Location: index.php');
  die();
}

$error = "We're working on a new version of our site and slowly rolling out new features as they're built<BR>Any feedback is always appreciated :)";

if (isset($_GET['wrong'])) {
  $error = "<font color=red>Wrong username and/or password.<br>Usernames and passwords are case-sensitive!<br>Try again or contact us for further help.</font>";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BostonApartments.com | LACMS Login</title>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('particles-js', 'particles.json', function() {
      // console.log('callback - particles.js config loaded');
    });
    </script>
    <style>
    #particles-js{
      position: fixed;
      top: 0px;
      left: 0;
      min-width: 100%;
      min-height: 100%;
      width: 100%;
      height: 100%;
      z-index: -100;
    }
    </style>
  </head>
  <body>

<div id="particles-js"></div>
    <div class="container">

        <div class="loginmodal-container text-center">
          <img src="logo.png" class="img img-responsive"><br>
          <h1>Welcome to the<br>BostonApartments.com<BR>
		  Database System</h1>
          <p><?=$error?></p><br>
          <form action="index.php" method="POST">
          <input type="text" name="username" placeholder="Username" autocomplete="off" autocapitalize="none" autofocus>
          <input type="password" name="password" placeholder="Password">
          <input type="submit" name="login" class="login loginmodal-submit" value="Login">
          </form>

          <div class="login-help text-center">
          <a href="../agencyAreaPasswordReminder.php">Forgot password?</a>
          </div>
        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </body>
</html>
