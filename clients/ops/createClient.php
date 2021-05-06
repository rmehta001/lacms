<?php
//BEGIN createClient //
	if ($_SESSION["level"]>4) {
		$page = "createClient";
		$title = "Create Client";
		
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createClient //
?>