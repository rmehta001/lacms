<?php
//BEGIN termUser // 
	$term_uid = $_GET['uid'];
	$quStrGetUser = "SELECT * FROM USERS WHERE UID=$term_uid";
	$quGetUser = mysqli_query($dbh, $quStrGetUser);
	$rowGetUser = mysqli_fetch_object($quGetUser);
	$page = "termUser";
	$msg = "Terminate user: deny access to the system, remove from database, and transfer ads to another user.";
	$title = "Terminate User";
	$needOptions = true;
//END termUser //
?>