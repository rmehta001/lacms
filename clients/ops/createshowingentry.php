<?php
//BEGIN createshowingentry //
	if ($_SESSION ["level"]>4) {
		$page = "createshowingentry";
		$title = "Create Showing Entry";
		$clid = $_GET['clid'];
		$needOptions = true;
		$disdata = "clients";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createshowingentry //
?>