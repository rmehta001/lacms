<?php
//BEGIN createshowing //
	if ($_SESSION["level"]>4) {
		$page = "createshowing";
		$title = "Create Showing";
		$cid = $_GET['cid'];
		$needOptions = true;
		$disdata = "clients";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createshowing //
?>