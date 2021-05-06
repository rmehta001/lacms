<?php
//BEGIN editUser //

	if (($_SESSION['isAdmin']) OR ($user_level >= "10")) {
		$page = "editUser";
		$euid = $_GET['uid'];
		
		$title = "Edit Agent";
		$disData = "euser";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editUser //
?>