<?php 
//BEGIN personalsigprefsDo //

	$SHOW_FBLIKE = (isset ($_POST['SHOW_FBLIKE']));

	$quStrPSPrefs = "UPDATE `GROUP` SET SHOW_FBLIKE='$SHOW_FBLIKE' WHERE `GRID`=$grid";
	$quPSPrefs = mysqli_query($dbh, $quStrPSPrefs) or die ("Something is wrong with sigsettingsprefsDo");

if (isset($isAdmin)  OR ($user_level <="10")) {
	$page = "admin";
	$msg = "Agent Personal Signature settings for $_SESSION[group] saved.";
	$title = "Admin";
} else {
$page = "home";
$title = "Hot List";
$msg = "You are not authorized to make this change.";
 }

	
//END persigprefsDo  //

?>