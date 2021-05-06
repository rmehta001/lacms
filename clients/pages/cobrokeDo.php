<?php
//BEGIN ccobrokeDo //
	
$PHP_SELF = $_SERVER['PHP_SELF'];
	$cobroke_pw = $_POST['cobroke_pw'];
	$cobroke_view = $_POST['cobroke_view'];
	$cobroke_head = $_POST['cobroke_head'];
	$cobroke_foot = $_POST['cobroke_foot'];

	$quStrHFPrefs = "UPDATE `GROUP` SET COBROKE_PW='$cobroke_pw', COBROKE_VIEW='$cobroke_view', COBROKE_HEAD='$cobroke_head', COBROKE_FOOT='$cobroke_foot' WHERE `GRID`=$grid";
	$quHFPrefs = mysqli_query($dbh, $quStrHFPrefs) or die ("Something is wrong with cobrokeDo");

if (isset($isAdmin)) {
	$page = "admin";
} else {
$page = "home";
 }
	$msg = "Co-broke password, templates and settings for $_SESSION[group] saved.";
	$title = "Admin";



//END cobrokeDo //
?>