<?php
//BEGIN editUser //
	if ($isAdmin) {
		$page = "editUser2";
		$euid = $HTTP_GET_VARS['uid'];
		
		$title = "Edit Agent";
		$disData = "euser";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editUser //
?>