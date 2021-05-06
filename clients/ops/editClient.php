<?php
//BEGIN editClient //
	if ($_SESSION ["level"]>=1) {
		$clid = $_GET['clid'];
		$page = "editClient";
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