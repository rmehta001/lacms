<?php
//BEGIN delete//
if ($_SESSION["user_level"] > 1) {
	$cid = $_GET['cid'];
	$page = "delete";
	$disData = "ad";
	$title = "Delete Ad Confirmation";
	$msg = "Are you sure you want to delete this ad?";
}else {
	$page = "home";
	$msg = "You are not authorized to make deletes.";
}
//END delete//
?>