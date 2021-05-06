<?php
//BEGIN editClient //
//changes done by Tanvi//
	if ($_SESSION["level"]>4) {
		$clid = $_GET['clid'];
		$page = "editClientapp";
		$disData = "client";
		
		$title = "Edit Client Application";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editClient //
?>