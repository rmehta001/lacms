<?php
//BEGIN manageUsers //
	if (!$isAdmin) {
		die (dieNice("Sorry,  you are not the admin user.", "E-10000"));
	}
	$page = "manageUsers2";
	
	$title = "Manage Agents";
	$needOptions = true;
//END manageUsers //
?>