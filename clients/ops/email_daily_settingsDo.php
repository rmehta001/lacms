<?php 
//BEGIN personalsigprefsDo //

	$EMAIL_DAILY = $_POST['EMAIL_DAILY'];

	$quStrPSPrefs = "UPDATE `GROUP` SET EMAIL_LISTINGS='$EMAIL_DAILY' WHERE `GRID`=$grid";
	$quPSPrefs = mysqli_query($dbh, $quStrPSPrefs) or die ("Something is wrong with sigsettingsprefsDo");

if (isset($isAdmin)  OR ($user_level <="10")) {
	$page = "admin";
	$msg = "Daily Client Email settings for $group saved.";
	$title = "Admin";
} else {
$page = "home";
$title = "Daily Client Email Settings";
$msg = "You are not authorized to make this change.";
 }

	
//END persigprefsDo  //

?>