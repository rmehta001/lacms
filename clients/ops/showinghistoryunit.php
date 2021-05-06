<?php
//BEGIN createshowing //
	if ($_SESSION["level"]>4) {
		$page = "showinghistoryunit";
		$title = "Showing History - Unit";
		$cid = $_GET['cid'];
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createshowing //
?>