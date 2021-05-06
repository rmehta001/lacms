<?php
//BEGIN manageUsers //
	if ((!$_SESSION['isAdmin']) AND ($_SESSION['user_level'] < "10")){
		die (dieNice("Sorry,  you are not the admin user.", "E-10000"));
	}
	$page = "manageUsers";
	
	$title = "Manage Agents";
	$needOptions = true;
//END manageUsers //
?>