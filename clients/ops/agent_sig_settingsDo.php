<?php 
//BEGIN personalsigprefsDo //

	$ALLOW_PERSONAL_SIG = $_POST['ALLOW_PERSONAL_SIG'];

	$quStrPSPrefs = "UPDATE `GROUP` SET ALLOW_PERSONAL_SIG='$ALLOW_PERSONAL_SIG' WHERE `GRID`=$grid";
	$quPSPrefs = mysqli_query($dbh, $quStrPSPrefs) or die ("Something is wrong with sigsettingsprefsDo");

if (isset($isAdmin)  OR ($user_level <="10")) {
	$page = "admin";
	$msg = "Agent Personal Signature settings for $_SESSION[group]saved.";
	$title = "Admin";
} else {
$page = "home";
$title = "Hot List";
$msg = "You are not authorized to make this change.";
 }

	
//END persigprefsDo  //

?>