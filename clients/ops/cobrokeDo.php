<?php
//BEGIN ccobrokeDo //
	
$PHP_SELF = $_SERVER['PHP_SELF'];
	$cobroke_pw = (isset ($_POST['cobroke_pw']));
	$cobroke_view = (isset ($_POST['cobroke_view']));
	$cobroke_bos =(isset  ($_POST['cobroke_bos']));
	$cobroke_head =(isset  ($_POST['cobroke_head']));
	$cobroke_foot =(isset  ($_POST['cobroke_foot']));

	$quStrHFPrefs = "UPDATE `GROUP` SET COBROKE_PW='$cobroke_pw', COBROKE_VIEW='$cobroke_view', COBROKE_BOS='$cobroke_bos', COBROKE_HEAD='$cobroke_head', COBROKE_FOOT='$cobroke_foot' WHERE `GRID`=$grid";
	$quHFPrefs = mysqli_query($dbh, $quStrHFPrefs) or die ("Something is wrong with cobrokeDo");

if (isset($isAdmin) OR ($user_level >="10")) {
	$page = "admin";
} else {
$page = "home";
 }
	$msg = "Co-broke password, templates and settings for $_SESSION[group] saved.";
	$title = "Admin";



//END cobrokeDo //
?>