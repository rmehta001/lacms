<?php

if ( isset($_SESSION ["handle"] )&&$_SESSION ["handle"]=="ann123") {
    header('Location: ./clients/AgencyArea2.php');
    die();
}

$error = "We're working on a new version of our site and slowly rolling out new features as they're built<BR>Any feedback is always appreciated :)";
if (isset($_GET['wrong'])) {
    $error = "<font color=red> Wrong username and/or password.<br>Usernames and passwords are case-sensitive!<br>Try again or contact us for further help.</font>";
}

if (isset($_GET['wrong2'])) {
    $error = "<font color=red> Please input your username or password.</font>";
}

if (isset($_GET['wrong3'])) {
    $error = "<font color=red>you can not login in admin in this page </font>";
}
if (isset($_GET['wrong4'])) {
    $error = "<font color=red>This is only for admin </font>";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BostonApartments.com | Admin Login</title>

    <link rel="stylesheet" href="login.css">
	<style>
        .body{
        	font-family: 'Montserrat', sans-serif;
        	font-size: 100%;background: url(img/bbb.jpg)no-repeat;
        	 background-size: cover
        }

    </style>

  </head>
 
<body class="body">
        <div class="loginmodal-container text-center">
          <img src="logo.png" class="img img-responsive"><br>
          <h1><br>BostonApartments.com<BR>
		  Administrator Login Page </h1>
		  <p><?=$error?></p><br>
          <form action="adminindex.php" method="POST">
          <input type="text" name="username" placeholder="Username" autocomplete="off" autocapitalize="none" autofocus>
          <input type="password" name="password" placeholder="Password">
          <input type="submit" name="login" class="login loginmodal-submit" value="Login">
          </form>

          <div class="login-help text-center">

          </div>
        </div>



  </body>
</html>
