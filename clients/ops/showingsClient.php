<?php
//BEGIN showingsClient //
	if ($_SESSION["level"]>4) {
		$page = "showingsClient";
		$title = "Client Showing History";
		$clid = $_GET['clid'];
		$needOptions = true;
	}else {
		$page = "showingsClient";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END showingClient //
?>