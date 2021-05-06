<?php
//BEGIN editClient //
	if ($level>4) {
		$clid = $HTTP_GET_VARS['clid'];
		$page = "editClient3";
		$disData = "client";
		
		$title = "Edit Client";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editClient //
?>